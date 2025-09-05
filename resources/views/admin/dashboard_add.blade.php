@extends('admin.layouts.layout')

@section('conteudo')
<div class="row" style="margin: 50px 0px 50px 0px">
    <div class='col'>
        <h1 class="text-center" style="font-weight: bolder">FORMULÁRIO DE CRIAÇÃO.</h1>
    </div>
</div>

@if ($mensagem = Session::get('success'))
    <p class="d-flex justify-content-center">{{ $mensagem }}</p>
@endif

<div class="container">
    <form action="{{ route('admin.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Nome do produto"><br><br>
        <input type="text" name="description" placeholder="Breve descrição"><br><br>
        <input type="number" name="price" step="0.01" min="1" placeholder="Valor do produto"><br><br>
        <input type="number" name="stock" min="1" placeholder="Estoque"><br><br>
        <input type="text" name="fornecedor" placeholder="nome do fornecedor"><br><br>
        Gênero: <select name="category_id">
            <option value="1">1 - Homem</option>
            <option value="2">2 - Mulher</option>
            <option value="3">3 - Unissex</option>
        </select><br><br>

        <button type="submit">CRIAR PRODUTO</button>
    </form>
</div>

@endsection