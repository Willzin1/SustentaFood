@extends('templates.master')

@section('title', 'Sustenta Food | Admin')

@section('content')
<div class="dashboard-container">

    @include('includes.aside')
    <div class="containerGerente">
        <div class="dashboard-content">
            <h3>Informações do Administrador</h3>
            <p>Administrador: {{ session('user_name') }}</p>
            <p>E-mail administrador: {{ session('user_email') }}</p>

            <h3>Configurações do Sistema</h3>
            <p>Status de novas reservas: {{ $settings['reservas_pausadas'] === 'true' ? 'Pausadas' : 'Ativas' }}</p>
            <p>Capacidade: {{ $settings['capacidade_maxima'] }}</p>
            <button type="button" class="change-capacity-btn" id="openCapacityModal">Alterar capacidade</button>


            @if($settings['reservas_pausadas'] === 'true')
                <button type="button" class="reservation-status-btn" onclick="unpauseReservations()">Retomar novas reservas</button>
            @elseif($settings['reservas_pausadas'] === 'false')
                <button type="button" class="reservation-status-btn" onclick="pauseReservations()">Pausar novas reservas</button>
            @endif
        </div>

        @include('includes.modalChangeCapacity')
    </div>
</div>
@endsection
