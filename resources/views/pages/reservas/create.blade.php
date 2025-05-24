@extends('templates.master')

@section('title')
Sustenta Food | Faça sua reserva
@endsection

@section('content')
    <div class="container-reserva">
        <h1>Reserva de Mesa</h1>

        @if(! session('api_token'))
        <form action="{{ route('reservas.store') }}" class="reserva-form" method="POST">
            @csrf
            <div class="grupo-formulario">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" class="validar nome" name="name" placeholder="Informe seu nome" value="{{ old('name') }}">
                </div>

                <div class="grupo-formulario">
                    <label for="email">Email:</label>
                    <input type="email" id="email" class="validar email" name="email" placeholder="exemplo@gmail.com" value="{{ old('email') }}">
                </div>

                <div class="grupo-formulario">
                    <label for="telefone">Telefone:</label>
                    <input type="tel" name="phone" class="validar telefone" maxlength="15" id="telefone" placeholder="Tel: (00) 00000-0000" value="{{ old('phone') }}">
                </div>
                <div class="grupo-formulario-reserva">
                        <label for="data">Data:</label>
                        <input type="text" id="data" name="data" class="validar dataRes" placeholder="Selecione a data da reserva" value="{{ old('data') }}">
                    </div>

                    <div class="grupo-formulario-reserva">
                        <label for="hora">Hora:</label>
                        <select id="hora" name="hora">
                            <option value="" disabled selected>Selecione a Hora</option>
                        </select>
                    </div>

                    <div class="grupo-formulario-reserva">
                        <label for="quantidade_cadeiras">Quantidade de Assentos:</label>
                        <select id="quantidade_cadeiras" class="validar quantidade_cadeiras" name="quantidade_cadeiras">
                            <option value="" disabled selected>Selecione a quantidade de assentos</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="mais">+ Mais</option>
                        </select>
                        <input type="number" id="custom_assentos" name="quantidade_custom" class="hidden" placeholder="Quantidade personalizada" min="5">
                    </div>

                    <div class="button-container">
                        <button type="submit" id="button-reserva" class="shadow__btn">Reservar</button>
                    </div>
                </form>
            @else
                <form action="{{ route('reservas.store') }}" class="reserva-form" method="POST">
                    @csrf
                    <div class="grupo-formulario-reserva">
                        <label for="data">Data:</label>
                        <input type="text" id="data" name="data" class="validar dataRes" placeholder="Selecione a data da reserva" value="{{ old('data') }}">
                    </div>

                    <div class="grupo-formulario-reserva">
                        <label for="hora">Hora:</label>
                        <select id="hora" name="hora">
                            <option value="" disabled selected>Selecione a Hora</option>
                        </select>
                    </div>

                    <div class="grupo-formulario-reserva">
                        <label for="quantidade_cadeiras">Quantidade de Assentos:</label>
                        <select id="quantidade_cadeiras" class="validar quantidade_cadeiras" name="quantidade_cadeiras">
                            <option value="" disabled selected>Selecione a quantidade de assentos</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="mais">+ Mais</option>
                        </select>
                        <input type="number" id="custom_assentos" name="quantidade_custom" class="hidden" placeholder="Quantidade personalizada" min="5">
                    </div>

                    <div class="button-container">
                        <button type="submit" id="button-reserva" class="shadow__btn">Reservar</button>
                        <a href="{{ route('users.show', ['user' => session('user_id')]) }}">
                            <button type="button" id="button-reserva" class="shadow__btn">Voltar ao perfil</button>
                        </a>
                    </div>
                </form>
            @endif
    </div>
@endsection
