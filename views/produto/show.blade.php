@extends('layouts.base')
@section('menu')
@endsection
@section('conteudo')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if (session('edited'))
    <div class="alert alert-success">
        {{ session('edited') }}
    </div>
@endif


<h1>{{ $produto->produto }}</h1>
<p>{{ $produto->descricao }}</p>


@endsection