<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Wishlist;
use App\Models\CartItem;
use App\Models\Review;
use App\Models\Order;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //show all list of product
    public function index()
    {
        $products = Product::paginate(12);

        return view('site.products', compact('products'));    
    }

    //filter products man
    public function man()
    {
        //
        $products = Product::where('category_id', '1')
        ->paginate(12);
        // $defaultThumbnail = "images/JD8-6364-058_zoom1.png";

        return view('site.products', compact('products'));
    }

    //filter products woman
    public function woman()
    {
        //
        $products = Product::where('category_id', '2')
        ->paginate(12);
        // $defaultThumbnail = "images/JD8-6364-058_zoom1.png";

        return view('site.products', compact('products'));
    }

    //filter products unissex
        public function unissex()
    {
        //
        $products = Product::where('category_id', '3')
        ->paginate(12);
        // $defaultThumbnail = "images/JD8-6364-058_zoom1.png";

        return view('site.products', compact('products'));
    }

    //search products
    public function search(Request $request)
    {
        //
        $products = Product::where('name', 'like', "%{$request->name}%")
        ->orderBy('name')
        ->paginate(12);

        return view('site.products', compact('products'));
    }

    //show the details of products
    public function show($code)
    {
        //recuperando dados da tabela "products" e outras relacionadas
        $product = Product::where('code', $code)
        ->with(['category', 'images', 'sizes'])
        ->first();

        //recuperando dados da tabela "review"
        $reviews = Review::where('product_id', $product->id)->paginate(5);
        
        //calculando a média das avaliações
        $avarageReview = Review::where('product_id', $product->id)->sum('rating');
        $avarageReview = $avarageReview / ($reviews->total() > 0 ? $reviews->total() : 1);
        // dd($avarageReview);

        $orders = Order::where('user_id', Auth::id())->where('product_id', $product->id)->first();

        $existsReview = Review::where('user_id', Auth::id())->where('product_id', $product->id)->first();
        // dd($existsReview);
        
        //verificando se o produto existe na base de dados
        if ($product)
        {
            //verificando se o usuário está logado. Aqui é feita também a verificação se o produto já se encontra na lista de favoritos ou no carrinho de compra do usuário
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

                return view('site.product_details', compact('product', 'isInCart', 'isInList', 'reviews', 'existsReview', 'avarageReview' , 'orders'));}
            else
                return view('site.product_details', compact('product', 'reviews', 'existsReview', 'avarageReview' , 'orders'));
        }       
        return redirect()->route('products.index');
    }
}
