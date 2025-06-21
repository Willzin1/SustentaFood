@extends('templates.master')

@section('title')
Sustenta Food | Editar perfil
@endsection

@section('content')
    <div id="menu">
        <div class="login-container">
            <h1>Editar usuário.</h1>

            <form action="{{ route('users.update', ['user' => $user['id']]) }}" class="formulario" method="post">
                <input type="hidden" name="_method" value="PUT">
                @csrf
                <div class="grupo-formulario">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" class="validar nome" name="name" value="{{ $user['name'] }}">
                </div>
                <div class="grupo-formulario">
                    <label for="telefone">Telefone:</label>
                    <input type="tel" name="phone" class="validar telefone phoneUser" maxlength="15" id="telefone" value="{{ $user['phone'] }}">
                </div>

                <button type="submit" class="shadow__btn">Editar</button>
                <a class="button-link" href="{{ route('users.show', ['user' => $user['id']]) }}">Voltar ao perfil</a>
            </form>

            <form action="{{ route('users.destroy', ['user' => $user['id']]) }}" method="post">
                <input type="hidden" name="_method" value="DELETE">
                @csrf
                <div class="grupo-formulario"></div>
                <button type="submit" class="shadow__btn btn-red">Deletar Perfil</button>
            </form>

        </div>
    </div>
@endsection
