@extends('site.layouts.layout')
@section('title', 'Home')

@section('conteudo')
{{-- ZOOM HOUVER --}}
<style>
    .zoom-container {
        overflow: hidden;
        border-radius: 12px;
    }

    .zoom-container img {
        transition: transform 0.4s ease;
    }

    .zoom-container:hover img {
        transform: scale(1.1);
    }

    .home-carousel {
        margin: 30px auto;
        display: flex;
        overflow-x: auto;
    }

    .home-carousel::-webkit-scrollbar {
        display: none;
    }

    .home-card {
        flex: 0 0 5em;
        height: 7em;
        font-size: 3rem;
        border-radius: .1em;
        text-align: center;
        align-content: center;
    }

    .home-group {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1em;
        animation: spin 200s infinite linear;
        padding-right: 1em;
    }

    @keyframes spin{
        from {translate: 0;}
        to {translate: -100%;}
    } 
</style>

{{-- CARROSSEL --}}
<div id="carouselExample" class="carousel slide mb-5" data-bs-ride="carousel" data-bs-interval="4000" data-bs-pause="hover">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <a href="{{ route('products.index') }}">
                <img 
                    src="https://i.ibb.co/Mx9TnGdS/banner-1-0-5x.png"
                    class="d-block w-100 img-fluid"
                    alt="Banner-1"
                >
            </a>
        </div>
        <div class="carousel-item">
            <a href="{{ route('products.index') }}">
                <img 
                    src="https://i.ibb.co/6cBBGKS3/banner-1.png"
                    class="d-block w-100 img-fluid"
                    alt="Banner-2"
                >
            </a>
        </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

{{-- CONTEÚDO --}}
<div class="container my-5">

    <div class="row mb-4">
        <div class="col text-center text-md-start">
            <h3 class="fw-bold">• Categorias •</h3>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6">
            <a href="{{ route('products.man') }}" class="zoom-container">
                <img 
                    src="https://i.ibb.co/dJ6vwNs3/homem.png"
                    class="img-fluid rounded w-100"
                    alt="Masculino"
                >
            </a>
        </div>

        <div class="col-12 col-md-6">
            <a href="{{ route('products.woman') }}" class="zoom-container">
                <img 
                    src="https://i.ibb.co/Wvr4WjPp/mulher-0-3x.png"
                    class="img-fluid rounded w-100"
                    alt="Feminino"
                >
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12 col-md-6">
            <a href="{{ route('products.unissex') }}" class="zoom-container">
                <img 
                    src="https://i.ibb.co/93cTPmyD/unissex-0-3x.png"
                    class="img-fluid rounded w-100"
                    alt="Unissex"
                >
            </a>
        </div>

        <div class="col-12 col-md-6">
            <a href="{{ route('products.index') }}" class="zoom-container">
                <img 
                    src="https://i.ibb.co/4C0qJkQ/completa-0-3x.png"
                    class="img-fluid rounded w-100"
                    alt="Todos os produtos"
                >
            </a>
        </div>
    </div>

    <div class="row mb-4 mt-5">
        <div class="col text-center text-md-start">
            <h3 class="fw-bold">• Nossos Produtos •</h3>
        </div>
    </div>

    {{--CARROSEL DE EXIBIÇÃO DOS PRODUTOS--}}     
    <div class="home-carousel">
        <div class="home-group">
            @foreach ($products as $p )
                <div class="home-card">
                    <a href="{{ route('products.show', $p->code) }}">
                        <img src="{{ asset('storage/' . $p->image_path) }}" class="img-fluid rounded" alt="{{ $p->name }}">
                    </a>
                    <h3><b>{{ strtoupper($p->name) }}</b></h3>
                    <h6><small class="text-muted">{{ $p->category->name }}</small></h6>
                </div>
            @endforeach
        </div>
    </div>
  
</div>
@endsection
