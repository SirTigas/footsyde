@if(Auth::user()->role === 'admin' && Auth::user()->email_verified_at != NULL)
    @extends('admin.layouts.layout')

    @section('conteudo')
    <div class="row" style="margin: 50px 0px 10px 0px">
        <div class='col'>
            <h1 class="text-center" style="font-weight: bolder">FORMULÁRIO DE CRIAÇÃO.</h1>
        </div>
    </div>

    {{--Sucess menssagem--}}
    @if ($mensagem = Session::get('msm'))
        <div class="alert alert-success" role="alert" style="text-align:center;">
            {{ $mensagem }}
        </div>
    @endif
        <body>
            <br>
            <div class="container-fluid col-6">
                <div class="card">
                    <div class="card-header">
                        Preencha corretamente ao formulário
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if ($mensagem = Session::get('erro'))
                                <span>
                                    <strong style="color:red">{{ $mensagem }}</strong>
                                </span>
                            @endif
                                                
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome do Produto</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <span>
                                        <strong style='color:red;'>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="desc" class="form-label">Descrição</label>
                                <textarea name="description" id="desc" class="form-control @error('description') is-invalid @enderror" id="desc" name="description" value="{{ old('description') }}" required></textarea>
                                @error('description')
                                    <span>
                                        <strong style='color:red;'>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="gener" class="form-label">Gênero</label>
                                <select name="category_id" id="gener" class="form-select @error('category_id') is-invalid @enderror" aria-label="Default select example" required>
                                    <option selected>Slecionar Gênero</option>
                                    <option value="1">1 - Homem</option>
                                    <option value="2">2 - Mulher</option>
                                    <option value="3">3 - Unissex</option>
                                </select>

                                @error('category_id')
                                    <span>
                                        <strong style='color:red;'>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Preço</label>
                                <input type="number" step="0.01" min="1" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required>
                                @error('price')
                                    <span>
                                        <strong style='color:red;'>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="fornecedor" class="form-label">Fornecedor</label>
                                <input type="text" class="form-control @error('fornecedor') is-invalid @enderror" id="fornecedor" name="fornecedor" value="{{ old('fornecedor') }}" required>
                                @error('fornecedor')
                                    <span>
                                        <strong style='color:red;'>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="stock_38" class="form-label">Tamanho 38 - Estoque</label>
                                <input type="number" class="form-control @error('stock_38') is-invalid @enderror" id="email" name="stock_38" value="{{ old('stock_38') }}" required>
                                @error('stock_38')
                                    <span>
                                        <strong style='color:red;'>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="stock_39" class="form-label">Tamanho 39 - Estoque</label>
                                <input type="number" class="form-control @error('stock_39') is-invalid @enderror" id="stock_39" name="stock_39" value="{{ old('stock_39') }}" required>
                                @error('stock_39')
                                    <span>
                                        <strong style='color:red;'>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="stock_40" class="form-label">Tamanho 40 - Estoque</label>
                                <input type="number" class="form-control @error('stock_40') is-invalid @enderror" id="stock_39" name="stock_40" value="{{ old('stock_40') }}" required>
                                @error('stock_40')
                                    <span>
                                        <strong style='color:red;'>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="thumbnail" class="form-label">Thumbnail - (jpeg, png, jpg)</label>
                                <input type="file" name="thumbnail" accept="image/*" id="thumb" class="form-control @error('thumbnail') is-invalid @enderror" required>
                                @error('thumbnail')
                                    <span>
                                        <strong style='color:red;'>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="images" class="form-label">Imagens do Carrosel - (jpeg, png, jpg)</label>
                                <input type="file" multiple accept="image/*" class="form-control @error('images') is-invalid @enderror" id="images" name="images[]">
                                @error('images[]')
                                    <span>
                                        <strong style='color:red;'>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">CADASTRAR</button></a>
                        </form>
                    </div>
                </div>
            </div>
        </body>
    @endsection
@endif
