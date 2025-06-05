@extends('templates.confirm')

@section('title', 'E-mail já Confirmado')

@section('content')
    <div class="container">
        <h1>Este e-mail já foi confirmado!</h1>

        <p>O e-mail <strong id="email"></strong> já está confirmado.</p>
        <p>Para mais informações, entre em contato com o suporte.</p>
    </div>

    <script>
        const query = new URLSearchParams(window.location.search);
        const email = query.get('email');
        document.getElementById('email').textContent = email ?? 'não informado';
    </script>
@endsection
