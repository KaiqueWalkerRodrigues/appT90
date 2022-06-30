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
@if (session('danger'))
    <div class="alert alert-danger">
        {{ session('danger') }}
    </div>
@endif
{{-- CONTEUDO --}}
    <h1 class="mt-3">Produtos - 
        <a href="{{ route('produto.create') }}" class="btn btn-dark"><i class="fa-solid fa-circle-plus"></i> Novo Produto</a>
    </h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Ações</th>
                <th>Produto</th>
                <th>Foto</th>
                <th>Descrição</th>
                <th>Atualizado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produtos as $produto)
            <tr>
                <td>
                    <div class="d-flex">
                        <a href="{{ route('produto.show', ['id'=>$produto->id_produto]) }}" class="btn btn-success mx-1"><i class="fa-solid fa-eye"></i></a>
                        <a href="{{ route('produto.edit', ['id'=>$produto->id_produto]) }}" class="btn btn-primary mx-1"><i class="fa-solid fa-pen-to-square"></i></a>
                        {{-- REMOVER --}}
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalApagar" data-bs-nomeProduto="{{ $produto->produto }}" data-bs-url="{{ route('produto.destroy', ['id'=>$produto->id_produto]) }}"><i class="fa-solid fa-trash-can"></i></button>
                        {{-- /REMOVER --}}
                    </div>
                </td>
                <td>
                    {{ $produto->produto }}
                </td>
                <td>
                    Foto
                </td>
                <td>
                    {!! $produto->descricao !!}
                </td>
                <td>
                    {{ $produto->updated_at->format('d/m/Y H:i') }}h
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

{{-- MODAL --}}
<div class="modal fade" id="modalApagar" tabindex="-1" aria-labelledby="modalApagarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formApagar" method="post" action>
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    {{-- Titulo --}}
                    <h3 class="modal-title" id="modalApagarLabel"></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                        <div class="mb-3">
                            <p>Certeza que deseja apagar o Produto:</p>
                            <p id="produto" class=""></p>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-danger">Confirmar Remoção</button>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- /MODAL --}}
{{-- /CONTEUDO --}}
@endsection
@section('script')
@parent
<script>
    const modalApagar = document.getElementById('modalApagar')
    modalApagar.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget
    const nomeProduto = button.getAttribute('data-bs-nomeProduto')
    const url = button.getAttribute('data-bs-url')

    $('#produto').text(nomeProduto);
    $('.modal-title').text(nomeProduto);
    $('#formApagar').attr('action', url);

    })
</script>
@endsection