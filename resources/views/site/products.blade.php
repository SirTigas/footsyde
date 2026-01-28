@extends('site.layouts.layout')
@section('title', 'Produtos')

@section('conteudo')
<!--cards-->
<div class="container">
    {{-- ALERTAS --}}
    @if ($mensagem = Session::get('success'))
        <div class="alert alert-success text-center">{{ $mensagem }}</div>
    @endif

    <div class='row'>
        @if (count($products) == 0)
            <div class="row">
                <div class='col-12'>
                    <h1 class="text-center fw-bold">ops! NÃO ACHAMOS O PRODUTO =(</h1>
                </div>
            </div> 
        @else
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center fw-bold">TODOS OS NOSSO PRODUTOS!</h1>
                </div>
            </div>

            {{--CARD DOS PRODUTOS--}}
            @foreach ($products as $p )
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 shadow-sm">

                        <a href="{{ route('products.show', $p->code) }}">
                            <img src="{{ asset('storage/' . $p->image_path) }}" class="card-img-top img-fluid" alt="{{ $p->name }}">   
                        </a>
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ strtoupper($p->name) }} - <small class="text-muted">{{ $p->category->name }}</small></h5>
                            
                            <p class="card-text">{{ Str::limit($p->description, 50) }}</p>

                            <div class="row">
                                <div class="col d-flex flex-column">
                                    <a href="{{ route('products.show', $p->code) }}" class="btn btn-success mt-auto">
                                        <i class="bi bi-currency-dollar"></i><b>COMPRAR</b>
                                    </a>
                                </div>
                                
                                <div class="col d-flex flex-column">
                                    <form action="{{ route('favoritos.store') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col d-flex flex-column">
                                                <input type="hidden" name="product_id" value="{{ $p->id }}">
                                                <button type="submit" class="btn btn-danger mt-auto">
                                                    <i class="bi bi-heart-fill"></i> <b>SALVAR</b>
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
            {{ $products->links() }}
        @endif
    </div>
</div>
@endsection
