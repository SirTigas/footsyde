@extends('site.layouts.layout')
@section('title', 'Produtos')

@section('conteudo')
<!--cards-->
<div class="container mt-5">
    {{-- ALERTAS --}}
    @if ($mensagem = Session::get('success'))
        <div class="alert alert-success text-center">{{ $mensagem }}</div>
    @endif

    <div class='row'>
        @if (!$user)
            <div class="row">
                <div class='col-12'>
                    <h1 class="text-center fw-bold">SUA LISTA ESTÁ VAZIA!</h1>
                </div>
            </div> 
        @else
            <div class="row">
                <form action="{{ route('wishlist.clear') }}" method="POST" class="d-flex justify-content-center">
                    @csrf
                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i> <b>REMOVER TODOS</b></button>
                </form>
            </div>

            {{--CARD DOS PRODUTOS--}}
            @foreach ($wishlistItems as $list)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 mt-2">
                    <div class="card h-100 shadow-sm">

                        <a href="{{ route('products.show', $list->product->code) }}">
                            <img src="{{ asset('storage/' . $list->product->image_path) }}" class="card-img-top img-fluid" alt="{{ $list->product->name }}">   
                        </a>
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ strtoupper($list->product->name) }}</h5>
                            
                            <p class="card-text">{{ Str::limit($list->product->description, 50) }}</p>

                            <div class="row">
                                <div class="col d-flex flex-column">
                                    <form action="{{ route('favoritos.destroy', $list->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="row">
                                            <div class="col d-flex flex-column">
                                                <input type="hidden" name="product_id" value="{{ $list->product->id }}">
                                                <button type="submit" class="btn btn-danger mt-auto">
                                                    <i class="bi bi-heartbreak-fill"></i> <b>REMOVER</b>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div >
                {{ $wishlistItems->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
