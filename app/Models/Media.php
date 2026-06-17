<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'file_path',
        'file_type',
        'mime_type',
        'file_size',
        'category',
        'tags',
        'order',
        'is_featured',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_featured' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($media) {
            \Illuminate\Support\Facades\Cache::forget('home_gallery_images');
        });

        static::deleted(function ($media) {
            \Illuminate\Support\Facades\Cache::forget('home_gallery_images');
        });
    }
}
