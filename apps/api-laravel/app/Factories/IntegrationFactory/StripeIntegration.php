<?php

namespace App\Factories\IntegrationFactory;

use App\Contracts\IntegrationContract;
use App\Helpers\Logit;
use App\Models\Integration;
use App\Services\StripeService;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Stripe\Exception\ApiErrorException;

class StripeIntegration implements IntegrationContract
{
    const REQUEST_TYPE_TENANT    = 'tenant';
    const REQUEST_TYPE_ADMIN  = 'admin';

    /**
     * @throws ApiErrorException
     * @throws Exception
     */
    public function getOauthUrl(array $payload): string
    {
        $model = $payload['integrable_type']::find($payload['integrable_id']);

        if (!$model->exists) {
            Logit::critical('Unable to find model for Stripe account link creation', $payload);
            throw new Exception(status:404);
        }

        $stripeService = new StripeService();
        $integration   = $this->getExistingIntegration($model);

        if (!$integration) {
            $stripeAccount = $stripeService->createAccount($model->email);
            $integration = Integration::query()->create([
                'integrable_id' => $model->id,
                'integrable_type' => get_class($model),
                'platform' => Integration::PLATFORM_TYPE_STRIPE,
                'platform_account_id' => $stripeAccount['id'],
                'platform_pretty_name' => ucfirst(Integration::PLATFORM_TYPE_STRIPE),
                'status' => Integration::STATUS_INACTIVE,
            ]);
        } else {
            $stripeAccount = $stripeService->retrieveAccount($integration->platform_account_id);

            // Check if details submitted
            if (true === $stripeAccount['details_submitted']) {
                $integration->status = Integration::STATUS_ACTIVE;
                $integration->save();
                return config('services.stripe.redirect_uri');
            }
        }

        $stripeService = new StripeService($integration->platform_account_id);
        return $stripeService->createAccountLink()->url;
    }

    /**
     * @throws Exception
     */
    public function store(array $payload)
    {
        // todo::maybe further work needs done
    }

    /**
     * @throws \Exception
     */
    private function validate(array $payload): void
    {
        if (empty($payload['type'])
            || empty($payload['type_id'])
            || !in_array($payload['type'], [self::REQUEST_TYPE_TENANT, self::REQUEST_TYPE_ADMIN])
        ) {
            Logit::critical('Invalid data sent for stripe create account link. Missing mandatory fields', $payload);
            throw new \Exception('Invalid data sent for stripe create account link. Missing mandatory fields', 404);
        }
    }

    private function getExistingIntegration(Model $model): Integration|null
    {
        return Integration::query()
            ->where('integrable_id', $model->id)
            ->where('integrable_type', get_class($model))
            ->where('platform', Integration::PLATFORM_TYPE_STRIPE)
            ->first();
    }

    public function destroy(Integration $integration): void
    {
        $integration->delete();
    }
}
