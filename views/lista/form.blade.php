@extends('layouts.base')
@section('menu')
@endsection
@section('conteudo')
{{-- CONTEUDO --}}
    <h2>
        @if ($lista) 
            Editar Lista Código: {{ $lista->id_lista}}
        @else 
            Nova Lista
        @endif
    </h2> 
    <br>
    <br>
    {{-- FORMULARIO --}}
    @if($lista)
        {{-- EDITAR --}}
        <form action="{{ route('lista.update', ['id'=>$lista->id_lista]) }}" method="POST">
    @else
        {{-- CADASTRAR --}}
        <form action="{{ route('lista.store') }}" method="POST">
    @endif
        @csrf
        <div class="row">
            <div class="col-md-7 offset-md-1">
                <label for="nome" class="form-label">Nome da Lista*</label>
                <input type="text" name="nome" id="nome" class="form-control" value="{{ $lista ? $lista->nome : '' }}" required>
            </div>
            <div class="col-md-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="0" {{ ($lista && $lista->status == 0)? 'selected="selected"' : '' }}>
                        Andamento
                    </option>
                    <option value="1" {{ ($lista && $lista->status == 1)? 'selected="selected"' : '' }}>
                        Concluído
                    </option>
                </select>
            </div>

            <div class="col-md-2 offset-md-10 mt-3">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route('lista.index') }}" class="btn btn-danger">Cancelar</a>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn @if($lista)btn-primary @else btn-success @endif">@if($lista) Atualizar @else Criar @endif</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{-- /FORMULARIO --}}
{{-- /CONTEUDO --}}
@endsection