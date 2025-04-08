@extends('templates.master')

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
                @if(empty($reservas['data']))
                    <p>Não há reservas registradas.</p>
                @else
                    <table>
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
                                    <td>{{ $reserva['user']['id'] }}</td>
                                    <td><a href="{{ route('admin.user', ['user' => $reserva['user']['id']]) }}">{{ $reserva['user']['name'] }}</a></td>
                                    <td>{{ date('d-m-Y', strtotime($reserva['data'])) }}</td>
                                    <td>{{ date('H:i', strtotime($reserva['hora'])) }}</td>
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
