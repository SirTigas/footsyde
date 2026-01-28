@extends('site.layouts.layout')
@section('title', 'Detalhes do Produto')

@section('conteudo')
<div class="container my-5">

    {{-- ALERTAS --}}
    @if ($mensagem = Session::get('success'))
        <div class="alert alert-success text-center">{{ $mensagem }}</div>
    @endif

    @if ($mensagem = Session::get('stock'))
        <div class="alert alert-danger text-center">{{ $mensagem }}</div>
    @endif

    <div class="row g-4">

        {{-- CARROSSEL --}}
        <div class="col-12 col-lg-5">
            <div id="carouselExample" class="carousel slide">
                <div class="carousel-inner rounded-4 overflow-hidden">

                    <div class="carousel-item active">
                        <img src="{{ asset('storage/'.$product->image_path) }}" class="d-block w-100 img-fluid">
                    </div>

                    @foreach ($product->images as $path)
                        <div class="carousel-item">
                            <img src="{{ asset('storage/'.$path->path) }}" class="d-block w-100 img-fluid">
                        </div>
                    @endforeach

                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>

        {{-- DETALHES --}}
        <div class="col-12 col-lg-7">
            <h3 class="fw-bold">{{ strtoupper($product->name) }}</h3>
            <p class="text-muted">{{ $product->description }}</p>

            <p>Gênero: <b>{{ $product->category->name }}</b></p>
            <p>Vendido e entregue por: <b>{{ $product->fornecedor }}</b></p>

            <p>
                <i class="bi bi-star-fill text-warning"></i>
                {{ $avarageReview }}/5
                <small class="text-muted">({{ $reviews->total() }} avaliações)</small>
            </p>

            <h2 class="fw-bold mb-4">
                R$ {{ number_format($product->price, 2, ',', '.') }}
            </h2>

            @auth
                {{-- TAMANHO --}}
                <div class="mb-3 col-12 col-md-4">
                    <select id="sizeSelect" class="form-select" required>
                        <option value="" disabled selected>Selecione o tamanho</option>
                        @foreach ($product->sizes as $variant)
                            <option value="{{ $variant->id }}" {{ $variant->stock <= 0 ? 'disabled' : '' }}>
                                {{ $variant->stock > 0 ? $variant->size.' - ('.$variant->stock.') disponíveis' : 'ESGOTADO' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- CARRINHO --}}
                <form action="{{ route('carrinho.store') }}" method="POST" class="mb-2">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <input type="hidden" name="price" value="{{ $product->price }}">
                    <input type="hidden" name="size_id" id="cartSize">

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-cart-fill"></i> Carrinho
                    </button>
                </form>

                {{-- FAVORITOS --}}
                <form action="{{ route('favoritos.store') }}" method="POST" class="mb-2">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <button type="submit" class="btn btn-danger w-100">
                        <i class="bi bi-heart-fill"></i> Salvar
                    </button>
                </form>

                {{-- COMPRAR --}}
                <form action="{{ route('carrinho.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <input type="hidden" name="price" value="{{ $product->price }}">
                    <input type="hidden" name="redirect_buy" value="1">
                    <input type="hidden" name="size_id" id="buySize">

                    <button type="submit" class="btn btn-success btn-lg w-100">
                        <i class="bi bi-currency-dollar"></i> Comprar agora
                    </button>
                </form>
            @else
                <div class="d-grid gap-2">
                    <a href="{{ route('login') }}" class="btn btn-primary btn w-100"><i class="bi bi-cart-fill"></i> Carrinho</a>
                    <a href="{{ route('login') }}" class="btn btn-danger btn w-100"><i class="bi bi-heart-fill"></i> Salvar</a>
                    <a href="{{ route('login') }}" class="btn btn-success btn-lg w-100"><i class="bi bi-currency-dollar"></i> Comprar agora</a>
                </div>
            @endauth
        </div>
    </div>

    {{-- AVALIAÇÕES --}}
    <div class="mt-5">
        <hr>
        @if ($orders != null && $existsReview === null && $orders->status === 'success')
            <h3>• AVALIE ESTE PRODUTO</h3><br>
            <p>Você já comprou este produto, deixe a sua avaliação!</p>
            <div class="row">
                <div class="col-7 col-lg-5">
                    <form action="{{ route('review.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <output for="range4" id="rangeValue" aria-hidden="true" style="text-align:center"></output> <i class="bi bi-star-fill text-warning"></i>
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
        <h3>Comentários • Avaliações</h3>

        @if ($reviews->total() > 0)
            @foreach ($reviews as $rev)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <img src="{{ asset('storage/images/profile/default.jpg') }}" class="rounded-circle" width="40">
                            <strong>{{ $rev->user->name }}</strong>
                            <span class="text-warning">{{ $rev->rating }} ★</span>
                            <small class="text-muted">{{ $rev->created_at->format('d/m/Y') }}</small>
                        </div>
                        <p class="mb-0">{{ $rev->comment }}</p>
                    </div>
                </div>
            @endforeach
            {{ $reviews->links() }}
        @else
            <p class="text-center">Este produto ainda não tem avaliações.</p>
        @endif
    </div>
</div>

{{-- JS PARA SINCRONIZAR O TAMANHO E AS ESTRELAS DO CAMPO REVIEW --}}
<script>
    //SIZE
    const sizeSelect = document.getElementById('sizeSelect');
    const cartSize = document.getElementById('cartSize');
    const buySize  = document.getElementById('buySize');

    sizeSelect.addEventListener('change', function () {
        cartSize.value = this.value;
        buySize.value  = this.value;
    });

    //REVIEW
    const rangeInput = document.getElementById('range4');
    const rangeOutput = document.getElementById('rangeValue');

    //VALOR INICIAL
    rangeOutput.textContent = rangeInput.value;

    rangeInput.addEventListener('input', function() {
    rangeOutput.textContent = this.value;
  });
</script>
@endsection
