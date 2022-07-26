<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class config extends Model
{
    use HasFactory;

    protected $casts = [
        'social_media' => 'array',
        'menus' => 'array',
    ];

    protected $fillable = [
        "video_url",
        "social_media",
        "seo_title",
        "seo_description",
        "summary",
        "menus",
    ];
}
