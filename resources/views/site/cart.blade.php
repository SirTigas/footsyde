@extends('site.layouts.layout')

@section('conteudo')

<div class="container">
    <div style="margin: 30px 0px 0px 0px">
    <h3 style="text-align: center;"><b>SEU CARRINHO</b></h3>
        @foreach ($cartItems as $cart)
            @if (($cart->user_id) == Auth::id())
                <div class="col d-flex justify-content-center">
                    <div class="card mb-3" style="max-width: 1000px;">
                        <div class="row g-0">
                            <!-- Imagem -->
                            <div class="col-md-3">
                                <a href="{{ route('products.show', $cart->product->slug) }}">
                                    <img src="{{ $cart->product->image_path }}" class="img-fluid rounded-start" alt="{{ strtoupper($cart->product->name) }}">
                                </a>
                            </div>

                            <!-- Conteúdo -->
                            <div class="col-md-9">
                                <div class="card-body d-flex flex-column justify-content-between h-100">
                                    <div>
                                        <div class="d-flex justify-content-between align-items-center mt-2">
                                            <h5 class="card-title">
                                                <a href="{{ route('products.show', $cart->product->slug) }}" class="text-decoration-none text-dark">
                                                {{ strtoupper($cart->product->name) }}
                                                </a>
                                            </h5>
                                            <button type="button" class="btn-close" aria-label="Close"></button>
                                            
                                        </div><br>
                                        
                                        <p class="card-text">{{ $cart->product->description }}</p>
                                        <p class="card-text"><small class="text-muted">{{ $cart->product->fornecedor }}</small></p>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <b>R$ {{ number_format($cart->product->price, 2, ',', '.') }}</b>
                                        <input type="number" name="quantity" value="{{ $cart->quantity }}" class="form-control form-control-sm" style="width: 30px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            @endif
        @endforeach
    </div>
</div>

@endsection