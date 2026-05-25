<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'featured_image',
        'tech_stack',
        'github_link',
        'live_link',
        'gallery',
        'category',
        'order',
        'is_featured',
        'is_published',
        'meta_title',
        'meta_description',
        'sub_images',
    ];

    protected $casts = [
        'tech_stack' => 'array',
        'gallery' => 'array',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'sub_images' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($portfolioItem) {
            if (empty($portfolioItem->slug)) {
                $portfolioItem->slug = \Illuminate\Support\Str::slug($portfolioItem->title);
            }
        });
    }
}
