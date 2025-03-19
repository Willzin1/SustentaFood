@extends('templates.master')
@section('content')
    <div id="menu">
        <div class="login-container">
            @if(session()->has('success'))
                <div class="alert-custom alert-success-custom">
                    <p>{{ session('success') }}</p>
                </div>
            @elseif(session()->has('error'))
                <div class="alert-custom alert-danger-custom">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <h1>Crie sua conta.</h1>

            <form action="{{ route('register.store') }}" method="post">
                @csrf
                <div class="grupo-formulario">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="name" placeholder="Informe seu nome" value="{{ old('name') }}">
                    @error('name')
                        <p class="msg-erro">{{ $message }}</p>
                    @enderror
                </div>
                <div class="grupo-formulario">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="exemplo@gmail.com" value="{{ old('email') }}">
                    @error('email')
                        <p class="msg-erro">{{ $message }}</p>
                    @enderror
                </div>
                <div class="grupo-formulario">
                    <label for="telefone">Telefone:</label>
                    <input type="tel" name="phone" id="telefone" placeholder="Tel: 0000-0000" value="{{ old('phone') }}">
                    @error('phone')
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
                <div class="grupo-formulario">
                    <label for="confirmarSenha">Confirmar senha:</label>
                    <input type="password" name="password_confirmation" id="confirmarSenha" placeholder="Confirmar senha">
                    @error('password')
                        <p class="msg-erro">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="shadow__btn">Cadastrar</button>
                <BR>
            </form>
            <div class="linha-separacao">
                <p>Já tem uma conta? <a href="{{ route('login') }}" class="link-login">Faça login</a></p>
            </div>
        </div>
    </div>
@endsection
