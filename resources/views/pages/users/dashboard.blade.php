@extends('templates.master')

@section('title')
Sustenta Food | Perfil
@endsection

@section('content')
    <section id="profile">
        <h2 class="section-title">Meu Perfil</h2>
        <div class="profile-container">
            <div class="profile-picture">
                <img src="{{ asset('assets/images/avatar.png') }}" alt="Foto do Usuário">
            </div>

            <div class="profile-info">
                <h3>{{ $user['name'] }}</h3>
                <p><strong>Email: </strong>{{ $user['email'] }}</p>
                <p class="phoneUser">{{ $user['phone'] }} </p>
                <!-- <p><strong>Localização:</strong> São Paulo, SP</p>-->
                <!-- Botão para editar perfil -->
                <a href="{{ route('users.edit', $user['id']) }}"><button class="profile-button" id="edit-profile-btn">Editar Perfil</button></a>

                <li>
                    <form action="{{ route('login.destroy') }}" method="POST">
                        @csrf
                        <button type="submit" class="profile-button btn-red">Sair</button>
                    </form>
                </li>
            </div>
        </div>
    </section>

    <!-- PARTE DAS RESERVAS -->
    <section id="minhasReservas">
        <h2 class="section-title">Minhas Reservas</h2>

        @if(empty($reservas))
            <p>Você ainda não tem reservas.</p>
        @else
            <div class="reservations">
                @foreach($reservas as $reserva)
                    <div class="reservation-card">
                        @if($reserva['status'] == 'confirmada')
                        <p class="confirmed-reservation">Reserva confirmada</p>
                        <p class="reserDate"><strong>Data:</strong> {{ $reserva['data'] }}</p>
                        <p class="reserTime"><strong>Hora:</strong> {{ date('H:i', strtotime($reserva['hora'])) }}</p>
                        <p><strong>Quantidade cadeiras:</strong> {{ $reserva['quantidade_cadeiras'] }}</p>
                            <form action="{{ route('reservas.cancel', ['reserva' => $reserva['id']]) }}" method="post">
                                @csrf
                                <button type="submit" class="button-link">Cancelar reserva</button>
                            </form>
                        @else
                            <p class="reserDate"><strong>Data:</strong> {{ $reserva['data'] }}</p>
                            <p class="reserTime"><strong>Hora:</strong> {{ date('H:i', strtotime($reserva['hora'])) }}</p>
                            <p><strong>Quantidade cadeiras:</strong> {{ $reserva['quantidade_cadeiras'] }}</p>

                            <a href="{{ route('reservas.edit', ['reserva' => $reserva['id']]) }}" class="btn-link btn-link-dark">Editar reserva</a>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

        <a href="{{ route('reservas.create') }}"><button class="profile-button btn-Res" id="make-reservation">Fazer Nova Reserva</button></a>
    </section>
    </div>
@endsection
