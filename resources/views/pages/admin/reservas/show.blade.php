@extends('templates.master')

@section('title')
Sustenta Food | Admin
@endsection

@section('content')
<div class="dashboard-container">

    @include('includes.aside')
    <div class="containerGerente">
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

                @if($reserva['status'] == 'pendente')
                    <div class="button-container">
                        <button type="submit" id="button-reserva" class="shadow__btn">Editar reserva</button>
                    </div>
                @endif
            </form>

            @if($reserva['status'] == 'confirmada')
                <button type="submit" class="button-link shadow__btn">Cancelar reserva</button>
            @endif

            <form action="{{ route('admin.reserva.destroy', ['reserva' => $reserva['id']]) }}" method="post">
                @method('DELETE')
                @csrf
                <div class="button-container">
                    <button type="submit" class="shadow__btn btn-red">Apagar reserva</button>
                </div>
            </form>

            <a href="{{ route('admin.reservas.index') }}" class="button-link btn-link btn-link-light">Voltar</a>
        </div>
    </div>
</div>

    <!-- Modal de Cancelamento -->
    <div id="cancelModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Cancelar Reserva</h2>
            <form id="cancelForm" action="{{ route('admin.reserva.cancel', ['reserva' => $reserva['id']]) }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="motivo">Motivo do cancelamento:</label>
                    <input type="text" id="motivo" name="motivo_cancelamento" required>
                </div>
                <!-- <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <textarea id="descricao" name="descricao" rows="4" required></textarea>
                </div> -->
                <div class="modal-buttons">
                    <button type="submit" class="btn-confirm">Confirmar</button>
                    <button type="button" class="btn-cancel">Cancelar</button>
                </div>
            </form>
        </div>
@endsection
