@extends('checkout.layouts.layout')

@section('conteudo')
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;); margin: 1%" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('carrinho.index') }}">Carrinho</a></li>
        <li class="breadcrumb-item active" aria-current="page">Forma de pagamento</li>
    </ol>
</nav>

<div style="margin: 5%; background-color: #FAF9F6;">


    <h1 style="text-align:center">Forma de pagamento</h1><br>

    <div class="container text-center">
        <div class="row">
            <div class="col">
                <a href="{{ route('credito') }}"><img src="{{ asset('images/checkout/credit_card.png') }}" class="rounded mx-auto d-block" alt="credit_card" width="150px"></a><br>
                <H2>Cartão de Crédito</H2>
            </div>
            <div class="col">
                <a href="{{ route('pix') }}"><img src="{{ asset('images/checkout/pix.png') }}" class="rounded mx-auto d-block" alt="pix" width="150px"></a><br>
                <H2>Pix</H2>
            </div>
        </div>
    </div>
</div>

@endsection
