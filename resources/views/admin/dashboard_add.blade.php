@extends('admin.layouts.layout')

@section('conteudo')
<div class="row" style="margin: 50px 0px 50px 0px">
    <div class='col'>
        <h1 class="text-center" style="font-weight: bolder">FORMULÁRIO DE CRIAÇÃO.</h1>
    </div>
</div>

{{--Sucess menssagem--}}
@if ($mensagem = Session::get('msm'))
    <p class="d-flex justify-content-center">{{ $mensagem }}</p>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error )
        {{ $error }} <br>
    @endforeach
@endif

<div class="container">
    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" placeholder="Nome do produto" value="{{ old('name') }}"><br><br>
        <input type="text" name="description" placeholder="Breve descrição" value="{{ old('description') }}"><br><br>
        <input type="number" name="price" step="0.01" min="1" placeholder="Valor do produto" value="{{ old('price') }}"><br><br>
        <input type="number" name="stock" min="1" placeholder="Estoque" value="{{ old('stock') }}"><br><br>
        <input type="text" name="fornecedor" placeholder="Nome do Fornecedor" value="{{ old('fornecedor') }}"><br><br>
        Gênero: <select name="category_id">
            <option value="1">1 - Homem</option>
            <option value="2">2 - Mulher</option>
            <option value="3">3 - Unissex</option>
        </select><br><br>

        Thumbnail:
        <input type="file" name="thumbnail" accept="image/*"><br><br>

        Imagens:
        <input type="file" name="images[]" multiple accept="image/*"><br><br>

        

        <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle-fill"></i> <b>CRIAR PRODUTO</b></button>
    </form>
</div>

@endsection