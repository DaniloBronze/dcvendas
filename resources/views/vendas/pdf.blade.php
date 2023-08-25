<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Venda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
        .card {
            border: none;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1 class="display-4 text-center">Detalhes da Venda</h1>
            </div>
            <div class="card-body p-4">
                <p class="lead"><strong>Cliente:</strong> {{ $clienteNome }}</p>
                <p class="lead"><strong>Produto:</strong> {{ $produtoNome }}</p>
                <p class="lead"><strong>Valor:</strong> R$ {{ $valor }}</p>
                <p class="lead"><strong>Quantidade:</strong> {{ $quantidade }}</p>
                <p class="lead"><strong>Forma de Pagamento:</strong> {{ $formaPagamento }}</p>
            </div>
        </div>
    </div>
</body>
</html>
