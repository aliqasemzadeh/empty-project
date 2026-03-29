<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $app_name;
    public string $app_domain;
    public string $app_descriptions;
    public string $app_short_name;

    public static function group(): string
    {
        return 'default';
    }
}
