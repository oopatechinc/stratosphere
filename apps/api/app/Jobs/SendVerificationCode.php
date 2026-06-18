<?php

namespace App\Jobs;

use App\Mail\VerificationCode;
use App\Services\TwilioService;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use function PHPUnit\Framework\matches;

class SendVerificationCode implements ShouldQueue
{
    use Queueable;

    const TYPE_EMAIL = 'email';
    const TYPE_PHONE = 'phone';

    const TYPES = [self::TYPE_EMAIL, self::TYPE_PHONE];

    /**
     * Create a new job instance.
     */
    public function __construct(protected Model $model, protected string $type)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (!in_array($this->type, self::TYPES)) {
            throw new Exception('Invalid code type');
        }

        if ($this->type === self::TYPE_EMAIL) {
            Mail::to($this->model->email)->send(new VerificationCode($this->model));
        }

        if ($this->type === self::TYPE_PHONE) {
            $message = "Your " . config('app.name') ." code is " . $this->model->forgot_password_code;
            (new TwilioService($this->model->phone))->sendSms($message);
        }
    }
}
