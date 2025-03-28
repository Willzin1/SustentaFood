@extends('templates.master')

@section('content')
    <div class="containerGerente">
        <aside class="barra-lateral">
            <h2><a href="{{ route('admin.dashboard') }}">Dashboard</a></h2>
            <ul>
                <li><a href="{{ route('admin.index') }}">Todas as Reservas</a></li>
                <li><a href="#alterar-menu">Editar menu</a></li>
            </ul>
        </aside>

        <section id="user-info">
            <h2>Informações do Cliente</h2>
            <p><strong>Nome:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Telefone:</strong> {{ $user->phone }}</p>

            <h3>Reservas do Cliente</h3>
            <div class="reservas-tabela">
                @if($reservas->isEmpty())
                    <p>Esse cliente não tem reservas.</p>
                @else
                    <table>
                        <thead>
                            <tr>
                                <th>ID reserva</th>
                                <th>Data reserva</th>
                                <th>Hora reserva</th>
                                <th>Quantidade pessoas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reservas as $reserva)
                                <tr>
                                    <td>{{ $reserva->id }}</td>
                                    <td>{{ $reserva->data->format('d-m-Y') }}</td>
                                    <td>{{ $reserva->hora->format('H:i') }}</td>
                                    <td>{{ $reserva->quantidade_cadeiras }}</td>
                                    <td><a href="{{ route('admin.show', ['reserva' => $reserva->id]) }}">Gerenciar</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </section>
    </div>
@endsection
