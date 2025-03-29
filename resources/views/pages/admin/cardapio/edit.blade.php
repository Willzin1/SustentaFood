@extends('templates.master')

@section('content')

<div class="containerGerente">
        @include('includes.aside')

    <div class="container-reserva">
        <h2>Editar Prato</h2>

        <form action="{{ route('admin.cardapio.update', ['prato' => $prato->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nome" class="form-label">Nome do Prato</label>
                <input type="text" class="form-control" id="nome" name="nome" value="{{ $prato->nome }}" required>
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3" required>{{ $prato->descricao }}</textarea>
            </div>

            <div>
                <label for="categoria">Categoria</label>
                <select name="categoria" required>
                    <option value="Entradas">Entrada</option>
                    <option value="Prato Principal">Prato Principal</option>
                    <option value="Sobremesas">Sobremesa</option>
                    <option value="Bebidas">Bebida</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="imagem" class="form-label">Imagem</label>
                <input type="file" class="form-control" id="imagem" name="imagem">
                @if($prato->imagem)
                    <img src="{{ $prato->imagem_url }}" width="100" class="mt-2">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="{{ route('admin.cardapio.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
