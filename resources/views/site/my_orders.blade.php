@extends('site.layouts.layout')
@section('title', 'Meus pedidos')

@section('conteudo')

<div class="container">
    <div style="margin: 30px 0px 0px 0px">
        
        
        @if ($orders->total() > 0)                       
            <h1 style="text-align: center;"><b>SEUS PEDIDOS</b></h1>                       
        @else
            <h1 style="text-align: center;"><b>NENHUM PEDIDO REGISTRADO</b></h1>
            <a href="{{ route('products.index') }}" class="btn btn-success btn-lg d-flex justify-content-center"><b>COMPRAR AGORA</b></a>            
        @endif

        @foreach ($orders as $od)
            @if (($od->user_id) === Auth::id())
                <div class="col d-flex justify-content-center">
                    <div class="card mb-3" style="max-width: 1200px;">
                        <div class="row g-0">
                            <!-- Imagem -->
                            <div class="col-md-4">
                                <a href="{{ route('products.show', $od->product->code) }}">
                                    <img src="{{ asset('storage/' . $od->product->image_path) }}" class="img-fluid rounded-start" alt="{{ strtoupper($od->product->name) }}">
                                </a>   
                            </div>

                            <!-- Conteúdo -->
                            <div class="col-md-8">
                                <div class="card-body d-flex flex-column justify-content-between h-100">
                                    <div>
                                        <div class="d-flex justify-content-between align-items-center mt-2">
                                            <h5 class="card-title">
                                                <a href="{{ route('products.show', $od->product->code) }}" class="text-decoration-none text-dark">
                                                {{ strtoupper($od->product->name) }} <small class="text-muted">{{ $od->product->fornecedor }}</small>
                                                </a>
                                            </h5>                                                                                       
                                        </div>
                                        
                                        <p class="card-text">Código do pedido: <b>{{ $od->code }}</b></p>
                                        <p class="card-text">Gênero: <small class="text-muted">{{ $od->product->category->name }}</small></p>
                                        <p class="card-text">Data do pedido: <small class="text-muted">{{ $od->created_at->format('d/m/Y') }}</small></p>
                                        <p class="card-text">Status: <small class="text-muted">{{ $od->status }}</small></p>
                                        <p class="card-text">Método de pagamento: <small class="text-muted">{{ $od->payment_method === 'credit' ? 'Crédito' : 'Pix' }}</small></p>
                                    </div>
  
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <p>Preço unitário: <b>R$ {{ number_format($od->pc_price, 2, ',', '.') }}</b></p>                                    
                                        <p>Total do pedido: <b>R$ {{ number_format($od->total_price, 2, ',', '.') }}</b></p>                                    
                                        <div class="d-flex justify-content-end">
                                            <div class="mb-2">
                                                <p>Tamanho: <b>{{ $od->size->size }}</b></p>

                                                <div class="col-auto">
                                                    <div class="col-auto">
                                                        <p>Quantidade: {{ $od->quantity }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>     
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            @endif
        @endforeach      
    </div>
</div>
@endsection
