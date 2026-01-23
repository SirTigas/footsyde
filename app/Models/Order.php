<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //defining atributtes
    protected $fillable = [
        'total_price', 
        'pc_price', 
        'quantity', 
        'status', 
        'payment_method', 
        'product_id', 
        'size_id',  
        'user_id',
        'code',
    ];

    //defining relationship
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function size(){
        return $this->belongsTo(ProductVariant::class);
    }
}
