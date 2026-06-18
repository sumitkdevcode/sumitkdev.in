<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'platform',
        'content',
        'media_url',
        'media_type',
        'permalink',
        'published_at',
        'is_published',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($post) {
            \Illuminate\Support\Facades\Cache::forget('social_posts_v2');
        });

        static::deleted(function ($post) {
            \Illuminate\Support\Facades\Cache::forget('social_posts_v2');
        });
    }
}
