@extends('templates.master')

@section('title', 'Sustenta Food | Admin')

@section('content')
<div class="dashboard-container">

    @include('includes.aside')
    <div class="containerGerente">
        <div class="dashboard-content">
            <h3 class="dashboard-title">Estatísticas de Pratos Favoritados</h3>
            <div class="dashboard-charts">
                <div class="stats-item dashboard-chart">
                    <h2>Bebidas</h2>
                    <canvas class="dishesChart" height="150"></canvas>
                    <small><button type="button" class="export-button">Exportar</button></small>
                </div>
                <div class="stats-item dashboard-chart">
                    <h2>Cardápio Infantil</h2>
                    <canvas class="dishesChart" height="150"></canvas>
                    <small><button type="button" class="export-button">Exportar</button></small>
                </div>
                <div class="stats-item dashboard-chart">
                    <h2>Cardápio Principal</h2>
                    <canvas class="dishesChart" height="150"></canvas>
                    <small><button type="button" class="export-button">Exportar</button></small>
                </div>
                <div class="stats-item dashboard-chart">
                    <h2>Entradas</h2>
                    <canvas class="dishesChart" height="150"></canvas>
                    <small><button type="button" class="export-button">Exportar</button></small>
                </div>
                <div class="stats-item dashboard-chart">
                    <h2>Sobremesas</h2>
                    <canvas class="dishesChart" height="150"></canvas>
                    <small><button type="button" class="export-button">Exportar</button></small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
