<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;


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

    public function photo_index()
    {
        $products = Product::orderBy('name')
        ->with(['images'])
        ->paginate(12);

        return view('admin.dashboard_photos', compact('products'));
    }

    public function search_edit(Request $request)
    {
        //
        $products = Product::where('name', 'like', "%{$request->name}%")
        ->Orwhere('code', 'like', "%{$request->name}%")
        ->orderBy('name')
        ->paginate(5);

        return view('admin.dashboard', compact('products'));
        //return back()->with(compact('products'));
    }

    public function search_photos(Request $request)
    {
        //
        $products = Product::where('name', 'like', "%{$request->name}%")
        ->Orwhere('code', 'like', "%{$request->name}%")
        ->orderBy('name')
        ->paginate(5);

        return view('admin.dashboard_photos', compact('products'));
        //return back()->with(compact('products'));
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
        //validate input datas
        $credentials = $request->validate([
            'name' => ['required'], 
            'price' => ['required', 'numeric', 'min:1'],  
            'stock' => ['required', 'numeric', 'min:1'],  
            'category_id' => ['required'],  
            'fornecedor' => ['required'],  
            'thumbnail' => ['required', 'image', 'max:2048', 'dimensions:width=360,height=360', 'mimes:jpeg,png,jpg'],
            'images' => ['array', 'max:5'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg', 'max:2048', 'dimensions:width=360,height=360']
        ], [
            'name.required' => 'O nome do produto é obrigatório!',

            'price.required' => 'Preço é obrigatório e deve ser no minimo R$1.00!',
            'price.numeric' => 'Preço deve ser numérico!',
            'price.min' => 'Preço mínimo é de 1 real!',

            'stock.required' => 'Estoque é obrigatório e deve ser no mínimo 1!',
            'stock.numeric' => 'Estoque deve ser numérico!',
            'stock.min' => 'Estoque deve ser no mínimo 1!',

            'category_id.required' => 'A categoria do produto é obrigatório!',

            'fornecedor.required' => 'O nome do Fornecedor do produto é obrigatório!',

            'thumbnail.required' => 'A imagem da capa do produto é obrigatório!',
            'thumbnail.image' => 'A imagem da capa é inválida!',
            'thumbnail.max' => 'A imagem da capa não pode ultrapassar 2mb!',
            'thumbnail.dimensions' => 'A imagem da capa deve ter exatamente 360x360 px!',
            'thumbnail.mimes' => 'A imagem da capa deve ser (jpeg, png, jpg)',

            'images.max' => 'O carrossel suporta no máximo 5 imagens + capa!',

            'images.*.image' => 'A imagem do carrossel é inválida!',
            'images.*.max' => 'A imagem do carrossel não pode ultrapassar 2mb!',
            'images.*.dimensions' => 'A imagem do carrossel deve ter exatamente 360x360 px!',
            'images.*.mimes' => 'A imagem do carrossel deve ser (jpeg, png, jpg)',    
        ],);

        //create new product
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'fornecedor' => $request->fornecedor,
            'code' => rand(1000, 9999),
        ]);

        $productName = $product->name;
        $idProduct = $product->id;
        $code = $product->code;
        $dir = "images/products/{$code}/";
        $thumbanail = $request->file('thumbnail');
        $thumbName = "{$code}-Thumbanil.".$thumbanail->getClientOriginalExtension();
        $images = $request->file('images');
        $count = 1;

        //thumbnail create dir
        Storage::disk('public')->putFileAs($dir, $thumbanail, $thumbName);
        $newProduct = Product::where('id', $product->id)
        ->update([
            'image_path' => "{$dir}{$thumbName}",
        ]);

        //carousel create dir
        if ($images != NULL){
            foreach ($images as $img){
                $imgName = "{$code}-image($count).".$img->getClientOriginalExtension();
                Storage::disk('public')->putFileAs($dir, $img, $imgName);
                $imgs = ProductImage::create([                
                    'product_id' => $product->id,
                    'path' => "{$dir}{$imgName}",
                ]);
                $count++;
            };
        }
        return redirect()->back()->with('msm', "O produto {$productName} - código ({$code}) - foi adicionado com sucesso!");
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
    public function edit(Request $request)
    {
        //validate input datas
        $credentials = $request->validate([
            'name' => ['required'],     
            'thumbnail' => ['image', 'max:2048', 'dimensions:width=360,height=360', 'mimes:jpeg,png,jpg'],
            'images' => ['array', 'max:5'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg', 'max:2048', 'dimensions:width=360,height=360']
        ], [
            'name.required' => 'O nome do produto é obrigatório!',

            'thumbnail.image' => 'A imagem da capa inválida!',
            'thumbnail.max' => 'A imagem da capa não pode ultrapassar 2mb!',
            'thumbnail.dimensions' => 'A imagem da capa deve ter exatamente 360x360 px!',
            'thumbnail.mimes' => 'A imagem da capa deve ser (jpeg, png, jpg)',

            'images.max' => 'O carrossel suporta no máximo 5 imagens + capa!',

            'images.image' => 'A imagem do carrossel inválida!',
            'images.max' => 'A imagem do carrossel não pode ultrapassar 2mb!',
            'images.dimensions' => 'A imagem do carrossel deve ter exatamente 360x360 px!',
            'images.mimes' => 'A imagem do carrossel deve ser (jpeg, png, jpg)',
            
        ],);

        $thumbanail = $request->file('thumbnail');
        $images = $request->file('images');

        if (($thumbanail || $images)){

            $productName = $request->name;
            $code = $request->code;
            $id = $request->id;
            $dir = "images/products/{$code}/";
            $count = 1;

            //thumbnail edit image
            if ($thumbanail != NULL){
                $thumbName = "{$code}-Thumbanil.".$thumbanail->getClientOriginalExtension();
                Storage::disk('public')->putFileAs($dir, $thumbanail, $thumbName);
                $thumbEdit = Product::where('id', $id)
                ->update([
                    'image_path' => "{$dir}{$thumbName}",
                ]);
            }

            //carousel edit images
            if ($images != NULL){
                //delete old carousel
                ProductImage::where('product_id', $id)->delete();

                foreach ($images as $img){
                    //create new carousel
                    $imgName = "{$code}-image($count).".$img->getClientOriginalExtension();
                    Storage::disk('public')->putFileAs($dir, $img, $imgName);
                    $newCarousel = ProductImage::Create([                
                        'product_id' => $id,
                        'path' => "{$dir}{$imgName}",
                    ]);
                    $count++;
                };
            }
            return redirect()->back()->with('msm', "O produto {$productName} - código ({$code}) - foi alterado com sucesso!");
        } else {
            return redirect()->back()->with('msm', "Nenhuma modificação realizada!");
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //update product info
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
        //Delete all products of the DB
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
