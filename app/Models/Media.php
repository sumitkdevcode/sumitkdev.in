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
}
