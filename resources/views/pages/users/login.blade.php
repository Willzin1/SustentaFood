@extends('templates.master')
@section('content')
<div id="menu">
    <div class="login-container">
        <h1>Faça seu login.</h1>

        @if(session()->has('success'))
            <div class="alert-custom alert-success-custom">
                <p>{{ session('success') }}</p>
            </div>
        @elseif(session()->has('error'))
            <div>
                <p class="text-danger">{{ session('error') }}</p>
            </div>
        @endif

        <form action="{{ route('login.store') }}" method="POST">
            @csrf
            <div class="grupo-formulario">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Digite seu e-mail" value="{{ old('email') }}">
                @error('email')
                    <p class="msg-erro">{{ $message }}</p>
                @enderror
            </div>

            <div class="grupo-formulario">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="password" placeholder="Digite sua senha">
                @error('password')
                    <p class="msg-erro">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="shadow__btn">Entrar</button>
        </form>

        <div class="linha-separacao">
            <p>Ainda não tem uma conta? <a href="{{ route('register.create') }}" class="link-login"><br>Cadastre-se</a></p>
        </div>
    </div>
</div>
@endsection
