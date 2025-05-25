<aside class="barra-lateral">
    <h2><a href="{{ route('admin.dashboard') }}">Dashboard</a></h2>
    <ul>
        <li><a href="{{ route('admin.reservas.dia') }}">Reservas do dia</a></li>
        <li><a href="{{ route('admin.reservas.semana') }}">Reservas da semana</a></li>
        <li><a href="{{ route('admin.reservas.mes') }}">Reservas do mês</a></li>
        <li><a href="{{ route('admin.reservas.index') }}">Ver todas</a></li>
        <li><a href="{{ route('admin.cardapio.index') }}">Editar menu</a></li>
        <li><a href="{{ route('admin.cardapio.create') }}">Adicionar prato</a></li>
        <li><a href="{{ route('admin.favoritos') }}">Pratos favoritados</a></li>
    </ul>
</aside>
