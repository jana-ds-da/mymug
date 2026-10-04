<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Product extends Model implements TranslatableContract
{
    use Translatable;
    public $translatedAttributes = [
        'mug_name',
        'description',
        'how_its_made',
    ];
    protected $fillable = [

        'mug_name',
        'price',
        'category_id',
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

    public function category()
    {

        return $this->belongsTo(Category::class);
    }

    public function getImageUrlAttribute()
    {
         return str_starts_with($this->image_path, 'img/')
            ? asset($this->image_path)
            : asset('storage/' . $this->image_path);
    }

}
