<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumeTraining extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'organization',
        'date_range',
        'order',
        'is_visible',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
    ];

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('created_at', 'desc');
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('resume_trainings');
        });

        static::deleted(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('resume_trainings');
        });
    }
}