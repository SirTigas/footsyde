@extends('site.layouts.layout')

@section('conteudo')
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;); margin: 1%" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('carrinho.index') }}">Carrinho</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('checkout') }}">Forma de pagamento</a></li>
        <li class="breadcrumb-item active" aria-current="page">Cartão de crédito</li>
    </ol>
</nav>

<div style="margin: 5%; background-color: #FAF9F6; border-radius: 10px">
    <h1 style="text-align:center">Preencha corretamente o formulário!</h1><br>

    <form action="{{ route('buy') }}" method="POST">
        @csrf
        <div class="container text-center">
            <div class="row">
                <div class="col-2">
                    <img src="{{ asset('images/checkout/credit_card.png') }}" alt="credit_card" width="150px">
                </div>

                <div class="col">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Nome impresso no cartão*"><br>
                            <input type="date" class="form-control" placeholder="Validade*"><br>
                            <input type="number" class="form-control" placeholder="CPF/CNPJ do titular*"><br>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control" placeholder="Número do cartão*"><br>
                            <input type="number" class="form-control" placeholder="Código de verificação*"><br>
                            <input type="date" class="form-control" placeholder="Data de nascimento*"><br>

                            <input type="hidden" value="credit" name="payment_method">
                        </div>
                    </div>
                </div>
                @if (Auth::user()->email_verified_at != NULL)
                    <div class="col-2">
                        <button class="btn btn-success justify-content-right" type="submit"><b>FINALIZAR</b> <i class="bi bi-arrow-right"></i></button>
                    </div>
                @else
                    <div class="col-2">
                        <a href="{{ route('profile.edit') }}" class="btn btn-warning justify-content-right">
                            <b>VERIFICAÇÃO DE EMAIL NECESSÁRIA!</b> <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </form>
</div>
@endsection
