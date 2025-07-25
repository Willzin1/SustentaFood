@extends('templates.master')

@section('title', 'Sustenta Food | Entrar')

@section('content')
<div id="menu">
    <div class="login-container">
        <h1>Faça seu login.</h1>
        <form action="{{ route('login.store') }}" class="formulario login-form" method="POST">
            @csrf
            <div class="grupo-formulario">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="validar email" placeholder="Digite seu e-mail" value="{{ old('email') }}">
            </div>

            <div class="grupo-formulario">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="password" class="validar senha" placeholder="Digite sua senha">
            </div>

            <button type="submit" class="shadow__btn">Entrar</button>
        </form>

        <div class="linha-separacao">
            <p>Ainda não tem uma conta? <a href="{{ route('user.create') }}" class="link-login"><br>Cadastre-se</a></p>
        </div>
    </div>
</div>
@endsection
