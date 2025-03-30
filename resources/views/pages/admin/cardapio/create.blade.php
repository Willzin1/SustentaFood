@extends('templates.master')

@section('content')
<div class="containerGerente">
    @include('includes.aside')
    <div class="container-reserva">
        <h2>Adicionar Prato</h2>

        <form action="{{ route('admin.cardapio.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="nome">Nome do Prato</label>
            <input type="text" name="nome" id="nome" value="{{ old('nome') }}" required>

            <label for="descricao">Descrição</label>
            <textarea name="descricao" id="descricao" required>{{ old('descricao') }}</textarea>

            <label for="categoria">Categoria</label>
            <select name="categoria" id="categoria" required>
                <option value="Entradas">Entrada</option>
                <option value="Prato principal">Prato Principal</option>
                <option value="Sobremesas">Sobremesa</option>
                <option value="Cardapio infantil">Cardápio Infantil</option>
                <option value="Bebidas">Bebidas</option>
            </select>

            <label for="imagem">Imagem</label>
            <input type="file" name="imagem" id="imagem" accept="image/*">

            <button type="submit">Adicionar Prato</button>
        </form>
    </div>
</div>
@endsection
