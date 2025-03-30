@extends('templates.master')
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
        <form action="{{ route('reservas.update', ['reserva' => $reserva->id]) }}" class="formulario" method="POST" onsubmit="return validarReserva()">
            <input type="hidden" name="_method" value="PUT">
            @csrf
            <div class="grupo-formulario-reserva">
                <label for="data">Data:</label>
                <input type="text" id="data" name="data" class="validar" placeholder="Selecione a data da reserva" value="{{ $reserva->data }}">
                @error('data')
                    <p class="msg-erro">{{ $message }}</p>
                @enderror
            </div>

            <div class="grupo-formulario-reserva">
                <label for="hora">Hora:</label>
                <select id="hora" name="hora">
                    <option value="{{  $reserva->hora }}">{{  $reserva->hora->format('H:i') }}</option>
                </select>
                @error('hora')
                    <p class="msg-erro">{{ $message }}</p>
                @enderror
            </div>

            <div class="grupo-formulario-reserva">
                <label for="quantidade_cadeiras">Quantidade de Assentos:</label>
                <select id="quantidade_cadeiras" name="quantidade_cadeiras">
                    <option value="{{ $reserva->quantidade_cadeiras }}">{{ $reserva->quantidade_cadeiras }}</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="mais">+ Mais</option>
                </select>
                <input type="number" id="custom_assentos" name="quantidade_custom" class="hidden" placeholder="Quantidade personalizada" min="5" value="{{ $reserva->quantidade_cadeiras }}">
                @error('quantidade_custom')
                    <p class="msg-erro">{{ $message }}</p>
                @enderror
            </div>

            <div class="button-container">
                <button type="submit" id="button-reserva" class="shadow__btn" onclick="adicionarReserva()">Editar reserva</button>
            </div>
        </form>

        <div class="button-container">
            <form action="{{ route('reservas.destroy', ['reserva' => $reserva->id]) }}" method="POST" class="">
                @method('DELETE')
                @csrf
                <button type="submit" id="button-reserva" class="shadow__btn btn-red">Excluir reserva</button>
            </form>
            <a href="{{ route('users.show', ['user' => Auth::user()->id]) }}">
                <button type="button" id="button-reserva" class="shadow__btn">Voltar ao perfil</button>
            </a>
        </div>

    </div>
@endsection
