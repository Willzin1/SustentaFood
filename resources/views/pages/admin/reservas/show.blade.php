@extends('templates.master')

@section('title')
Sustenta Food | Admin
@endsection

@section('content')
    <div class="containerGerente">
        @include('includes.aside')

        @if(session()->has('success'))
            <div class="alert-custom alert-success-custom">
                <p>{{ session('success') }}</p>
            </div>
        @elseif(session()->has('error'))
            <div class="alert-custom alert-danger-custom">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <div class="container-reservas">
            <h2>Informações do Cliente</h2>
            <p><strong>Nome:</strong> {{ $reserva['name'] }}</p>
            <p><strong>Email:</strong> {{ $reserva['email'] }}</p>
            <p class="phoneUser"><strong>Telefone:</strong> {{ $reserva['phone'] }}</p>

            <form action="{{ route('admin.reserva.update', ['reserva' => $reserva['id']]) }}" class="reserva-form" method="POST">
                <input type="hidden" name="_method" value="PUT">
                @csrf
                <div class="grupo-formulario-reserva">
                    <label for="data">Data:</label>
                    <input type="text" id="data" name="data" placeholder="Selecione a data da reserva" value="{{ date('d-m-Y', strtotime($reserva['data'])) }}">
                </div>

                <div class="grupo-formulario-reserva">
                    <label for="hora">Hora:</label>
                    <select id="hora" name="hora">
                        <option value="{{  $reserva['hora'] }}">{{ date('H:i', strtotime($reserva['hora'])) }}</option>
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
                    <input type="number" id="custom_assentos" name="quantidade_custom" class="hidden" placeholder="Quantidade personalizada" min="5" value="{{ $reserva['quantidade_cadeiras'] }}">
                </div>

                <div class="button-container">
                    <button type="submit" id="button-reserva" class="shadow__btn">Editar reserva</button>
                </div>
            </form>

            <form action="{{ route('admin.reserva.destroy', ['reserva' => $reserva['id']]) }}" method="post">
                @method('DELETE')
                @csrf
                <div class="grupo-formulario"></div>
                <button type="submit" class="shadow__btn btn-red">Apagar reserva</button>
            </form>

            <a href="{{ route('admin.dashboard') }}">
                <button type="button" id="button-reserva" class="shadow__btn">Voltar</button>
            </a>
        </div>
    </div>
@endsection
