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
        'category_id',
    ];

    //relationships
    public function categories(){
        return $this->belongsTo(Category::class);
    }
}
