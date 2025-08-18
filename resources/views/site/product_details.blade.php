@extends('site.layouts.layout')
@section('title', 'Detalhes')

@section('conteudo')
<div class="container">
    <div class="row" style="margin: 50px 0px 0px 0px">
        <div class='col-4'>
            <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" style="width: 400px; border-radius: 20px">
        </div>

        <div class="col-8" style="margin: 0px 0px 0px 0px">
            <h3>{{ strtoupper($product->name) }}</h3>
            <br>
            <p>{{ $product->description }}</p>
            <p>Vendido e entregue por: <b>{{ $product->fornecedor }}</b></p>
            <h1>R$ {{ number_format($product->price, 2, ',', '.') }}</h1>
            <br>
            <p>
            @auth
                <form action="{{ route('cartitem.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <label for="quant">QNTD: </label>
                    <input type="number" name="quantity" value="01" class="form-control form-control-sm" style="width: 30px;" id="quant"><br>
                    
                    <a href="#" class="btn btn-warning" style="margin: 0px 20px 0px 0px"><b>COMPRAR</b></a>
                    @if ($isInCart)
                        <a href="{{ route('site.cart') }}" class="btn btn-primary"><b>+CARRINHO</b></a>
                    @else
                        <button type="submit" class="btn btn-primary"><b>+CARRINHO</b></button>
                    @endif
                                    
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-warning" style="margin: 0px 20px 0px 0px"><b>COMPRAR</b></a> <a href="{{ route('login') }}" class="btn btn-primary"><b>+CARRINHO</b></a>            
                            
            @endauth
                
            
            </p>
        </div>
    </div>
</div>

@endsection