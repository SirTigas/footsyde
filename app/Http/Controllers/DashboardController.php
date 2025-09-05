<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('name')
        ->paginate(12);

        return view('admin.dashboard', compact('products'));
    }

    public function search(Request $request)
    {
        //
        $products = Product::where('name', 'like', "%{$request->name}%")
        ->Orwhere('code', 'like', "%{$request->name}%")
        ->orderBy('name')
        ->paginate(5);

        return view('admin.dashboard', compact('products'));
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
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'image_path' => $request->thumbnail,
            'fornecedor' => $request->fornecedor,
            'code' => rand(1000, 9999),
        ]);

        return redirect()->back()->with('success', "O produto {$product->name} - código ({$product->code}) - foi adicionado com sucesso!");
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
    public function update(Request $request)
    {
        //
        Product::where('id', $request->id)
        ->update([
              'name' => $request->name,  
              'price' => $request->price,  
              'description' => $request->description,
              'stock' => $request->stock,   
              'fornecedor' => $request->fornecedor,          
              'category_id' => $request->category_id,          
        ]);

        return redirect()->back()->with('success', 'As modificações foram aplicadas!');
    }

    public function clear()
    {
        $products = Product::all();
        Product::destroy($products);
        return redirect()->back()->with('succes', 'Todos os produtos do E-commerce foram apagados!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        $product = Product::where('code', $request->code)->first();
        $id = Product::where('code', $request->code)->first();
        if($id)
        {
            Product::destroy($id->id);
            return redirect()->back()->with('success', "Produto: {$product->name} - ({$request->code}) removido com sucesso!");
        }else
            return redirect()->back()->with('erro', "Código {$request->code} não encontrado no banco de dados!");
        
    }
}
