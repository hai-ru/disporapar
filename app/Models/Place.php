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
    public function kecamatan() {
        return $this->belongsTo(kecamatan::class);
    }

    public function alamat()
    {
        $alamat = $this->alamat;
        if(!empty($this->kecamatan)) $alamat .= "<br />Kec. ".ucwords($this->kecamatan->name);
        if(!empty($this->wilayah)) $alamat .= "<br />".$this->wilayah->name;
        $this->alamat = $alamat;
        return $this->alamat;   
    }
    
    public function address()
    {
        $alamat = $this->alamat;
        if(!empty($this->kecamatan)) $alamat .= "<br />Kec. ".ucwords($this->kecamatan->name);
        if(!empty($this->wilayah)) $alamat .= "<br />".$this->wilayah->name;
        $this->alamat = $alamat;
        return $this->alamat;   
    }
}
