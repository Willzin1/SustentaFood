@extends('templates.master')

@section('title')
Sustenta Food | Edite sua reserva
@endsection

@section('content')
    <div class="container-reserva">
        @if(session()->has('success'))
            <div class="alert-custom alert-success-custom">
                <p>{{ session('success') }}</p>
            </div>
        @elseif(session()->has('error'))
            <div class="alert-custom alert-danger-custom">
                <p>{{ session('error') }}</p>
            </div>
        @endif
        <h1>Editar reserva</h1>
        <form action="{{ route('reservas.update', ['reserva' => $reserva['id']]) }}" class="reserva-form" method="POST">
            <input type="hidden" name="_method" value="PUT">
            @csrf
            <div class="grupo-formulario-reserva">
                <label for="data">Data:</label>
                <input type="text" id="data" name="data" class="validar" placeholder="Selecione a data da reserva" value="{{ $reserva['data'] }}">
            </div>

            <div class="grupo-formulario-reserva">
                <label for="hora">Hora:</label>
                <select id="hora" name="hora" class="reserTime">
                    <option value="{{  $reserva['hora'] }}">{{ $reserva['hora'] }}</option>
                </select>
            </div>

            <div class="grupo-formulario-reserva">
                <label for="quantidade_cadeiras">Quantidade de Assentos:</label>
                <select id="quantidade_cadeiras" class="validar quantidade_cadeiras" name="quantidade_cadeiras">
                    <option value="{{ $reserva['quantidade_cadeiras'] }}">{{ $reserva['quantidade_cadeiras'] }}</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="mais">+ Mais</option>
                </select>
                <input type="number" id="custom_assentos" name="quantidade_custom" class="hidden" placeholder="Quantidade personalizada" min="5" value="{{ $reserva['quantidade_cadeiras'] }}" disabled>
            </div>

            <div class="button-container">
                <button type="submit" id="button-reserva" class="shadow__btn">Editar reserva</button>
            </div>
        </form>

        <div class="button-container">
            <form action="{{ route('reservas.destroy', ['reserva' => $reserva['id']]) }}" method="POST">
                @method('DELETE')
                @csrf
                <button type="submit" id="button-reserva" class="shadow__btn btn-red">Excluir reserva</button>
            </form>
            <a href="{{ route('users.show', ['user' => $reserva['user_id']]) }}">
                <button type="button" id="button-reserva" class="shadow__btn">Voltar ao perfil</button>
            </a>
        </div>

    </div>
@endsection
