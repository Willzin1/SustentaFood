@extends('templates.master')

@section('content')
    <div class="containerGerente">
        @include('includes.aside')

        <section id="reservas">
            <h2>Todas as Reservas</h2>
            <div class="reservas-tabela">
                @if($reservas->isEmpty())
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
                            @foreach($reservas as $reserva)
                                <tr>
                                    <td>{{ $reserva->id }}</td>
                                    <td><a href="{{ route('admin.user', ['user' => $reserva->user->id]) }}">{{ $reserva->user->name }}</a></td>
                                    <td>{{ $reserva->data->format('d-m-Y') }}</td>
                                    <td>{{ $reserva->hora->format('H:i') }}</td>
                                    <td>{{ $reserva->quantidade_cadeiras }}</td>
                                    <td><a href="{{ route('admin.reserva.edit', ['reserva' => $reserva->id]) }}">Gerenciar reserva</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <div class="pagination">
                {{ $reservas->links() }}
            </div>
        </section>
    </div>
@endsection
