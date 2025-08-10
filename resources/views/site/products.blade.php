@extends('site.layouts.layout')

@section('conteudo')

<div class="row" style="margin: 50px 0px 50px 0px">
    <div class='col'>
        <h1 class="text-center" style="font-weight: bolder">TODOS OS NOSSO PRODUTOS!</h1>
    </div>
</div>

<!--cards-->
<div class="container">
    <div class='row'>
        @foreach ($products as $p )
           <div class='col-3'>
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset($p->image_path) }}" class="card-img-top" alt="{{ $p->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ strtoupper($p->name) }}</h5>
                        <p class="card-text">{{ Str::limit($p->description, 50) }}</p>
                        <a href="#" class="btn btn-primary">COMPRAR</a>
                    </div>
                </div>
                <br>
            </div>
        @endforeach

        {{ $products->links() }}
    </div>
</div>



@endsection