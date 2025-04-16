@extends('templates.master')

@section('title')
Sustenta Food | Admin
@endsection

@section('content')
    <div class="containerGerente">
        @include('includes.aside')

        <section>
            <p>{{ Auth::user()->name }}</p>
        </section>
    </div>
@endsection
