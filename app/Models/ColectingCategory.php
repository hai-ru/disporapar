<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColectingCategory extends Model
{
    use HasFactory;

    public function collecting_form()
    {
        return $this->hasMany(ColectingForm::class,"colecting_category_id","id");
    }
}
