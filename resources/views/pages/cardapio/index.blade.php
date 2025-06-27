@extends('templates.master')

@section('title', 'Sustenta Food | Cardápio')

@section('content')
    <section id="menu">
        <h2 class="section-title">Cardápio</h2>

        @foreach(['Entradas', 'Prato principal', 'Sobremesas', 'Cardapio infantil', 'Bebidas'] as $categoria)
            <h3 class="section-subtitle">{{ $categoria }}</h3>
            <div id="dishes">
                @foreach($pratos->where('categoria', $categoria) as $prato)
                    <div class="dish">
                    @if(session()->has('api_token') && session('user_role') != 'admin')
                        <div class="dish-heart"
                             onclick="toggleFavorite({{ $prato['id'] }})"
                             data-prato-id="{{ $prato['id'] }}">
                            <i class="fa-solid fa-heart"></i>
                        </div>
                    @endif
                        <img src="{{ env('API_URL_STORAGE') }}/{{ $prato['imagem'] }}" class="dish-image" alt="{{ $prato['nome'] }}">
                        <h3 class="dish-title">{{ $prato['nome'] }}</h3>
                        <span class="dish-description">{{ $prato['descricao'] }}</span>
                    </div>
                @endforeach
            </div>
        @endforeach
    </section>
@endsection
