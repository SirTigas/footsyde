<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    //defining atributtes
    protected $fillable = [
        'quantity',
        'price',
        'discount',
        'order_id',
        'product_id',
    ];

    //relationships
    public function orders(){
        return $this->belongsTo(Order::class);
    }

    public function products(){
        return $this->belongsTo(Product::class);
    }
}
