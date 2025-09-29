<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    protected $fillable = [
        'rating',
        'comment',
        'user_id',
        'product_id',
    ];

    //defining relationship

    //users table
    public function user(){
        return $this->belongsTo(User::class);
    }

    //products table
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
