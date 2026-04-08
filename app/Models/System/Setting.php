<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['group', 'name', 'type', 'value', 'default', 'meta'])]
class Setting extends Model
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'value' => 'array',
            'default' => 'array',
            'meta' => 'array',
        ];
    }

    protected static function booted()
    {
        static::updated(function ($setting) {
            Cache::forget('setting.' . $setting->name);
        });

        static::deleted(function ($setting) {
            Cache::forget('setting.' . $setting->name);
        });
    }

    public function get($name, $default = null)
    {
        return Cache::remember('setting.' . $name, config('common.cache_time') ?? 60, function () use ($name, $default) {
            return $this->firstOrCreate(['name' => $name], ['value' => $default, 'default' => $default])?->value;
        });
    }

    public function set($name, $value)
    {
        $this->updateOrCreate(['name' => $name], ['value' => $value]);
        Cache::forget('setting.' . $name);
    }
}
