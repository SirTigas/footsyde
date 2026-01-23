@if(Auth::user()->role === 'admin' && Auth::user()->email_verified_at != NULL)
    @extends('admin.layouts.layout')


    @section('conteudo')
    @auth()
    <div class="container-fluid" style="margin:30px 0px 0px 0px">
        {{--Sucess menssagem--}}
        @if($mensagem = Session::get('success'))
            <div class="alert alert-success" role="alert" style="text-align:center;">
                {{ $mensagem }}
            </div>
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error )
                <p style="text-align: center; color:red;">{{ $error }}</p>
            @endforeach
        @endif

        @if(count($products) == 0)
            <div class="row" style="margin: 50px 0px 50px 0px">
                <div class='col'>
                    <h1 class="text-center" style="font-weight: bolder">Produtos não encontrados na base de dados!</h1>
                </div>
            </div> 
        @else
                <h1 style="text-align: center;"><b>ESTOQUE FOOTSYDE</b></h1>       
                @foreach ($products as $p )
                            <div class="col d-flex justify-content-center">
                                <div class="card mb-3" style="max-width: 1200px;">
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
                                                        <p>Nome: <b>{{ strtoupper($p->name) }}</b></p>
                                                        <p>Fornecedor: <b>{{ $p->fornecedor }}</b></p>
                                                        <p>Código: <b>{{ $p->code }}</b></p>                                                  
                                                    </div><br>

                                                    @foreach ($p->sizes as $product_variant)
                                                        <form action="{{ route('admin.stock') }}" method="POST">
                                                            @csrf
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div class="input-group col-auto">
                                                                    <span class="input-group-text" id="inputGroup-sizing-default">Estoque - Tamanho {{ $product_variant->size }}</span>
                                                                    <div class="col-auto">
                                                                        <input type="number" class="form-control" value="{{ $product_variant->stock }}" name="stock">
                                                                        <input name="id" type="hidden" value="{{ $product_variant->id }}">
                                                                    </div>
                                                                    <button type="submit" class="btn btn-success"><i class="bi bi-floppy"></i></i></button>
                                                                </div> 
                                                            </div>
                                                        </form><br>
                                                    @endforeach 
                                                </div>                                            
                                            </div>   
                                        </div>    
                                    </div>
                                </div>
                            </div>

                @endforeach
            {{ $products->links() }}
        </div>
        @endif
    @endauth
    @endsection
@endif