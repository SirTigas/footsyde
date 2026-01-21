<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductVariant extends Model
{
    //
    use HasFactory;

    protected $table = 'product_variants';
    
    protected $fillable = [
        'size',
        'product_id',
        'stock',
    ];

    ///defining relationship with products table
    public function size() {
        return $this->belongsTo(Product::class);
    }

    public function cart() {
        return $this->belongsTo(CartItem::class);
    }

    public function order(){
        return $this->belongsTo(OrderItem::class);
    }
}
