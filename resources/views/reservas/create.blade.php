@extends('templates.master')
@section('content')
    <div class="container-reserva">
        @if(session()->has('message'))
            <div class="alert-custom alert-danger-custom">
                <p>{{ session()->get('message') }}</p>
            </div>
        @endif
        <h1>Reserva de Mesa</h1>
        <form action="{{ route('reservas.store') }}" method="POST" onsubmit="return validarReserva()">
            @csrf
            <div class="grupo-formulario-reserva">
                <label for="data">Data:</label>
                <input type="text" id="data" name="data" placeholder="Selecione a data da reserva">
                @error('data')
                    <p class="msg-erro">{{ $message }}</p>
                @enderror
            </div>

            <div class="grupo-formulario-reserva">
                <label for="hora">Hora:</label>
                <select id="hora" name="hora">
                    <option value="" disabled selected>Selecione a Hora</option>
                </select>
                @error('hora')
                    <p class="msg-erro">{{ $message }}</p>
                @enderror
            </div>

            <div class="grupo-formulario-reserva">
                <label for="quantidade_cadeiras">Quantidade de Assentos:</label>
                <select id="quantidade_cadeiras" name="quantidade_cadeiras" onchange="mostrarInputCustomizado()">
                    <option value="" disabled selected>Selecione a quantidade de assentos</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="mais">+ Mais</option>
                </select>
                <input type="number" id="custom_assentos" name="quantidade_custom" class="hidden" placeholder="Quantidade personalizada" min="5">
                @error('quantidade_cadeiras')
                    <p class="msg-erro">{{ $message }}</p>
                @enderror
                @error('quantidade_custom')
                    <p class="msg-erro">{{ $message }}</p>
                @enderror
            </div>

            <div class="button-container">
                <button type="submit" id="button-reserva" class="shadow__btn" onclick="adicionarReserva()">Reservar</button>
                <a href="{{ route('users.show', ['user' => Auth::user()->id]) }}">
                    <button type="button" id="button-reserva" class="shadow__btn">Voltar ao perfil</button>
                </a>
            </div>
        </form>
    </div>
@endsection
