@extends('site.layouts.layout')
@section('title', 'Carrinho')

@section('conteudo')

<div class="container">
    <div style="margin: 30px 0px 0px 0px">
        
        
        @if ($total > 0)                       
            <h1 style="text-align: center;"><b>SEU CARRINHO</b></h1>
            
            <!--LIMPANDO TODO O CARRINHO-->            
            <form action="{{ route('cart.clear') }}" method="POST" class="d-flex justify-content-center" style="margin: 0px 0px 10px 0px">
                @csrf
                <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i> <b>REMOVER TODOS</b></button>
            </form>
            
        @else
            <h1 style="text-align: center;"><b>SEU CARRINHO</b></h1>            
        @endif

        @foreach ($cartItems as $cart)
            @if (($cart->user_id) == Auth::id())
                <div class="col d-flex justify-content-center">
                    <div class="card mb-3" style="max-width: 900px;">
                        <div class="row g-0">
                            <!-- Imagem -->
                            <div class="col-md-3">
                                @php
                                    $pathImage = $cart->product->image_path;
                                    if (Storage::disk('public')->exists($pathImage)){
                                        $imageSrc = asset('storage/' . $pathImage);
                                    } else {
                                        $imageSrc = $pathImage;
                                    }

                                @endphp

                                <a href="{{ route('products.show', $cart->product->code) }}">
                                    <img src="{{ $imageSrc }}" class="img-fluid rounded-start" alt="{{ strtoupper($cart->product->name) }}">
                                </a>   
                            </div>

                            <!-- Conteúdo -->
                            <div class="col-md-9">
                                <div class="card-body d-flex flex-column justify-content-between h-100">
                                    <div>
                                        <div class="d-flex justify-content-between align-items-center mt-2">
                                            <h5 class="card-title">
                                                <a href="{{ route('products.show', $cart->product->code) }}" class="text-decoration-none text-dark">
                                                {{ strtoupper($cart->product->name) }}
                                                </a>
                                            </h5>

                                            <form action="{{ route('carrinho.destroy', $cart->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-close" aria-label="Close"></button>
                                            </form>                                                                                        
                                        </div><br>
                                        
                                        <p class="card-text">{{ Str::limit($cart->product->description, 150) }}</p>
                                        <p class="card-text"><small class="text-muted">{{ $cart->product->fornecedor }}</small></p>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <b>R$ {{ number_format($cart->product->price, 2, ',', '.') }}</b>                                    
                                        <form action="{{ route('carrinho.update', $cart->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="bi bi-arrow-clockwise" style="margin:0px 10px 0px 0px; border-radius: 05px"></button>
                                                <input type="number" name="quantity" value="{{ $cart->quantity }}" class="form-control form-control-sm" style="width: 30px;">
                                            </div>
                                        </form>                                             
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            @endif
        @endforeach

        @if ($total > 0)        
            <div class="col d-flex justify-content-center">
                <h1>TOTAL: <b>R$ {{ number_format($total, 2, ',', '.') }}</b></h1>
            </div>
        @else
            <h5  style="text-align: center;">VAZIO!</h5>
        @endif
       
    </div>
</div>

@endsection