@extends('site.layouts.layout')


@section('conteudo')
<h1>Olá, <b>{{ auth()->user()->name }}</b></h1>
@endsection