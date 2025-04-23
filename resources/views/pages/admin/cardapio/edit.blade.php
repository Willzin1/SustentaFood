@extends('templates.master')

@section('title')
Sustenta Food | Admin
@endsection


@section('content')

<div class="containerGerente">
    @include('includes.aside')

    <div class="container-reserva">
        @if(session()->has('success'))
            <div class="alert-custom alert-success-custom">
                <p>{{ session('success') }}</p>
            </div>
        @elseif(session()->has('error'))
            <div class="alert-custom alert-danger-custom">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <h2>Editar Prato</h2>

        <form action="{{ route('admin.cardapio.update', ['prato' => $prato['id']]) }}" class="prato-form" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label for="nome" class="form-label">Nome do Prato</label>
            <input type="text" class="form-control validar nome" id="nome" name="nome" value="{{ $prato['nome'] }}">

            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control validar descricao" id="descricao" name="descricao" rows="3">{{ $prato['descricao'] }}</textarea>

            <label for="categoria">Categoria</label>
            <select name="categoria" id="categoria" class="validar categoria" required>
                <option value="{{ $prato['categoria'] }}">{{ $prato['categoria'] }}</option>
                <option value="Entradas">Entradas</option>
                <option value="Prato principal">Prato principal</option>
                <option value="Sobremesas">Sobremesas</option>
                <option value="Bebidas">Bebidas</option>
            </select>

            <label for="imagem" class="form-label">Imagem</label>
            <input type="file" class="form-control validar imagem" id="imagem" name="imagem">

            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="{{ route('admin.cardapio.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
