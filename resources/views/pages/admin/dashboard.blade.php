@extends('templates.master')
@section('content')
    <div class="containerGerente">
        @include('includes.aside')

        <section>
            <p>{{ Auth::user()->name }}</p>
        </section>
    </div>
@endsection
