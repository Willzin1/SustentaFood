<aside class="barra-lateral">
    <h2><a href="{{ route('admin.dashboard') }}">Dashboard</a></h2>
     <!--<hr class="aside-divider"> -->
    <ul class="aside-section">
        <li class="aside-dropdown">
            <span class="aside-title">Reservas ▾</span>
            <ul class="aside-submenu">
                <li><a href="{{ route('admin.reservas.dia') }}">Reservas do dia</a></li>
                <li><a href="{{ route('admin.reservas.semana') }}">Reservas da semana</a></li>
                <li><a href="{{ route('admin.reservas.mes') }}">Reservas do mês</a></li>
                <li><a href="{{ route('admin.reservas.index') }}">Ver todas</a></li>
            </ul>
        </li>

    </ul>
    <!--<hr class="aside-divider"> -->
    <ul class="aside-section">
        <li class="aside-dropdown">
            <span class="aside-title">Menu ▾</span>
            <ul class="aside-submenu">
                <li><a href="{{ route('admin.cardapio.index') }}">Editar menu</a></li>
                <li><a href="{{ route('admin.cardapio.create') }}">Adicionar prato</a></li>
            </ul>
        </li>


    </ul>
    <!--<hr class="aside-divider"> -->
    <ul class="aside-section">
        <li class="aside-dropdown">
            <span class="aside-title">Favoritos ▾</span>
            <ul class="aside-submenu">
                <li><a href="{{ route('admin.favoritos') }}">Pratos favoritados</a></li>
            </ul>
        </li>
    </ul>
    
    <!-- <hr class="aside-divider"> -->
    <ul class="aside-section">
        <li  class="aside-dropdown">
            <span class="aside-title">Configurações ▾</span>
            <ul class="aside-submenu">
                <li><a href="{{ route('admin.config.index') }}">Configurações Gerais</a></li>
            </ul>
        </li>
        
    </ul>
</aside>
