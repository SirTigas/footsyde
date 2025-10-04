@extends('site.layouts.layout')
@section('title', 'Detalhes')

@section('conteudo')
<div class="container">
    <div class="row" style="margin: 50px 0px 0px 0px">
        @if($product->image_path === $defaultThumbnail)
            <div class='col-4'>
                <div id="carouselExample" class="carousel slide">
                
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset($product->image_path) }}" class="d-block w-100" alt="..." style="border-radius: 30px">
                        </div>
                        @foreach ( $product->images as $path )
                            <div class="carousel-item" >
                                <img src="{{ asset('storage/'. $path->path) }}" class="d-block w-100" alt="$pa" style="border-radius: 30px">
                            </div>
                        @endforeach
                    </div>
                
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Avançar</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Voltar</span>
                    </button>
                </div>
            </div>
        
        @else
            <div class='col-4'>
                <div id="carouselExample" class="carousel slide">
                
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('storage/' . $product->image_path) }}" class="d-block w-100" alt="..." style="border-radius: 30px">
                        </div>
                        @foreach ( $product->images as $path )
                            <div class="carousel-item" >
                                <img src="{{ asset('storage/'. $path->path) }}" class="d-block w-100" alt="$pa" style="border-radius: 30px">
                            </div>
                        @endforeach
                    </div>
                
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Avançar</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Voltar</span>
                    </button>
                </div>
            </div>
        @endif

        <div class="col-8">
            <h3>{{ strtoupper($product->name) }}</h3>
            <br>
            <p>{{ $product->description }}</p>
            <p>Gênero: <b>{{ $product->category->name }}</b></p>
            <p>Vendido e entregue por: <b>{{ $product->fornecedor }}</b></p>
            <h1>R$ {{ number_format($product->price, 2, ',', '.') }}</h1>
            <p>
            @auth
                <div class="row">

                    {{--acomprar--}}
                    <form action="#">
                        @csrf
                        <div class="d-grid gap-2 col-6">
                            <a href="{{ route('site.checkout') }}" class="btn btn-success btn-lg"><i class="bi bi-currency-dollar"></i> <b>COMPRAR</b></a>
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
                <div class="d-grid gap-2 col-6">
                    <a href="{{ route('login') }}" class="btn btn-success btn-lg"><i class="bi bi-currency-dollar"></i><b>COMPRAR</b></a>
                
                    <a href="{{ route('login') }}" class="btn btn-primary"><i class="bi bi-cart-fill"></i> <b>CARRINHO</b></a>

                    <a href="{{ route('login') }}" class="btn btn-danger"><i class="bi bi-heart-fill"></i> <b>SALVAR</b></a>
                </div>            
                            
            @endauth
                
            
            </p>
        </div>
    </div>
</div>

@endsection