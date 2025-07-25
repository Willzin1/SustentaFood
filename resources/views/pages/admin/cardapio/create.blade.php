@extends('templates.master')

@section('title', 'Sustenta Food | Admin')

@section('content')
<div class="dashboard-container">
    @include('includes.aside')
    <div class="containerGerente">
        <div class="dashboard-content">
            <div class="dashboard-dishes">

                <h2>Adicionar Prato</h2>

                <form action="{{ route('admin.cardapio.store') }}" class="prato-form" method="POST" enctype="multipart/form-data">
                    @csrf

                    <label for="nome">Nome do Prato</label>
                    <input type="text" name="nome" class="validar nome" id="nome" value="{{ old('nome') }}">

                    <label for="descricao">Descrição</label>
                    <textarea name="descricao" class="validar descricao" id="descricao">{{ old('descricao') }}</textarea>

                    <label for="categoria">Categoria</label>
                    <select name="categoria" class="validar categoria" id="categoria">
                        <option value="Entradas">Entradas</option>
                        <option value="Prato principal">Prato Principal</option>
                        <option value="Sobremesas">Sobremesas</option>
                        <option value="Cardapio infantil">Cardápio Infantil</option>
                        <option value="Bebidas">Bebidas</option>
                    </select>

                    <label for="imagem">Imagem</label>
                    <input type="file" name="imagem" class="validar imagem" id="imagem" accept="image/*">

                    <div class="btn-group">
                        <button type="submit">Adicionar Prato</button>
                        <a href="{{ route('admin.cardapio.index') }}" class="btnA">Voltar</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
