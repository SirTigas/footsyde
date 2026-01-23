<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        //import whishlists table with products table
        $wishlistItems = Wishlist::with([
            'product:id,name,price,image_path,code,description,fornecedor'
        ])
        ->where('user_id', Auth::id())
        ->orderByDesc('id')
        ->paginate(10);

        //checking if the user has an item on the wishlist
        if (empty(Wishlist::where('user_id', Auth::id())->get()->toArray()))
            $user = FALSE;
        else
            $user = TRUE;
        
        return view('site.wishlist', compact('wishlistItems', 'user'));
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
        //add new item to wishlist
        $wishlist = $request->all();
        $wishlist['user_id'] = Auth::id();
        $wishlist = Wishlist::create($wishlist);

        return redirect()->back()->with('success', 'O produto foi adicionado aos favoritos!');
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
    public function destroy(String $id)
    {
        //delete specified item on the wishlist
        Wishlist::destroy($id);
        return redirect()->back();
    }

    public function clear()
    {
        //delete all items on the wishlist
        $list = Wishlist::where('user_id', Auth::id())->get();
        Wishlist::destroy($list);
        return redirect()->back();
    }
}
