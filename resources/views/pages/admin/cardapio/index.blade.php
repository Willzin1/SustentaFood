@extends('templates.master')

@section('title', 'Sustenta Food | Admin')

@section('content')
<div class="dashboard-container">
    @include('includes.aside')
    <div class="containerGerente">
        <div class="dashboard-content">
            <div class="reservas">

                <h2>Gerenciar Cardápio</h2>
                <div class="reservas-tabela"> <!-- Colocar um estilização diferenciada -->

                    <div class="filters">
                        <select name="filter" id="filter" class="filterSelect">
                            <option value="Nome" {{ request('filter') == 'Nome' ? 'selected' : '' }}>Nome</option>
                            <option value="Descricao" {{ request('filter') == 'Descricao' ? 'selected' : '' }}>Descrição</option>
                            <option value="Categoria" {{ request('filter') == 'Categoria' ? 'selected' : '' }}>Categoria</option>
                        </select>
                        <input type="search" name="search" class="search" placeholder="Busque um prato (ex: Nome, Descrição ou Categoria)" value="{{ request('search') }}">
                        <button class="btn btn-danger btnBuscaDish">Buscar</button>
                        <button type="button" class="btn btn-secondary clearFilters">Limpar filtros</button>
                    </div>

                    @if(empty($paginate['data']))
                        <p>Não há pratos registrados.</p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="border-radius: 8px 0 0 2px;">Imagem</th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th >Categoria</th>
                                    <th style="border-radius: 0 8px 2px 0;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paginate['data'] as $prato)
                                    <tr>
                                        <td><img src="{{ env('API_URL_STORAGE') }}/{{ $prato['imagem'] }}" alt="{{ $prato['nome'] }}" width="50"></td>
                                        <td>{{ $prato['nome'] }}</td>
                                        <td>{{ $prato['descricao'] }}</td>
                                        <td>{{ ucfirst($prato['categoria']) }}</td>
                                        <td class="actions">
                                            <div class="btn-group">
                                                <a href="{{ route('admin.cardapio.edit', ['prato' => $prato['id']]) }}">Editar</a>
                                                <form action="{{ route('admin.cardapio.destroy', ['prato' => $prato['id']]) }}" style="display:inline;" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit">Excluir</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <x-pagination :links="$paginate['links']" :currentPage="$paginate['current_page']"
                        :lastPage="$paginate['last_page']" base-url="{{ route('admin.cardapio.index') }}" />
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
