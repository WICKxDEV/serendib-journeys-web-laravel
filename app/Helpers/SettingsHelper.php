<?php

namespace App\Helpers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingsHelper
{
    /**
     * Get a setting value.
     *
     * Retrieves all settings from cache, or loads and caches them from the database.
     * Then returns the value for the requested key.
     */
    public static function get($key, $default = null)
    {
        $settings = Cache::rememberForever('settings', function () {
            return Setting::all()->pluck('value', 'key')->all();
        });

        return $settings[$key] ?? $default;
    }

    /**
     * Clear the settings cache.
     */
    public static function clearCache()
    {
        Cache::forget('settings');
    }

    /**
     * Get all settings as an array
     */
    public static function all()
    {
        return Setting::getAllAsArray();
    }

    /**
     * Get settings by group
     */
    public static function getByGroup($group)
    {
        return Setting::getByGroup($group);
    }

    /**
     * Set a setting value
     */
    public static function set($key, $value, $type = 'text', $group = 'general', $label = null, $description = null)
    {
        return Setting::set($key, $value, $type, $group, $label, $description);
    }
} 