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
        $wishlistItems = Wishlist::with([
            'product:id,name,price,image_path,slug,description,fornecedor'
        ])
        ->where('user_id', Auth::id())
        ->orderByDesc('id')
        ->paginate(10);

        //$user = Wishlist::where('user_id', Auth::id())->get();

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
        $wishlist = $request->all();
        $wishlist['user_id'] = Auth::id();
        $wishlist = Wishlist::create($wishlist);

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
    public function destroy(Request $request)
    {
        //
        Wishlist::destroy($request->id);
        return redirect()->back();
    }

    public function clear()
    {
        //
        $list = Wishlist::where('user_id', Auth::id())->get();
        Wishlist::destroy($list);
        return redirect()->back();
    }
}
