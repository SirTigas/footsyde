<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name', 
        'price', 
        'description', 
        'stock', 
        'image_path', 
        'slug',
        'fornecedor',
        'category_id',
        'code',
    ];

    //defining relationship

    //categories table
    public function category(){
        return $this->belongsTo(Category::class);
    }

    //images of the carousel product_images table
    public function images(){
        return $this->hasMany(ProductImage::class);
    }

    //size shoes
    public function sizes(){
        return $this->hasMany(ProductVariant::class);
    }
}
