<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_code', 
        'name', 
        'description', 
        'price', 
        'discount'
    ];

    public function extraFields()
    {
        return $this->hasMany(ProductExtraField::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
