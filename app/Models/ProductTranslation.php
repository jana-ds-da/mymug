<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
       protected $fillable = [
        'mug_name',
        'description',
        'how_its_made',
    ];
}
