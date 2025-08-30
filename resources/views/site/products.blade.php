@extends('site.layouts.layout')
@section('title', 'Produtos')

@section('conteudo')



<!--cards-->
<div class="container">
    <div class='row'>
        @if (count($products) == 0)
            <div class="row" style="margin: 50px 0px 50px 0px">
                <div class='col'>
                    <h1 class="text-center" style="font-weight: bolder">ops! NÃO ACHAMOS O PRODUTO =(</h1>
                </div>
            </div> 
        @else
            <div class="row" style="margin: 50px 0px 50px 0px">
                <div class='col'>
                    <h1 class="text-center" style="font-weight: bolder">TODOS OS NOSSO PRODUTOS!</h1>
                </div>
            </div>     
            @foreach ($products as $p )
            <div class='col-3'>
                    <div class="card" style="width: 18rem;">
                        <a href="{{ route('products.show', $p->code) }}"><img src="{{ asset($p->image_path) }}" class="card-img-top" alt="{{ $p->name }}"></a>
                        <div class="card-body">
                            <h5 class="card-title">{{ strtoupper($p->name) }}</h5>
                            <p class="card-text">{{ Str::limit($p->description, 50) }}</p>
                            <a href="{{ route('products.show', $p->code) }}" class="btn btn-success"><i class="bi bi-currency-dollar"></i> <b>COMPRAR</b></a>
                        </div>
                    </div>
                    <br>
                </div>
            @endforeach

            {{ $products->links() }}
        @endif
    </div>
</div>



@endsection