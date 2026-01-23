@extends('site.layouts.layout')

@section('conteudo')
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;); margin: 1%" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('site.home') }}">Pedido Concluido</a></li>
    </ol>
</nav>

<div style="margin: 5%; background-color: #FAF9F6; border-radius: 10px; text-align:center">
    <h1>Pedido concluido com sucesso!</h1><br>
    <h2>Obrigado por comprar na Footsyde. Código do pedido: {{ $codeOrder }}</h2>
    <a href="{{ route('site.home') }}">
        <p>Continue navegando.</p>
    </a>
@endsection
