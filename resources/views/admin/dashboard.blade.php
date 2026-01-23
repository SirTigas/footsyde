@if(Auth::user()->role === 'admin' && Auth::user()->email_verified_at != NULL)
    @extends('admin.layouts.layout')


    @section('conteudo')
    <div class="container-fluid" style="margin:30px 0px 0px 0px">
        @if ($mensagem = Session::get('success'))
            <p class="d-flex justify-content-center" style="color:green">{{ $mensagem }}</p>
        @endif

        @if(count($products) == 0)
            <div class="row" style="margin: 50px 0px 50px 0px">
                <div class='col'>
                    <h1 class="text-center" style="font-weight: bolder">Produtos não encontrado na base de dados!</h1>
                </div>
            </div> 
        @else
                @foreach ($products as $p )
                    <form action="{{ route('admin.update') }}" method="POST"> 
                            @csrf
                            <div class="col d-flex justify-content-center">
                                <div class="card mb-3" style="max-width: 1150px;">
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
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Nome do Produto</label>
                                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ strtoupper($p->name) }}"> 
                                                            @error('name')
                                                                <span>
                                                                    <strong style='color:red;'>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="description" class="form-label">Descrição</label>
                                                            <textarea name="description" id="desc" class="form-control @error('description') is-invalid @enderror" id="desc" name="description" value="">{{ $p->description }}</textarea>
                                                            @error('description')
                                                                <span>
                                                                    <strong style='color:red;'>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="fornecedor" class="form-label">Fornecedor</label>
                                                            <input type="text" class="form-control @error('fornecedor') is-invalid @enderror" id="fornecedor" name="fornecedor" value="{{ $p->fornecedor }}">
                                                            @error('fornecedor')
                                                                <span>
                                                                    <strong style='color:red;'>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="gener" class="form-label">Gênero</label>
                                                            <select name="category_id" id="gener" class="form-select @error('category_id') is-invalid @enderror" aria-label="Default select example" required>
                                                                <option selected>{{ $p->category_id }}</option>
                                                                <option value="1">1 - Homem</option>
                                                                <option value="2">2 - Mulher</option>
                                                                <option value="3">3 - Unissex</option>
                                                            </select>
                                                            <input type="hidden" name="id" value="{{ $p->id }}">

                                                            @error('category_id')
                                                                <span>
                                                                <strong style='color:red;'>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="d-flex justify-content-between align-items-center mt-6">
                                                        <div class="mb-3">
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text">R$</span>
                                                                <span class="input-group-text">{{ $p->price }}</span>
                                                                <input type="number" step="0.01" min="1" class="form-control @error('price') is-invalid @enderror" name="price" value="">
                                                            </div>
                                                            @error('price')
                                                                <span>
                                                                    <strong style='color:red;'>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>                                                                                                        
                                                    </div>

                                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                                        <div class="mb-3">
                                                            <small>Código: <b>{{ $p->code }}</b></small>
                                                        </div>

                                                        <div class="mb-3">
                                                            <button type="submit" class="btn btn-success"><i class="bi bi-floppy-fill"></i> <b>SALVAR</b></button>
                                                        </div>                                                                                                        
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
@endif