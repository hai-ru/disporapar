<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColectingStore extends Model
{
    use HasFactory;

    protected $fillable = [
        "colecting_forms_id",
        "colecting_categories_id",
        "value",
        "attach_models",
        "attach_to",
    ];
}
