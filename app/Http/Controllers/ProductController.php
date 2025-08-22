<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(12);

        return view('site.products', compact('products'));    
    }

    public function man()
    {
        //
        $products = Product::where('category_id', '1')
        ->paginate(12);

        return view('site.products', compact('products'));
    }

    public function woman()
    {
        //
        $products = Product::where('category_id', '2')
        ->paginate(12);

        return view('site.products', compact('products'));
    }

        public function unissex()
    {
        //
        $products = Product::where('category_id', '3')
        ->paginate(12);

        return view('site.products', compact('products'));
    }

    public function search(Request $request)
    {
        //
        $products = Product::where('name', 'like', "{$request->name}%")
        ->paginate(12);
        return view('site.products', compact('products'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        //
        $product = Product::where('slug', $slug)->with(['category'])->first();

        if (Auth::check()){
            $cart = CartItem::where('user_id', Auth::id())->where('product_id', $product->id)->first();
            $wishlist = Wishlist::where('user_id', Auth::id())->where('product_id', $product->id)->first();

            if ($cart != NULL)
                $isInCart = TRUE;
            else
                $isInCart = FALSE;

            if ($wishlist != NULL)
                $isInList = TRUE;
            else
                $isInList = FALSE;

            return view('site.product_details', compact('product', 'isInCart', 'isInList'));}
        else
            return view('site.product_details', compact('product'));

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
    public function destroy(string $id)
    {
        //
    }
}
