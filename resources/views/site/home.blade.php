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
</style>

{{-- CARROSSEL --}}
<div id="carouselExample" class="carousel slide mb-5" data-bs-ride="carousel" data-bs-interval="4000" data-bs-pause="hover">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <a href="{{ route('products.index') }}">
                <img 
                    src="https://i.ibb.co/ny5PJww/banner-2.png"
                    class="d-block w-100 img-fluid"
                    alt="Banner-1"
                >
            </a>
        </div>
        <div class="carousel-item">
            <a href="{{ route('products.index') }}">
                <img 
                    src="https://i.ibb.co/8nSQFNVn/banner-1.png"
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
            <h3 class="fw-bold">• Conheça as últimas novidades da Footsyde</h3>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6">
            <a href="{{ route('products.man') }}" class="zoom-container">
                <img 
                    src="https://i.ibb.co/gLt9YwbX/homem.png"
                    class="img-fluid rounded w-100"
                    alt="Masculino"
                >
            </a>
        </div>

        <div class="col-12 col-md-6">
            <a href="{{ route('products.woman') }}" class="zoom-container">
                <img 
                    src="https://i.ibb.co/gLPczYgt/mulher.png"
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
                    src="https://i.ibb.co/vxKCWtbT/unissex.png"
                    class="img-fluid rounded w-100"
                    alt="Unissex"
                >
            </a>
        </div>

        <div class="col-12 col-md-6">
            <a href="{{ route('products.index') }}" class="zoom-container">
                <img 
                    src="https://i.ibb.co/XxDc0TPN/todos.png"
                    class="img-fluid rounded w-100"
                    alt="Todos os produtos"
                >
            </a>
        </div>
    </div>

</div>
@endsection
