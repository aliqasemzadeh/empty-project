<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class WalletSettings extends Settings
{

    public static function group(): string
    {
        return 'payment';
    }
}