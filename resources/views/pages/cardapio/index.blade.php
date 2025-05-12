@extends('templates.master')

@section('title')
Sustenta Food | Cardápio
@endsection

@section('content')
    <section id="menu">
        <h2 class="section-title">Cardápio</h2>

        @foreach(['Entradas', 'Prato principal', 'Sobremesas', 'Cardapio infantil', 'Bebidas'] as $categoria)
            <h3 class="section-subtitle">{{ $categoria }}</h3>
            <div id="dishes">
                @foreach($pratos->where('categoria', $categoria) as $prato)
                    <div class="dish">
                        <img src="http://20.186.89.170/storage/{{ $prato['imagem'] }}" class="dish-image" alt="{{ $prato['nome'] }}">
                        <h3 class="dish-title">{{ $prato['nome'] }}</h3>
                        <span class="dish-description">{{ $prato['descricao'] }}</span>
                    </div>
                @endforeach
            </div>
        @endforeach
    </section>
@endsection
