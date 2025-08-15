@extends('site.layouts.layout')
@section('title', 'Detalhes')

@section('conteudo')
<div class="container">
    <div class="row" style="margin: 50px 0px 0px 0px">
        <div class='col-4'>
            <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" style="width: 400px; border-radius: 20px">
        </div>

        <div class="col-8" style="margin: 50px 0px 0px 0px">
            <h3>{{ strtoupper($product->name) }}</h3>
            <br>
            <p>{{ $product->description }}</p>
            <p>Vendido e entregue por: <b>{{ $product->fornecedor }}</b></p>
            <h1>R$ {{ number_format($product->price, 2, ',', '.') }}</h1>
            <br>
            <p>
            <button class="btn btn-warning" style="margin: 0px 30px 0px 0px">COMPRAR</button>
            <form action="{{ route('cartitem.store') }}" method="POST">
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <input type="hidden" name="quantity" value="{{ $product->stock }}">
                
                @auth
                    <button type="submit" class="btn btn-primary">+CARRINHO</button>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">+CARRINHO</a>
                @endauth
            </form>
            
            </p>
        </div>
    </div>
</div>

@endsection