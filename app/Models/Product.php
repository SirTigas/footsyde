<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'name', 
        'price', 
        'description', 
        'stock', 
        'image_path', 
        'slug',
        'category_id',
    ];

    //relationships
    public function categories(){
        return $this->belongsTo(Category::class);
    }
}
