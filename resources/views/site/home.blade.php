@extends('site.layouts.layout')
@section('title', 'HOME')

@section('conteudo')
<div class="row" style="margin: 100px 0px 0px 0px">
    <div class='col'>
        <h1 class="text-center" style="font-weight: bolder">ENCONTRE O SEU PAR PERFEITO!</h1>
    </div>
</div>

<div class="row" style="margin: 0px 0px 50px 0px">
    <div class="col">
        <p class="texte-center" style="font-size:30px; text-align: center;">Descubra os últimos estilos e tendências de calçados para homens, mulheres e unissex.</p>
    </div>
</div>

<div class="container">
    <div class="gap-2 d-flex justify-content-center">
        <a href="{{ '/produtos' }}" class="btn btn-warning btn-lg"><b>COMPRAR</b></a>
    </div>
</div>
@endsection
