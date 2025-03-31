@extends('templates.master')

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
        <h2>Adicionar Prato</h2>

        <form action="{{ route('admin.cardapio.store') }}" class="prato-form" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="nome">Nome do Prato</label>
            <input type="text" name="nome" class="validar nome" id="nome" value="{{ old('nome') }}">
            @error('nome')
                <p class="msg-erro">{{ $message }}</p>
            @enderror

            <label for="descricao">Descrição</label>
            <textarea name="descricao" class="validar descricao" id="descricao">{{ old('descricao') }}</textarea>
            @error('descricao')
                <p class="msg-erro">{{ $message }}</p>
            @enderror

            <label for="categoria">Categoria</label>
            <select name="categoria" class="validar categoria" id="categoria">
                <option value="Entradas">Entradas</option>
                <option value="Prato principal">Prato Principal</option>
                <option value="Sobremesas">Sobremesas</option>
                <option value="Cardapio infantil">Cardápio Infantil</option>
                <option value="Bebidas">Bebidas</option>
            </select>
            @error('categoria')
                <p class="msg-erro">{{ $message }}</p>
            @enderror

            <label for="imagem">Imagem</label>
            <input type="file" name="imagem" class="validar imagem" id="imagem" accept="image/*">
            @error('imagem')
                <p class="msg-erro">{{ $message }}</p>
            @enderror

            <button type="submit">Adicionar Prato</button>
        </form>
    </div>
</div>
@endsection
