@extends('templates.master')

@section('title')
Sustenta Food | Admin
@endsection

@section('content')
<div class="dashboard-container">
    @include('includes.aside')
    <div class="containerGerente">
        <div class="dashboard-content">
            <div class="reservas">

                <h2>{{ $titulo ?? 'Todas as Reservas' }}</h2>
                <div class="reservas-tabela">

                    <div class="filters">
                        <select name="filter" id="filter" class="filterSelect">
                            <option value="ID" {{ request('filter') == 'ID' ? 'selected' : '' }}>ID</option>
                            <option value="Nome" {{ request('filter') == 'Nome' ? 'selected' : '' }} >Nome</option>
                            <option value="Data" {{ request('filter') == 'Data' ? 'selected' : '' }}>Data</option>
                            <option value="Hora" {{ request('filter') == 'Hora' ? 'selected' : '' }}>Hora</option>
                            <option value="Quantidade" {{ request('filter') == 'Quantidade' ? 'selected' : '' }}>Quantidade</option>
                        </select>
                        <input type="search" name="search" class="search" placeholder="Busque uma reserva (ex: ID, Nome cliente, Data, Hora)" value="{{ request('search') }}">
                        <button type="button" class="btn btn-secondary clearFilters">Limpar filtros</button>
                        <button class="btn btn-danger btnBusca">Buscar</button>
                    </div>

                    @if(empty($reservas['data']))
                        <p>Não há reservas registradas.</p>
                    @else
                        <table class="table-reservations">
                            <thead>
                                <tr>
                                    <th style="border-radius: 8px 0 0 2px;">ID reserva</th>
                                    <th>Nome cliente</th>
                                    <th>Data reserva</th>
                                    <th>Hora reserva</th>
                                    <th>Quantidade pesssoas</th>
                                    <th>Status</th>
                                    <th style="border-radius: 0 8px 2px 0;"></th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reservas['data'] as $reserva)
                                    <tr>
                                        <td> {{ $reserva['id'] }}</td>
                                        <td >
                                            @if(isset($reserva['user']))
                                                <a  href="{{ route('admin.user', ['user' => $reserva['user']['id']]) }}" class="botao-ancora-reserva"> 
                                                    {{ $reserva['name'] }}</a>
                                            @else
                                                ** {{ $reserva['name'] }}
                                            @endif
                                        </td>
                                        <td>{{ date('d/m/Y', strtotime($reserva['data'])) }}</td>
                                        <td>{{ $reserva['hora'] }}</td>
                                        <td>{{ $reserva['quantidade_cadeiras'] }}</td>
                                        <td>{{ $reserva['status'] }}</td>
                                        <td><a href="{{ route('admin.reserva.edit', ['reserva' => $reserva['id']]) }}">Gerenciar</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <x-pagination :links="$reservas['links']" :currentPage="$reservas['current_page']"
                        :lastPage="$reservas['last_page']" base-url="{{ route('admin.reservas.index') }}" />
                    @endif
                </div>
            </div>
            <small>** usuários não cadastrados no sistema</small>
        </div>
    </div>
</div>
@endsection
