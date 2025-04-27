@extends('templates.master')

@section('title')
Sustenta Food | Admin
@endsection

@section('content')
    <div class="containerGerente">
        @include('includes.aside')

        <section id="reservas">
            @if(session()->has('success'))
                <div class="alert-custom alert-success-custom">
                    <p>{{ session('success') }}</p>
                </div>
            @elseif(session()->has('error'))
                <div class="alert-custom alert-danger-custom">
                    <p>{{ session('error') }}</p>
                </div>
            @endif
            <h2>Todas as Reservas</h2>

            <div class="reservas-tabela">
                <div class="searcBarDiv">
                    <select name="filter" id="filter" class="filterSelect">
                        <option value="ID" {{ request('filter') == 'ID' ? 'selected' : '' }}>ID</option>
                        <option value="Nome" {{ request('filter') == 'Nome' ? 'selected' : '' }}>Nome</option>
                        <option value="Data" {{ request('filter') == 'Data' ? 'selected' : '' }}>Data</option>
                        <option value="Hora" {{ request('filter') == 'Hora' ? 'selected' : '' }}>Hora</option>
                        <option value="Quantidade" {{ request('filter') == 'Quantidade' ? 'selected' : '' }}>Quantidade</option>
                    </select>

                    <input type="search" name="search" class="search" placeholder="Busque uma reserva (ex: ID, Nome cliente, Data, Hora)" value="{{ request('search') }}">

                    <button type="button" class="btn btn-secondary clearFilters">Limpar filtros</button>
                    <button class="btn btn-danger btnBusca">Buscar</button>
                </div class="searcBarDiv">

                @if(empty($reservas['data']))
                    <p>Não há reservas registradas.</p>
                @else
                    <table class="table-reservations">
                        <thead>
                            <tr>
                                <th>ID reserva</th>
                                <th>Nome cliente</th>
                                <th>Data reserva</th>
                                <th>Hora reserva</th>
                                <th>Quantidade pesssoas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reservas['data'] as $reserva)
                                <tr>
                                    <td>{{ $reserva['id'] }}</td>
                                    <td><a href="{{ route('admin.user', ['user' => $reserva['user']['id']]) }}">{{ $reserva['user']['name'] }}</a></td>
                                    <td>{{ date('d/m/Y', strtotime($reserva['data'])) }}</td>
                                    <td>{{ $reserva['hora'] }}</td>
                                    <td>{{ $reserva['quantidade_cadeiras'] }}</td>
                                    <td><a href="{{ route('admin.reserva.edit', ['reserva' => $reserva['id']]) }}">Gerenciar reserva</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <x-pagination :links="$reservas['links']" :currentPage="$reservas['current_page']"
                    :lastPage="$reservas['last_page']" base-url="{{ route('admin.reservas.index') }}" />
                @endif
            </div>
        </section>
    </div>
@endsection
