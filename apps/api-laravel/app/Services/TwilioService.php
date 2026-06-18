<?php

namespace App\Services;

use App\Helpers\Logit;
use Twilio\Rest\Client;

class TwilioService
{
    private string $toPhoneNumber;

    public function __construct(string $toPhoneNumber)
    {
        $this->toPhoneNumber = $toPhoneNumber;
    }

    public function sendSms($body)
    {
        try {
            $twilio = new Client(config('services.twilio.sid'), config('services.twilio.token'));

            $message = $twilio->messages
                ->create($this->toPhoneNumber,
                    [
                        'from' => config('services.twilio.phone_number'), // From a valid Twilio number
                        'body' => $body
                    ]
                );

            print($message->sid);
        } catch (\Exception $ex) {
            Logit::error('Twilio sms error', $ex->getTrace());
        }
    }
}
