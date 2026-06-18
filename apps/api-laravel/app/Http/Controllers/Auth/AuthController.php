<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\AuthContract;
use App\Factories\AuthControllerFactory;
use App\Helpers\ApiKeyHelper;
use App\Http\Controllers\Services\AuthService;
use App\Http\Requests\AuthHandleProviderCallbackRequest;
use App\Http\Requests\SendVerificationCodeAuthRequest;
use App\Http\Requests\UpdatePasswordAuthRequest;
use App\Http\Requests\VerifyCodeAuthRequest;
use App\Jobs\SendVerificationCode;
use App\Models\Merchant;
use App\Models\MerchantCustomers;
use App\Models\User;
use App\Services\StripeService;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function __construct(protected AuthService $service)
    {

    }
    public function sendVerificationCode(SendVerificationCodeAuthRequest $request)
    {
        try {
            $this->service->sendVerificationCode($request->validated());
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    public function verifyCode(VerifyCodeAuthRequest $request):Model|false
    {
        return $this->service->verifyCode(...$request->validated());
    }

    public function updatePassword(UpdatePasswordAuthRequest $request)
    {
        $this->service->updatePassword(...$request->validated());
    }
}
