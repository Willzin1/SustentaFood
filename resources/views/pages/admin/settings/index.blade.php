@extends('templates.master')

@section('title', 'Sustenta Food | Admin')

@section('content')
<div class="dashboard-container">

    @include('includes.aside')
    <div class="containerGerente">
        <div class="dashboard-content">
            <div class="admin-settings">

                <h3>Informações do Administrador</h3>
                <p><strong>Administrador:</strong> {{ session('user_name') }}</p>
                <p><strong>E-mail administrador:</strong> {{ session('user_email') }}</p>
                
                <h3>Configurações do Sistema</h3>
                <p><strong> Status de novas reservas:</strong> <span class="reservation-status">{{ $settings['reservas_pausadas'] === 'true' ? 'Pausadas' : 'Ativas' }}</span></p>
                <p><strong>Capacidade:</strong> {{ $settings['capacidade_maxima'] }} pessoas</p>
                <button type="button" class="change-capacity-btn" id="openCapacityModal">Alterar capacidade</button>
                
                @if($settings['reservas_pausadas'] === 'true')
                <button type="button" class="reservation-status-btn" onclick="unpauseReservations()">Retomar novas reservas</button>
                @elseif($settings['reservas_pausadas'] === 'false')
                <button type="button" class="reservation-status-btn" onclick="pauseReservations()">Pausar novas reservas</button>
                @endif
            </div>
        </div>

        @include('includes.modalChangeCapacity')
    </div>
</div>
@endsection
