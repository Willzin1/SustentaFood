<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Verificação de E-mail</title>
    <meta http-equiv="refresh" content="10;url=/login">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            text-align: center;
            padding-top: 100px;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            display: inline-block;
        }

        a {
            color: #3490dc;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Obrigado por confirmar seu e-mail!</h1>
        <p>Você será redirecionado para a página de login em 10 segundos, ou <a href="{{ url('/login') }}">clique aqui</a>.</p>
    </div>
</body>
</html>
