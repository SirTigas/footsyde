@extends('site.layouts.layout')
@section('title', 'Detalhes')

@section('conteudo')
<div class="container">
    <div class="row" style="margin: 50px 0px 0px 0px">

        {{-- carrossel onde é exibido todas as fotos dos produtos --}}
        <div class='col-4'>
            <div id="carouselExample" class="carousel slide">
            
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('storage/'. $product->image_path) }}" class="d-block w-100" alt="..." style="border-radius: 30px">
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
        
        <div class="col-8">
            <h3>{{ strtoupper($product->name) }}</h3>
            <br>
            <p>{{ $product->description }}</p>
            <p>Gênero: <b>{{ $product->category->name }}</b></p>
            <p>Vendido e entregue por: <b>{{ $product->fornecedor }}</b></p>
            <h1>R$ {{ number_format($product->price, 2, ',', '.') }}</h1>
            <p>
            {{-- Aqui ocorre a verificação se o usuário está logado para prosseguir com a compra, adicionar ao carrinho ou lista de favoritos, caso contrário é redirecionado para tela de login --}}
            @auth
                <div class="row">

                    {{--salvando no carrinho--}}
                    <form action="{{ route('carrinho.store') }}" method="POST"  style="margin: 0px 0px 10px 0px">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <input type="hidden" name="quantity" value="01">

                        <input type="hidden" name="price" value="{{ $product->price }}">               

                        <div class="col-3">
                            <select name="size_id" class="form-select">
                                @foreach ($product->sizes as $product_variant)
                                    @if($product_variant->stock > 0)
                                        <option value="{{ $product_variant->id }}">{{ $product_variant->size }} - ({{ $product_variant->stock }} disponíveis)</option>  
                                    @endif
                                @endforeach
                            </select><br>
                        </div>

                        @if ($isInCart)
                            <div class="d-grid gap-2 col-6">
                                <a href="{{ route('carrinho.index') }}" class="btn btn-primary">
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
                    <form action="{{ route('favoritos.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        @if ($isInList)
                            <div class="d-grid gap-2 col-6">
                                <a href="{{ route('favoritos.index') }}" class="btn btn-danger"><i class="bi bi-heart-fill"></i> <b>SALVAR</b></a>
                            </div>
                        @else
                            <div class="d-grid gap-2 col-6">
                                <button type="submit" class="btn btn-danger"><i class="bi bi-heart-fill"></i> <b>SALVAR</b></button>
                            </div>
                        @endif
                    
                    </form>

                    {{--comprar--}}
                    <form action="{{ route('carrinho.store') }}" method="POST"  style="margin: 0px 0px 10px 0px">
                        @csrf                            
                        </div>
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <input type="hidden" name="quantity" value="01">

                            <input type="hidden" value="1" name="redirect_buy">

                            <input type="hidden" name="price" value="{{ $product->price }}">               

                            @foreach ($product->sizes as $product_variant)
                                <input type="hidden" name="size_id" value="{{ $product_variant->id }}">  
                            @endforeach

                            @if ($isInCart)
                                <div class="d-grid gap-2 col-6">
                                    <a href="{{ route('carrinho.index') }}" class="btn btn-success btn-lg">
                                        <i class="bi bi-currency-dollar"></i> <b>COMPRAR</b>
                                    </a>
                                </div>
                            @else
                                <div class="d-grid gap-2 col-6">
                                    <button class="btn btn-success btn-lg" type="submit"><i class="bi bi-currency-dollar"></i> <b>COMPRAR</b></button>
                                </div>
                            @endif

                    </form>

                </div>
            @else
                <div class="d-grid gap-2 col-6">
                    <a href="{{ route('login') }}" class="btn btn-primary"><i class="bi bi-cart-fill"></i> <b>CARRINHO</b></a>

                    <a href="{{ route('login') }}" class="btn btn-danger"><i class="bi bi-heart-fill"></i> <b>SALVAR</b></a>

                    <a href="{{ route('login') }}" class="btn btn-success btn-lg"><i class="bi bi-currency-dollar"></i><b>COMPRAR</b></a>
                </div>                              
            @endauth
                            
            </p>
        </div>

        @if ($mensagem = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $mensagem }}
            </div>
        @endif
    </div>
</div>

@endsection