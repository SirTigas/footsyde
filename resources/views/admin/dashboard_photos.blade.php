@extends('admin.layouts.layout')


@section('conteudo')
<div class="container-fluid" style="margin:30px 0px 0px 0px">
    {{--Sucess menssagem--}}
    @if ($mensagem = Session::get('msm'))
        <p class="d-flex justify-content-center">{{ $mensagem }}</p>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error )
            {{ $error }} <br>
        @endforeach
    @endif

    @if(count($products) == 0)
        <div class="row" style="margin: 50px 0px 50px 0px">
            <div class='col'>
                <h1 class="text-center" style="font-weight: bolder">Produto não encontrado na base de dados!</h1>
            </div>
        </div> 
    @else
            @foreach ($products as $p )
                <form action="{{ route('admin.photo') }}" method="POST" enctype="multipart/form-data"> 
                        @csrf
                        <div class="col d-flex justify-content-center">
                            <div class="card mb-3" style="max-width: 1000px;">
                                <div class="row g-0">
                                    
                                    <!-- Imagem -->
                                    <div class="col-md-3">
                                        <a href="{{ route('products.show', $p->code) }}">
                                            @if ($p->image_path != $defaultThumbnail)
                                                <img src="{{ asset('storage/' . $p->image_path) }}" class="img-fluid rounded-start" alt="{{ strtoupper($p->name) }}">
                                            @else
                                                <img src="{{ asset($p->image_path) }}" class="img-fluid rounded-start" alt="{{ strtoupper($p->name) }}">
                                            @endif                                           
                                        </a>
                                    </div>

                                    <!-- Conteúdo -->
                                    <div class="col-md-9">
                                        <div class="card-body d-flex flex-column justify-content-between h-100">
                                            <div>
                                                <div class="d-flex justify-content-between align-items-center mt-2">
                                                    <p>Nome: <b>{{ strtoupper($p->name) }}</b></p>
                                                    <p>Código: <b>{{ $p->code }}</b></p>                                                    
                                                </div>
                                                              
                                                <p>Descrição: <b>{{ $p->description }}</b></p>

                                                <p>Fornecedor: <b>{{ $p->fornecedor }}</b></p>

                                                <p>Categoria:  <b>{{ $p->category_id }}</b></p>
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center mt-2"> 
                                                <div class="d-flex justify-content-end">
                                                    <p>Capa: <input type="file" name="thumbnail" accept="image/*"></p>

                                                    <p>Carrossel: <input type="file" name="images[]" multiple accept="image/*"></p>

                                                    <input type="hidden" name="name" value="{{ $p->name }}">
                                                    <input type="hidden" name="code" value="{{ $p->code }}">
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