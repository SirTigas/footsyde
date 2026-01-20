<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    //show the view to chosen the payment method
    public function index()
    {
        //
        return view('checkout.payment_method');
    }

    //show view credit card method
    public function credit_card_index()
    {
        //
        return view('checkout.credit_card');
    }

    //show view pix method
    public function pix_index()
    {
        //
        return view('checkout.pix');
    }

    //return view success if all good and update the stock or redirect back
    public function finish_buy() {
        $products = CartItem::where('user_id', Auth::id())->get();
        $cart = $products->toArray();

        if($cart != NULL){
            foreach ($cart as $product) {
                $stock = ProductVariant::where('id', $product['size_id'])->first();
                if($stock){
                    $total = $stock->stock - $product['quantity'];
                    $stock->update([
                        'stock' => $total,
                    ]);
                }
            }
            return view('checkout.success');
        }return redirect()->route('carrinho.index');
    } 
}
