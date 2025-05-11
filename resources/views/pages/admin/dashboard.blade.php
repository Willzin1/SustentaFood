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
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="">
                        <div class="">
                            <h5 class="">Esta Semana</h5>
                            <p class="" id="totalSemana">...</p>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="">
                        <div class="">
                            <h5 class="">Este Mês</h5>
                            <p class="" id="totalMes">...</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="">
                <h5 class="">Reservas por Dia no Mês</h5>
                <canvas id="reservasChart" height="100"></canvas>
            </div>
        </div>
    </div>
@endsection
