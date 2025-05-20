@extends('templates.master')

@section('title')
Sustenta Food | Admin
@endsection

@section('content')
    <div class="containerGerente">
        @include('includes.aside')

        <div class="container">
            <h2 class="">Relatório de Reservas</h2>
            <div class="">
                <div class="">
                    <div class="">
                        <div class="">
                            <h5 class="">Hoje</h5>
                            <p class="" id="totalDia">...</p>
                            <small><a href="{{ route('admin.reservas.dia') }}">ver todas</a></small>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="">
                        <div class="">
                            <h5 class="">Esta Semana</h5>
                            <p class="" id="totalSemana">...</p>
                            <small><a href="{{ route('admin.reservas.semana') }}">ver todas</a></small>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="">
                        <div class="">
                            <h5 class="">Este Mês</h5>
                            <p class="" id="totalMes">...</p>
                            <small><a href="{{ route('admin.reservas.mes') }}">ver todas</a></small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="">
                <h5 class="">Reservas do mês</h5>
                <canvas id="reservasChart" height="100"></canvas>
            </div>
        </div>
    </div>
@endsection
