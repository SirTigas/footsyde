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
                    <div class="card mb-3">
                        <div class="row g-0">
                            <!-- IMAGEM -->
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

                            <!-- CONTEÚDO -->
                            <div class="col-md-9">
                                <div class="card-body d-flex flex-column justify-content-between h-100">
                                    <div class="row">
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
                                        
                                        <div class="row">
                                            <div class="col">
                                                <p class="card-text">{{ Str::limit($cart->product->description, 150) }}</p>

                                                <p class="card-text">Fornecedor: <small class="text-muted">{{ $cart->product->fornecedor }}</small></p>
                                            </div>
                                        </div>
                                    </div>
                                    <h3>R$ {{ number_format($cart->product->price, 2, ',', '.') }}</h3>
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                                                            
                                        <form action="{{ route('carrinho.update', $cart->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="d-flex justify-content-end ">
                                                <div class="mb-2">
                                                    <select name="size_id" class="form-select">
                                                        <option value="{{ $cart->size->id }}">Tamanho {{ $cart->size->size }} - ({{$cart->size->stock}} Unidades disponíveis)</option>
                                                        @foreach ($shoeSizes as $size )
                                                            @if ($cart->size->product_id === $size->product_id && $size->size != $cart->size->size && $size->stock >= 1)
                                                                <option value="{{ $size->id }}">Tamanho {{ $size->size }} - ({{$size->stock}} Unidades disponíveis)</option>  
                                                            @endif
                                                        @endforeach
                                                    </select><br>

                                                    <div class="input-group col-auto">
                                                        <div class="col-auto">
                                                            <input type="number" class="form-control" value="{{ $cart->quantity }}" placeholder="Quantidade: {{ $cart->quantity }}" name="quantity">
                                                        </div>
                                                        <button type="submit" class="btn btn-primary input-group-text"><i class="bi bi-floppy"></i></i></button>
                                                    </div>
                                                </div>
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
            <div class="container px-4 text-center">
            <div class="row gx-5">
                <div class="col">
                    <div class="p-3">
                        <h1>TOTAL: <b>R$ {{ number_format($total, 2, ',', '.') }}</b></h1>
                    </div>
                </div>
                @if(Auth::user()->email_verified_at != NULL)
                    <div class="col">
                        <div class="p-3">
                            <a href="{{ route('checkout') }}" class="btn btn-success btn-lg">
                                <b>FINALIZAR COMPRA</b> <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @else
                    <div class="col">
                        <div class="p-3">
                            <a href="{{ route('profile.edit') }}" class="btn btn-warning btn-lg">
                                <b>VERIFICAÇÃO DE EMAIL NECESSÁRIA!</b> <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
            </div>
        @else
            <h5  style="text-align: center;">VAZIO!</h5>
        @endif
       
    </div>
</div>

@endsection