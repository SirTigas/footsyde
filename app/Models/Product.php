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

    //relationships
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
