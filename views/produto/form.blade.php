@extends('layouts.base')
@section('menu')
@endsection
@section('conteudo')
{{-- CONTEUDO --}}
    <h2>
        @if ($produto) 
            Editar produto Código: {{ $produto->id_produto}}
        @else 
            Novo Produto
        @endif
    </h2> 
    <br>
    <br>
    {{-- FORMULARIO --}}
    @if($produto)
        {{-- EDITAR --}}
        <form action="{{ route('produto.update', ['id'=>$produto->id_produto]) }}" method="POST">
    @else
        {{-- CADASTRAR --}}
        <form action="{{ route('produto.store') }}" method="POST">
    @endif
        @csrf
        <div class="row">
            <div class="col-md-4 offset-md-2">
                <label for="produto" class="form-label">Nome do Produto*</label>
                <input type="text" name="produto" id="produto" class="form-control" value="{{ $produto ? $produto->produto : '' }}" required>
            </div>
            <div class="col-md-4">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control">
            </div>
            <div class="col-md-12">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea name="descricao" id="descricao" cols="30" rows="10" class="form-control">{{ $produto ? $produto->descricao : '' }}</textarea>
            </div>
            <div class="col-md-2 offset-md-10 mt-3">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route('produto.index') }}" class="btn btn-danger">Cancelar</a>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn @if($produto)btn-primary @else btn-success @endif">@if($produto) Atualizar @else Cadastrar @endif</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{-- /FORMULARIO --}}
{{-- /CONTEUDO --}}
@endsection