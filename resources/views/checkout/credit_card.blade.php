@extends('site.layouts.layout')

@section('conteudo')
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;); margin: 1%" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('carrinho.index') }}">Carrinho</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('checkout') }}">Forma de pagamento</a></li>
        <li class="breadcrumb-item active" aria-current="page">Pix</li>
    </ol>
</nav>

<div class="container" style="background-color: #FAF9F6; border-radius: 10px">
    <div>
        <h1 style="text-align:center">Preencha corretamente o formulário!</h1><br>
    </div>

    <div class="container text-center">
        <form action="{{ route('buy') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col mt-3">
                    <img src="{{ asset('images/checkout/credit_card.png') }}" alt="pix" width="150px">
                </div>

                <div class="col mt-3">
                    <input type="text" class="form-control" placeholder="Nome impresso no cartão*"><br>
                    <input type="date" class="form-control" placeholder="Validade*"><br>
                    <input type="number" class="form-control" placeholder="CPF/CNPJ do titular*"><br>

                    <input type="number" class="form-control" placeholder="Número do cartão*"><br>
                    <input type="number" class="form-control" placeholder="Código de verificação*"><br>
                    <input type="date" class="form-control" placeholder="Data de nascimento*"><br>
                    <input type="hidden" value="credit" name="payment_method">
                </div>

                <div class="col mt-3">
                    <input type="hidden" value="pix" name="payment_method">
                    @if (Auth::user()->email_verified_at != NULL)
                        <div class="col">
                            <button class="btn btn-success btn-lg justify-content-right" type="submit"><b>FINALIZAR</b> <i class="bi bi-arrow-right"></i></button>
                        </div>
                    @else
                        <div class="col">
                            <a href="{{ route('profile.edit') }}" class="btn btn-warning justify-content-right">
                                <b>VERIFICAÇÃO DE EMAIL NECESSÁRIA!</b> <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
