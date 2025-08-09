@extends('site.layouts.layout')

@section('conteudo')

<div class="row" style="margin: 50px 0px 50px 0px">
    <div class='col'>
        <h1 class="text-center" style="font-weight: bolder">TODOS OS NOSSO PRODUTOS!</h1>
    </div>
</div>

<div class='row container'>
    @for ($i = 0; $i <= 20; $i++)
        <div class='col'>
            <div class="card" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                    <a href="#" class="btn btn-primary">COMPRAR</a>
                </div>
            </div>
            <br>
        </div>
    @endfor
    
</div>



@endsection