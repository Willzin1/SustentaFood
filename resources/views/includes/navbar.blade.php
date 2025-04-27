<header>
    <nav id="navbar">
        <a href="{{ route('index') }}"><i class="fa-solid fa-leaf" id="nav_logo"><br>SUSTENTA<BR>FOOD</i></a>

        <ul id="nav_list">
            <li class="nav-item active">
                <a href="{{ route('index') }}">Início</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('cardapio.index') }}">Cardápio</a>
            </li>
            @if(session()->has('api_token'))
                @if(session('user_role') == 'admin')
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('users.show', ['user' => session('user_id')]) }}">Perfil</a>
                    </li>
                @endif
            @else
                <li class="nav-item">
                    <a href="{{ route('login') }}">Entrar</a>
                </li>
            @endif
        </ul>

        @if(session()->has('api_token') && session('user_role') == 'admin')
            <form action="{{ route('login.destroy') }}" method="POST">
                @csrf
                <button type="submit" class="profile-button btn-red">Sair</button>
            </form>
        @else
            <button class="btn-default">
            <a href="{{ route('reservas.create') }}">Faça sua reserva</a>
            </button>
        @endif

        <button id="mobile_btn">
            <i class="fa-solid fa-bars"></i>
        </button>
    </nav>

    <div id="mobile_menu">
        <ul id="mobile_nav_list">
            <li class="nav-item">
                <a href="{{ route('index') }}">Início</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('cardapio.index') }}">Cardápio</a>
            </li>
            @if(session()->has('api_token'))
                @if(session('user_role') == 'admin')
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('users.show', ['user' => session('user_id')]) }}">Perfil</a>
                    </li>
                @endif
            @else
                <li class="nav-item">
                    <a href="{{ route('login') }}">Entrar</a>
                </li>
            @endif
        </ul>
    <!-- ESSE BOTÃO FICA NO MODO "MOBILE" -->
        <button class="btn-default">
            <a href="{{ route('reservas.create') }}">RESERVA</a>
        </button>
    </div>
</header>
