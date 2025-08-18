<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //getting data from the products table
        $cartItems = CartItem::with([
            'product:id,name,price,image_path,slug,description,fornecedor'
        ])
        ->where('user_id', Auth::id())
        ->orderByDesc('id')
        ->paginate(10)
        ->withQueryString();


        //return the total price of cart-list
        $total = $cartItems->getCollection()->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return view('site.cart', compact('cartItems', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cart = $request->all();
        $cart['user_id'] = Auth::id();
        $cart = CartItem::create($cart);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $id)
    {
        //
        CartItem::destroy($id->id);
        return redirect()->back();
    }

    public function clear()
    {
        //
        $cart = CartItem::where('user_id', Auth::id())->get();
        CartItem::destroy($cart);
        return redirect()->back();

    }
}
