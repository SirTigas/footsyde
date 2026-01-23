@if(Auth::user()->role === 'admin' && Auth::user()->email_verified_at != NULL)
    @extends('admin.layouts.layout_orders')


    @section('conteudo')
    <div class="container-fluid" style="margin:30px 0px 0px 0px">
        @if ($mensagem = Session::get('success'))
            <p class="d-flex justify-content-center" style="color:green">{{ $mensagem }}</p>
        @endif

        @if(count($orders) == 0)
            <div class="row" style="margin: 50px 0px 50px 0px">
                <div class='col'>
                    <h1 class="text-center" style="font-weight: bolder">Sem registro de pedidos!</h1>
                </div>
            </div> 
        @else
                @foreach ($orders as $od )
                    <form action="{{ route('admin.update.orders') }}" method="POST"> 
                            @csrf
                            <div class="col d-flex justify-content-center">
                                <div class="card mb-3" style="max-width: 1150px;">
                                    <div class="row g-0">
                                        
                                        <!-- Imagem -->
                                        <div class="col-md-5">
                                            <a href="{{ route('products.show', $od->product->code) }}">
                                                <img src="{{ asset('storage/' . $od->product->image_path) }}" class="img-fluid rounded-start" alt="{{ strtoupper($od->product->name) }}">                            
                                            </a>
                                        </div>

                                        <!-- Conteúdo -->
                                        <div class="col-md-7">
                                            <div class="card-body d-flex flex-column justify-content-between h-100">
                                                <div>
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
                                                        <p class="card-text">Método de pagamento: <small class="text-muted">{{ $od->payment_method === 'credit' ? 'Crédito' : 'Pix' }}</small></p>
                                                        <p class="card-text">Data do pedido: <small class="text-muted">{{ $od->created_at->format('d/m/Y') }}</small></p><br>
                                                    </div>

                                                    <div class="mb-3 col-4">
                                                        <select name="status" id="gener" class="form-select @error('category_id') is-invalid @enderror" aria-label="Default select example" required>
                                                            <option value="{{ $od->status }}">Status: {{ $od->status }}</option>
                                                            <option value="{{ $od->status === 'analyzing' ? 'success' : 'analyzing' }}">{{ $od->status === 'analyzing' ? 'success' : 'analyzing' }}</option>
                                                        </select>
                                                        <input type="hidden" name="id" value="{{ $od->id }}">
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

                                                    <div class="d-flex justify-content-between align-items-center mt-2">
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
            {{ $orders->links() }}
        </div>
        @endif
    @endsection
@endif