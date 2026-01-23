<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\ProductVariant;
use App\Models\Order;
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
    public function finish_buy(Request $request) {
        $products = CartItem::where('user_id', Auth::id())->get();
        $cart = $products->toArray();
        // dd($request->status);

        if($cart != NULL){
            $i = true;
            while ($i) {
                $codeOrder = random_int(100000, 999999);
                $codeExists = Order::where('code', $codeOrder)->first();
                if($codeExists === null){
                    $i = false;
                }
            }
            foreach ($cart as $product) {
                $stock = ProductVariant::where('id', $product['size_id'])->first();
                
                if($stock){
                    // dd($stock->id);
                    $total = $stock->stock - $product['quantity'];
                    $stock->update([
                        'stock' => $total,
                    ]);
                    // dd($codeOrder);
                    $order = Order::create([
                        'size_id' => $stock->id,
                        'product_id' => $product['product_id'],
                        'user_id' => Auth::id(),
                        'code' => $codeOrder,
                        'quantity' => $product['quantity'],
                        'total_price' => $product['quantity'] * $product['price'],
                        'pc_price' => $product['price'],
                        'status' => $request->payment_method === 'pix' ? 'success' : 'analyzing',
                        'payment_method' => $request->payment_method,
                    ]);
                }
            }
            return view('checkout.success', compact('codeOrder'));
        }return redirect()->route('carrinho.index');
    }
    
    //show all user orders
    public function user_orders_show(){
        //
        $orders = Order::where('user_id', Auth::id())
        ->with('size', 'product')
        ->paginate(12);

        return view('site.my_orders', compact('orders'));
    }

}
