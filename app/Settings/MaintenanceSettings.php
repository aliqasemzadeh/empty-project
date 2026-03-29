<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class MaintenanceSettings extends Settings
{
    public bool $maintenance_mode = false;
    public string $maintenance_message = '';

    public static function group(): string
    {
        return 'default';
    }
}
