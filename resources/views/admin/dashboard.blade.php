@extends('site.layouts.layout')


@section('conteudo')
<h1>Olá {{ auth()->user()->name }}</h1>
@endsection