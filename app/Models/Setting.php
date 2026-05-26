<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
    ];

    /**
     * Cache key for all settings.
     */
    protected static string $cacheKey = 'app_settings_all';

    /**
     * Cache duration in seconds (24 hours).
     */
    protected static int $cacheTtl = 86400;

    /**
     * Get a setting value by key.
     * Loads ALL settings in one query, caches for 24 hours.
     */
    public static function get($key, $default = null)
    {
        $settings = Cache::remember(static::$cacheKey, static::$cacheTtl, function () {
            return static::pluck('value', 'key')->toArray();
        });

        return $settings[$key] ?? $default;
    }

    /**
     * Set a setting value and flush the cache.
     */
    public static function set($key, $value, $type = 'text', $group = 'general')
    {
        $result = static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => $type, 'group' => $group]
        );

        Cache::forget(static::$cacheKey);

        return $result;
    }

    /**
     * Flush the settings cache manually.
     */
    public static function flushCache(): void
    {
        Cache::forget(static::$cacheKey);
    }
}
