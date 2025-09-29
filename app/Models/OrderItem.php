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

    //defining relationship
    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
