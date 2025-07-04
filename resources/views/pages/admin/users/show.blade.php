@extends('templates.master')

@section('title', 'Sustenta Food | Admin')

@section('content')
<div class="dashboard-container">
    @include('includes.aside')
    <div class="containerGerente">
        <div class="dashboard-content">
            <section id="reservas">
                <h2>Informações do Cliente</h2>
                <p class="user-info user-name"><strong>Nome:</strong> {{ $user['name'] }}</p>
                <p class="user-info user-email"><strong>Email:</strong> {{ $user['email'] }}</p>
                <p class="user-info user-phone phoneUser">{{ $user['phone'] }}</p>

                <h3>Reservas do Cliente</h3>
                <div class="reservas-tabela">
                    @if(empty($reservas))
                        <p>Esse cliente não tem reservas.</p>
                    @else
                        <table class="table-reservations">
                            <thead>
                                <tr>
                                    <th style="border-radius: 8px 0 0 5px;">ID reserva</th>
                                    <th>Data reserva</th>
                                    <th>Hora reserva</th>
                                    <th>Quantidade pessoas</th>
                                    <th style="border-radius: 0 8px 5px 0;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reservas['data'] as $reserva)
                                    <tr>
                                        <td>{{ $reserva['id'] }}</td>
                                        <td>{{ date('d-m-Y', strtotime($reserva['data'])) }}</td>
                                        <td>{{ $reserva['hora'] }}</td>
                                        <td>{{ $reserva['quantidade_cadeiras'] }}</td>
                                        <td>{{ $reserva['status'] }}</td>
                                        <td><a href="{{ route('admin.reserva.edit', ['reserva' => $reserva['id']]) }}" class="btn-link btn-link-dark">Gerenciar</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <small>
                            <button onclick="exportClientToPDF()">Exportar PDF</button>
                            |
                            <a href="{{ route('admin.reservas.index') }}" class="">Voltar</a>
                        </small>
                    @endif
                </div>
            </section>
        </div>

    </div>
</div>
@endsection
