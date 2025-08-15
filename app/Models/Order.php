<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //defining atributtes
    protected $fillable = [
        'total_price', 
        'status', 
        'payment_status', 
        'shipping_address', 
        'shipping_status', 
        'note',
        'user_id',
    ];

    //defining relationship
    public function user(){
        return $this->belongsTo(User::class);
    }
}
