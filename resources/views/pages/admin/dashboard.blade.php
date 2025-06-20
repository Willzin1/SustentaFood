@extends('templates.master')

@section('title')
Sustenta Food | Admin
@endsection

@section('content')
<div class="dashboard-container">
    @include('includes.aside')
    <div class="containerGerente">
        <div class="dashboard-content">
            <h3 class="dashboard-title">Gráfico de Reservas</h3>
            <div class="dashboard-charts">
                <div class="dashboard-chart">
                    <h5>Hoje</h5>
                    <canvas class="reservasChart" height="150"></canvas>
                    <small>
                        <a href="{{ route('admin.reservas.dia') }}" class="btn-link btn-link-dark">Ver todas</a>
                        |
                        <button type="button" class="export-button">Exportar</button>
                    </small>
                </div>
                <div class="dashboard-chart">
                    <h5>Esta Semana</h5>
                    <canvas class="reservasChart" height="150"></canvas>
                    <small>
                        <a href="{{ route('admin.reservas.semana') }}" class="btn-link btn-link-dark">Ver todas</a>
                        |
                        <button type="button" class="export-button">Exportar</button>
                    </small>
                </div>
                <div class="dashboard-chart">
                    <h5>Este Mês</h5>
                    <canvas class="reservasChart" height="150"></canvas>
                    <small>
                        <a href="{{ route('admin.reservas.mes') }}" class="btn-link btn-link-dark">Ver todas</a>                     
                        <button type="button" class="export-button">Exportar</button>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

