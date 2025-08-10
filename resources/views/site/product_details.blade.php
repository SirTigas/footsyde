@extends('site.layouts.layout')
@section('title', 'Detalhes')

@section('conteudo')
<div class="container">
    <div class="row" style="margin: 50px 0px 0px 0px">
        <div class='col-4'>
            <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" style="width: 400px">
        </div>

        <div class="col-8" style="margin: 50px 0px 0px 0px">
            <h3>{{ strtoupper($product->name) }}</h3>
            <br>
            <p>{{ $product->description }}</p>
            <h1>R$: {{ $product->price }}</h1>
            <br>
            <p>
            <button class="btn btn-warning" style="margin: 0px 30px 0px 0px">COMPRAR</button>
            <button class="btn btn-primary">+CARRINHO</button>
            </p>
        </div>
    </div>
</div>

@endsection