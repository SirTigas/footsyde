@extends('admin.layouts.layout')


@section('conteudo')
<div class="container-fluid" style="margin:30px 0px 0px 0px">
    @if ($mensagem = Session::get('success'))
        <p class="d-flex justify-content-center">{{ $mensagem }}</p>
    @endif

    @if(count($products) == 0)
        <div class="row" style="margin: 50px 0px 50px 0px">
            <div class='col'>
                <h1 class="text-center" style="font-weight: bolder">Produto não encontrado na base de dados!</h1>
            </div>
        </div> 
    @else
            @foreach ($products as $p )
                <form action="{{ route('admin.update') }}" method="POST"> 
                        @csrf
                        <div class="col d-flex justify-content-center">
                            <div class="card mb-3" style="max-width: 1000px;">
                                <div class="row g-0">
                                    
                                    <!-- Imagem -->
                                    <div class="col-md-3">
                                        <a href="{{ route('products.show', $p->code) }}">
                                            <img src="{{ asset('storage/' . $p->image_path) }}" class="img-fluid rounded-start" alt="{{ strtoupper($p->name) }}">                            
                                        </a>
                                    </div>

                                    <!-- Conteúdo -->
                                    <div class="col-md-9">
                                        <div class="card-body d-flex flex-column justify-content-between h-100">
                                            <div>
                                                <div class="d-flex justify-content-between align-items-center mt-2">
                                                    <h5 class="card-title"> 
                                                        <p>Nome: <input type="text" name="name" value="{{ strtoupper($p->name) }}"> <small>Código: {{ $p->code }}</small> </p>  
                                                    </h5>
                                                                                                  
                                                </div>
                                                              
                                                <p>Descrição: <textarea name="description" value="">{{ $p->description }}</textarea></p>
                                                Fornecedor: <input type="option" name="fornecedor" value="{{ $p->fornecedor }}">
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center mt-2"> 
                                                <div class="d-flex justify-content-end">
                                                    R$ <input type="decimal" name="price" value="{{ $p->price }}">

                                                    Estoque: <input type="number" name="stock" value="{{ $p->stock }}" class="form-control form-control-sm" style="width: 100px;">
                                                    
                                                    Categoria:  <select name="category_id">
                                                                    <option value="{{ $p->category_id }}">{{ $p->category_id }}</option>
                                                                    <option value="1">1 - Homem</option>
                                                                    <option value="2">2 - Mulher</option>
                                                                    <option value="3">3 - Unissex</option>
                                                                </select>
                                                    <input type="hidden" name="id" value="{{ $p->id }}">

                                                    <button type="submit" class="btn btn-success" style="margin:0px 0px 0px 10px"><i class="bi bi-floppy-fill"></i> <b>SALVAR</b></button>

                                                                                                                    
                                                </div>                              
                                            </div>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                        </div>
                </form>
            @endforeach
        {{ $products->links() }}
    </div>
    @endif
@endsection