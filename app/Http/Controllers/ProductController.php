<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
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
        $defaultThumbnail = "images/JD8-6364-058_zoom1.png";

        return view('site.products', compact('products', 'defaultThumbnail'));    
    }

    //filter products man
    public function man()
    {
        //
        $products = Product::where('category_id', '1')
        ->paginate(12);
        $defaultThumbnail = "images/JD8-6364-058_zoom1.png";

        return view('site.products', compact('products', 'defaultThumbnail'));
    }

    //filter products woman
    public function woman()
    {
        //
        $products = Product::where('category_id', '2')
        ->paginate(12);
        $defaultThumbnail = "images/JD8-6364-058_zoom1.png";

        return view('site.products', compact('products', 'defaultThumbnail'));
    }

    //filter products unissex
        public function unissex()
    {
        //
        $products = Product::where('category_id', '3')
        ->paginate(12);
        $defaultThumbnail = "images/JD8-6364-058_zoom1.png";

        return view('site.products', compact('products', 'defaultThumbnail'));
    }

    //search products
    public function search(Request $request)
    {
        //
        $products = Product::where('name', 'like', "%{$request->name}%")
        ->orderBy('name')
        ->paginate(12);
        $defaultThumbnail = "images/JD8-6364-058_zoom1.png";

        return view('site.products', compact('products', 'defaultThumbnail'));
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
    public function show($code)
    {
        //
        $product = Product::where('code', $code)
        ->with(['category', 'images'])
        ->first();
        $defaultThumbnail = "images/JD8-6364-058_zoom1.png";

        if ($product)
        {
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

                return view('site.product_details', compact('product', 'isInCart', 'isInList', 'defaultThumbnail'));}
            else
                return view('site.product_details', compact('product', 'defaultThumbnail'));
        }else
            return redirect()->route('produtos.index');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
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
