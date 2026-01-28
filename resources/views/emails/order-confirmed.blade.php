<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pedido confirmado</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px">

    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center">
                <table width="600" style="background: #ffffff; padding: 20px">
                    
                    <tr>
                        <td align="center">
                            <img src="https://i.ibb.co/HfPtFTDF/logo.png" alt="logo-footsyde" border="0">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <h1>Olá, <strong>{{ Auth::user()->name }}</strong></h1>

                            <p>Seu pedido <strong>#{{ $codeOrder }}</strong> foi confirmado com sucesso.</p>

                            <hr>

                            <h2>Itens do pedido</h2>

                            <ul>
                                @php
                                    $total = 0;
                                @endphp

                                @foreach ($order as $item)
                                    <li>
                                        <b>{{ strtoupper($item->product->name) }}</b> <br>  
                                        | Tamanho: {{ $item->size->size }} <br> 
                                        | Qtd: {{ $item->quantity }} <br>
                                        | Status: {{ $item->status }} <br>
                                        | Total: {{  number_format($item->total_price, 2, ',', '.') }} <br><br>
                                    </li>

                                    @php
                                        $total = $total +  $item->total_price;
                                    @endphp
                                @endforeach
                            </ul>

                            <hr>

                            <p>
                                <strong>Total do pedido:</strong>
                                R$ {{ number_format($total, 2, ',', '.') }}
                            </p>

                            <p>Obrigado por comprar na Footsyde 💙</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
