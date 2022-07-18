<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $casts = [
        'google_places_api' => 'array',
        'photos' => 'array',
    ];

    protected $fillable = [
        'name',
        'slug',
        'phone',
        'location',
        'rating',
        'photos',
        'description',
        'views',
        'google_places_api',
        "category_place_id",
        "wilayah_id",
        "alamat",
        "active",
        "kecamatan_id",
    ];

    public function category_place() {
        return $this->belongsTo(CategoryPlace::class);
    }
    public function wilayah() {
        return $this->belongsTo(Wilayah::class);
    }
}
