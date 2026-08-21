<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = [

        'mug_name',
        'price',
        'category',
        'image_path',
        'description',
        'capacity',
        'how_its_made',
        'microwave',

    ];

    protected $casts = [
        'price' => 'decimal:2',
        'microwave' => 'boolean',
    ];


    public function cartItems()
    {

      return $this->hasMany(CartItem::class);
    }



}
