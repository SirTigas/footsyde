@if(Auth::user()->role === 'admin' && Auth::user()->email_verified_at != NULL)
    @extends('admin.layouts.layout_photos')

    @section('conteudo')
    <div class="container-fluid" style="margin:30px 0px 0px 0px">
        {{--Sucess menssagem--}}
        @if ($mensagem = Session::get('msm'))
            <p class="d-flex justify-content-center" style="color:yellow">{{ $mensagem }}</p>
        @endif

        @if(count($products) == 0)
            <div class="row" style="margin: 50px 0px 50px 0px">
                <div class='col'>
                    <h1 class="text-center" style="font-weight: bolder">Produtos não encontrados na base de dados!</h1>
                </div>
            </div> 
        @else
                <h1 style="text-align: center;"><b>GALERIA DE FOTOS</b></h1>

                @foreach ($products as $p )
                    <form action="{{ route('admin.photo') }}" method="POST" enctype="multipart/form-data"> 
                            @csrf
                            <div class="col d-flex justify-content-center">
                                <div class="card mb-3" style="max-width: 1100px;">
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
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>Nome: <b>{{ strtoupper($p->name) }}</b></p>
                                                        <p>Fornecedor: <b>{{ $p->fornecedor }}</b></p>
                                                        <p>Código: <b>{{ $p->code }}</b></p>
                                                        <button type="submit" class="btn btn-success"><i class="bi bi-floppy-fill"></i> <b>SALVAR</b></button>
                                                                                                           
                                                    </div><br>
                                                </div>

                                                
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label for="thumbnail" class="form-label">Thumbnail - (jpeg, png, jpg)</label>
                                                        <input type="file" name="thumbnail" accept="image/*" id="thumb" class="form-control @error('thumbnail') is-invalid @enderror">
                                                        @error('thumbnail')
                                                            <span>
                                                                <strong style='color:red;'>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="thumbnail" class="form-label">Carrosel - (jpeg, png, jpg)</label>
                                                        <input type="file" name="images[]" multiple accept="image/*" id="thumb" class="form-control @error('thumbnail') is-invalid @enderror">
                                                        @error('thumbnail')
                                                            <span>
                                                                <strong style='color:red;'>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <input type="hidden" name="name" value="{{ $p->name }}">
                                                    <input type="hidden" name="code" value="{{ $p->code }}">
                                                    <input type="hidden" name="id" value="{{ $p->id }}">

                                                                                                                  
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
@endif