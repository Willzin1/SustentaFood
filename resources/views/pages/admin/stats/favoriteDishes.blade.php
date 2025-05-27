@extends('templates.master')

@section('title', 'Sustenta Food | Admin')

@section('content')
<div class="containerGerente">
    @include('includes.aside')
    <div class="container stats-container">
        <h2>Estatísticas de Pratos Favoritados</h2>
        <div class="stats-item">
            <h2>Bebidas</h2>
            <canvas class="dishesChart" height="150"></canvas>
            <small><button type="button" class="export-button">Exportar</button></small>
        </div>
        <div class="stats-item">
            <h2>Cardápio Infantil</h2>
            <canvas class="dishesChart" height="150"></canvas>
            <small><button type="button" class="export-button">Exportar</button></small>
        </div>
        <div class="stats-item">
            <h2>Cardápio Principal</h2>
            <canvas class="dishesChart" height="150"></canvas>
            <small><button type="button" class="export-button">Exportar</button></small>
        </div>
        <div class="stats-item">
            <h2>Entradas</h2>
            <canvas class="dishesChart" height="150"></canvas>
            <small><button type="button" class="export-button">Exportar</button></small>
        </div>
        <div class="stats-item">
            <h2>Sobremesas</h2>
            <canvas class="dishesChart" height="150"></canvas>
            <small><button type="button" class="export-button">Exportar</button></small>
        </div>
    </div>
</div>
@endsection
