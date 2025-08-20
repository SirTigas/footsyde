@extends('site.layouts.layout')

@section('conteudo')

<div class="container">
    <div class="row">
        <div class="col" style="margin: 100px 0px 50px 0px;">
            <img src="{{ asset('images/logo.png') }}" alt="footsyde-logo">
        </div>
    </div>

    <div class="row">
        <p><b>FOOTSYDE</b> é um e-commerce moderno e intuitivo, especializado em oferecer produtos de qualidade com a melhor experiência de compra online. Nosso objetivo é unir praticidade, variedade e segurança em um só lugar, para que você encontre exatamente o que procura sem complicações.</p>

        <p>Com um design responsivo, navegação simples e informações detalhadas sobre cada produto, garantimos que sua jornada de compra seja rápida e agradável. Além disso, contamos com avaliações de clientes, sistema de favoritos e um carrinho inteligente para facilitar suas escolhas.</p>

        <p>No <b>FOOTSYDE</b>, cada detalhe é pensado para você: desde a busca por produtos até o momento em que seu pedido chega à sua porta. Qualidade, confiança e inovação são a base da nossa loja.</p>
    </div>

    <div class="row" style="margin: 30px 0px 50px 0px;">
        <div class="col">
            <h4><b>Missão</b></h4>
            <p>Oferecer produtos de qualidade, com preços justos e entrega rápida, proporcionando ao cliente a melhor experiência de compra online.</p>
            <h4><b>Visão</b></h4>
            <p>Ser referência no comércio eletrônico, reconhecida pela confiança, inovação e atendimento diferenciado, expandindo nossa presença e conectando cada vez mais pessoas ao mundo digital.</p>
            <h4><b>Valores</b></h4>
            <ul>
                <li><b>confiança: </b>Relacionamentos sólidos e transparentes com nossos clientes.</li>
                <li><b>Inovação: </b>Buscar constantemente novas soluções para melhorar a experiência de compra.</li>
                <li><b>Qualidade: </b>Garantir produtos e serviços que superem as expectativas.</li>
                <li><b>Respeito: </b>Valorizar cada cliente e parceiro, mantendo a ética em todas as ações.</li>
                <li><b>Agilidade: </b>Responder com rapidez e eficiência às necessidades do mercado.</li>
            </ul>
        </div>
    </div>
</div>

@endsection