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

        <section>
            <p>{{ Auth::user()->name }}</p>
        </section>
    </div>
@endsection
