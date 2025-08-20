@extends('site.layouts.layout')
@section('title', 'Detalhes')

@section('conteudo')
<div class="container">
    <div class="row" style="margin: 50px 0px 0px 0px">
        <div class='col-4'>
            <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" style="width: 400px; border-radius: 20px">
        </div>

        <div class="col-8">
            <h3>{{ strtoupper($product->name) }}</h3>
            <br>
            <p>{{ $product->description }}</p>
            <p>Vendido e entregue por: <b>{{ $product->fornecedor }}</b></p>
            <h1>R$ {{ number_format($product->price, 2, ',', '.') }}</h1>
            <p>
            @auth
                <div class="row">

                    {{--acomprar--}}
                    <form action="#">
                        @csrf
                        <div class="d-grid gap-2 col-6">
                            <a href="#" class="btn btn-success btn-lg"><i class="bi bi-currency-dollar"></i> <b>COMPRAR</b></a>
                        </div>
                    </form>
                    
                    
                    {{--salvando no carrinho--}}
                    <form action="{{ route('cartitem.store') }}" method="POST" style="margin: 10px 0px 10px 0px">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <input type="hidden" name="quantity" value="01" class="form-control form-control-sm" style="width: 30px;" id="quant">                
                    
                        @if ($isInCart)
                            <div class="d-grid gap-2 col-6">
                                <a href="{{ route('site.cart') }}" class="btn btn-primary">
                                    <i class="bi bi-cart-fill"></i> <b>CARRINHO</b>
                                </a>
                            </div>
                        @else
                            <div class="d-grid gap-2 col-6">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-cart-fill"></i> <b>CARRINHO</b></button>
                            </div>
                        @endif
                    
                    </form>

                    {{--salvando nos favoritos--}}
                    <form action="{{ route('favitem.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        @if ($isInList)
                            <div class="d-grid gap-2 col-6">
                                <a href="{{ route('site.wishlist') }}" class="btn btn-danger"><i class="bi bi-heart-fill"></i> <b>SALVAR</b></a>
                            </div>
                        @else
                            <div class="d-grid gap-2 col-6">
                                <button type="submit" class="btn btn-danger"><i class="bi bi-heart-fill"></i> <b>SALVAR</b></button>
                            </div>
                        @endif
                    
                    </form>

                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-success btn-lg" style="margin: 0px 20px 0px 0px"><i class="bi bi-currency-dollar"></i><b>COMPRAR</b></a>
                
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg" style="margin: 0px 20px 0px 0px"><i class="bi bi-cart-fill"></i> <b>CARRINHO</b></a>

                <a href="{{ route('login') }}" class="btn btn-danger btn-lg"><i class="bi bi-heart-fill"></i> <b>SALVAR</b></a>            
                            
            @endauth
                
            
            </p>
        </div>
    </div>
</div>

@endsection