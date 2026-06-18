<?php

namespace App\Helpers;

use App\Events\ErrorOccurred;
use Illuminate\Support\Facades\Log;

class Logit
{
    public static function alert($message, $context = []) {
        Log::alert($message, $context);
        self::notifySupport($message);
    }

    public static function critical($message, $context = []) {
        Log::critical($message, $context);
        self::notifySupport($message);
    }

    public static function debug($message, $context = []) {
        Log::debug($message, $context);
        self::notifySupport($message);
    }

    public static function emergency($message, $context = []) {
        Log::emergency($message, $context);
        self::notifySupport($message);
    }

    public static function info($message, $context = []) {
        Log::info($message, $context);
        self::notifySupport($message);
    }

    public static function log($message, $context = []) {
        Log::log($message, $context);
        self::notifySupport($message);
    }

    public static function notice($message, $context = []) {
        Log::notice($message, $context);
        self::notifySupport($message);
    }

    public static function warning($message, $context = []) {
        Log::warning($message, $context);
        self::notifySupport($message);
    }

    public static function error($message, $context = []) {
        Log::error($message, $context);
        self::notifySupport($message);
    }

    private static function notifySupport($message) {
        event(new ErrorOccurred($message));
    }
}
