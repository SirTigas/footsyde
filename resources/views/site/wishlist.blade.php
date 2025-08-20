@extends('site.layouts.layout')

@section('conteudo')

<div class="container">
    <div class="row" style="margin: 30px 0px 0px 0px">
        <h1 style="text-align:center;"><b>LISTA DE DESEJO!</b></h1>

        @if (!$user)
            <h5 style="text-align:center;">VAZIO!</h5>

        @else
            <form action="{{ route('wishlist.clear') }}" method="POST" class="d-flex justify-content-center" style="margin: 0px 0px 10px 0px">
                @csrf
                <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i> <b>REMOVER TODOS</b></button>
            </form>
        @endif
    </div>
    <div class="row">
        @foreach ($wishlistItems as $list)
            <div class="col-3" style="margin: 20px 0px 10px 0px">
                <div class="card" style="width: 18rem;">
                    <a href="{{ route('products.show', $list->product->slug) }}"><img src="{{ $list->product->image_path }}" class="card-img-top" alt="{{ $list->product->name }}"></a>
                    <div class="card-body">
                        <h5 class="card-title"><b>{{ strtoupper($list->product->name) }}</b></h5>
                        <p class="card-text">{{ Str::limit($list->product->description, 50)}}</p>


                        <form action="{{ route('wishlist.destroy') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $list->id }}">
                            <button type="submit" class="btn btn-danger"><i class="bi bi-heartbreak-fill"></i> <b>REMOVER</b></button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection