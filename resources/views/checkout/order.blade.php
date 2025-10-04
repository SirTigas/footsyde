@extends('checkout.layouts.layout')

@section('conteudo')
<div class="justify-content-center" style="margin: 10%; background-color: #FAF9F6; border-radius:10px">
    <h1 style="text-align:center">PREENCHA O FORMULÁRIO ABAIXO!</h1><br>

    <div class="row" style="margin: 0px 0px 0px 10px">
        <Form method="#">
            @csrf
            <label for="payment_method">Selecione o metodo de pagamento:</label>
            <select name="payment_method" id="payment_method">
                <option value="Credit Card">Cartão de crédito</option>
                <option value="PIX">PIX</option>
            </select>

            <label for="payment_method">Digite o seu endereço</label>
            <input type="text" name="anddress">
            
        </Form>
    </div>
</div>

@endsection