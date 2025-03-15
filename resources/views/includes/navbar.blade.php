<!-- Onde irá ficar a NAVBAR -->
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
            @if(Auth::user())
                <li class="nav-item">
                    <a href="{{ route('users.show', ['user' => Auth::user()->id]) }}">Perfil</a>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{ route('login') }}">Entrar</a>
                </li>
            @endif
        </ul>

        <button class="btn-default">
            <a href="{{ route('reservas.create') }}" >Faça sua reserva aqui</a>
        </button>

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
            @if(Auth::user())
                <li class="nav-item">
                    <a href="{{ route('users.show', ['user' => Auth::user()->id]) }}">Perfil</a>
                </li>
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
