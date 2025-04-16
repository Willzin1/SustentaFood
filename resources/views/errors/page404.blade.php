@extends('templates.master')

@section('title')
Sustenta Food
@endsection

@section('content')
    <section id="menu">
            <h1>404 - Página não encontrada</h1>
            <p class="msg-error">Opa! Parece que esta página não existe.</p>
            <a href="{{ route('index') }}" class="btn btn-primary">Voltar para home</a>
    </section>
@endsection
