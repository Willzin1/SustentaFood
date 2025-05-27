@extends('templates.master')

@section('title')
Sustenta Food | Admin
@endsection

@section('content')
    <div class="containerGerente">
        @include('includes.aside')

        <div class="container">
            <h2 class="">Gráfico de Reservas</h2>
            <div class="">
                <div class="">
                    <h5 class="">Hoje</h5>
                    <canvas class="reservasChart" height="150"></canvas>
                    <small><a href="{{ route('admin.reservas.dia') }}">Ver todas</a> | <button type="button" class="export-button">Exportar</button></small>
                </div>

                <div class="">
                    <h5 class="">Esta Semana</h5>
                    <canvas class="reservasChart" height="150"></canvas>
                    <small><a href="{{ route('admin.reservas.semana') }}">ver todas</a> | <button type="button" class="export-button">Exportar</button></small>
                </div>

                <div class="">
                    <h5 class="">Este Mês</h5>
                    <canvas class="reservasChart" height="150"></canvas>
                    <small><a href="{{ route('admin.reservas.mes') }}">ver todas</a> | <button type="button" class="export-button">Exportar</button></small>
                </div>
            </div>
        </div>
    </div>
@endsection
