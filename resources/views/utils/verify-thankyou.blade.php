@extends('templates.confirm')

@section('title', 'Verificação de E-mail')

@section('meta-refresh')
    <meta http-equiv="refresh" content="10;url=/login">
@endsection

@section('content')
    <div class="container">
        <h1>Obrigado por confirmar seu e-mail!</h1>
        <p>Você será redirecionado para a página de login em 10 segundos, ou <a href="{{ url('/login') }}">clique aqui</a>.</p>
    </div>
@endsection
