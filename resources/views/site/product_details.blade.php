@extends('site.layouts.layout')
@section('title', 'Detalhes')

@section('conteudo')
<div class="container">
    <div class="row" style="margin: 50px 0px 0px 0px">

        {{-- carrossel onde é exibido todas as fotos dos produtos --}}
        <div class='col-4'>
            <div id="carouselExample" class="carousel slide">
            
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('storage/'. $product->image_path) }}" class="d-block w-100" alt="..." style="border-radius: 30px">
                    </div>
                    @foreach ( $product->images as $path )
                        <div class="carousel-item" >
                            <img src="{{ asset('storage/'. $path->path) }}" class="d-block w-100" alt="$pa" style="border-radius: 30px">
                        </div>
                    @endforeach
                </div>
            
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Avançar</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Voltar</span>
                </button>
            </div>
        </div>
        
        <div class="col-8">
            <h3>{{ strtoupper($product->name) }} </h3>
            <br>
            <p>{{ $product->description }} </p>
            <p>Gênero: <b>{{ $product->category->name }}</b></p>
            <p>Vendido e entregue por: <b>{{ $product->fornecedor }}</b></p>
            <p><i class="bi bi-star-fill"></i> {{ $avarageReview }}/5 - <small>{{ $reviews->total() }} Avaliações</small></p>
            <h1>R$ {{ number_format($product->price, 2, ',', '.') }}</h1>
            <p>
            {{-- Aqui ocorre a verificação se o usuário está logado para prosseguir com a compra, adicionar ao carrinho ou lista de favoritos, caso contrário é redirecionado para tela de login --}}
            @auth
                <div class="row">

                    {{--salvando no carrinho--}}
                    <form action="{{ route('carrinho.store') }}" method="POST"  style="margin: 0px 0px 10px 0px">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <input type="hidden" name="quantity" value="01">

                        <input type="hidden" name="price" value="{{ $product->price }}">               

                        <div class="col-3">
                            <select name="size_id" class="form-select">
                                @foreach ($product->sizes as $product_variant)
                                    <option {{ $product_variant->stock > 0 ? 'selected' : '' }} value="{{ $product_variant->stock > 0 ? $product_variant->id : 'esgotado'}}">{{ $product_variant->stock > 0 ? $product_variant->size .' - (' .$product_variant->stock . ') ' . 'disponíveis' : 'ESGOTADO'}}</option>
                                @endforeach
                            </select><br>
                        </div>

                        @if ($isInCart)
                            <div class="d-grid gap-2 col-6">
                                <a href="{{ route('carrinho.index') }}" class="btn btn-primary">
                                    <i class="bi bi-cart-fill"></i> <b>CARRINHO</b>
                                </a>
                            </div>
                        @else
                            <div class="d-grid gap-2 col-6">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-cart-fill"></i> <b>CARRINHO</b></button>
                            </div>
                        @endif
                    </form>

                    {{--salvando nos favoritos--}}
                    <form action="{{ route('favoritos.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        @if ($isInList)
                            <div class="d-grid gap-2 col-6">
                                <a href="{{ route('favoritos.index') }}" class="btn btn-danger"><i class="bi bi-heart-fill"></i> <b>SALVAR</b></a>
                            </div>
                        @else
                            <div class="d-grid gap-2 col-6">
                                <button type="submit" class="btn btn-danger"><i class="bi bi-heart-fill"></i> <b>SALVAR</b></button>
                            </div>
                        @endif
                    
                    </form>

                    {{--comprar--}}
                    <form action="{{ route('carrinho.store') }}" method="POST"  style="margin: 0px 0px 10px 0px">
                        @csrf                            
                        </div>
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <input type="hidden" name="quantity" value="01">

                        <input type="hidden" value="1" name="redirect_buy">

                        <input type="hidden" name="price" value="{{ $product->price }}">

                        @if ($isInCart)
                            <div class="d-grid gap-2 col-6">
                                <a href="{{ route('carrinho.index') }}" class="btn btn-success btn-lg">
                                    <i class="bi bi-currency-dollar"></i> <b>COMPRAR</b>
                                </a>
                            </div>
                        @else
                            @foreach ($product->sizes as $product_variant)
                                @if($product_variant->stock > 0)
                                    <input type="hidden" name="size_id" value="{{ $product_variant->id }}">
                                    <div class="d-grid gap-2 col-6">
                                        <button class="btn btn-success btn-lg" type="submit"><i class="bi bi-currency-dollar"></i> <b>COMPRAR</b></button>
                                    </div>
                                    @php
                                        break;
                                    @endphp
                                @endif
                            @endforeach 
                        @endif
                    </form>
                </div>
            @else
                <div class="d-grid gap-2 col-6">
                    <a href="{{ route('login') }}" class="btn btn-primary"><i class="bi bi-cart-fill"></i> <b>CARRINHO</b></a>

                    <a href="{{ route('login') }}" class="btn btn-danger"><i class="bi bi-heart-fill"></i> <b>SALVAR</b></a>

                    <a href="{{ route('login') }}" class="btn btn-success btn-lg"><i class="bi bi-currency-dollar"></i><b>COMPRAR</b></a>
                </div>                              
            @endauth
                            
            </p>
        </div>

        @if ($mensagem = Session::get('success'))
            <div class="alert alert-success" role="alert" style="text-align:center;">
                {{ $mensagem }}
            </div>
        @endif

        @if ($mensagem = Session::get('stock'))
            <div class="alert alert-danger" role="alert" style="text-align:center;">
                {{ $mensagem }}
            </div>
        @endif

        <div>
            <hr>
            <div>
                @if ($orders != null && $existsReview === null && $orders->status === 'success')
                    <h3>• AVALIE ESTE PRODUTO</h3><br>
                    <p>Você já comprou este produto, deixe a sua avaliação!</p>
                    <div class="row">
                        <div class="col-3">
                            <form action="{{ route('review.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <output for="range4" id="rangeValue" aria-hidden="true" style="text-align:center"></output> <i class="bi bi-star-fill"></i>
                                <input type="range" class="form-range" min="1" max="5" step="0.5" value="5" id="range4" name="rating">
                                <br>

                                <div class="input-group">
                                    <textarea class="form-control" aria-label="With textarea" placeholder="Comentário(opcional)" name="comment"></textarea>
                                </div><br>

                                <button type="submit" class="btn btn-success"><b>POSTAR</b></button>
                            </form>
                        </div>
                    </div><br><br>               
                @endif

                @if ($mensagem = Session::get('review_success'))
                    <div class="alert alert-success" role="alert" style="text-align:center;">
                        {{ $mensagem }}
                    </div>
                @endif
                

                <h3>Comentários • Avaliações</h3><br>
                @if ($reviews->total() > 0)
                    @foreach ($reviews as $rev )
                        <div class="card">
                            <div class="row"  style="margin: 1%">
                                <div class="col">
                                    <img src="{{ asset('storage/images/profile/default.jpg') }}" alt="profile-photo" style="border-radius:100%" width="40px">
                                    {{ $rev->user->name }} • {{ $rev->rating }} <i class="bi bi-star-fill"></i> • {{ $rev->created_at->format('d/m/Y') }}
                                </div><br><br>

                                <div class="row">
                                    <p>{{ $rev->comment }}</p><br>
                                </div>
                            </div>
                        </div><br>   
                    @endforeach
                @else
                    <h5 style="text-align:center;">Este produto ainda não tem avaliações.</h5>
                @endif

                {{ $reviews->links() }}              
            </div>
        </div>
    </div>
</div>

<script>
  // rwview script
  const rangeInput = document.getElementById('range4');
  const rangeOutput = document.getElementById('rangeValue');

  // Set initial value
  rangeOutput.textContent = rangeInput.value;

  rangeInput.addEventListener('input', function() {
    rangeOutput.textContent = this.value;
  });
</script>

@endsection
