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
    <h1 class="mt-3">Listas - 
        <a href="{{ route('lista.create') }}" class="btn btn-dark"><i class="fa-solid fa-circle-plus"></i> Nova Lista de Compras</a>
    </h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Ações</th>
                <th>Status</th>
                <th>Lista</th>
                <th>Total de Produtos</th>
                <th>Usuario</th>
                <th>Atualizado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listas as $lista)
            <tr>
                <td>
                    <div class="d-flex">
                        <a href="{{ route('lista.show', ['id'=>$lista->id_lista]) }}" class="btn btn-success mx-1"><i class="fa-solid fa-eye"></i></a>
                        <a href="{{ route('lista.edit', ['id'=>$lista->id_lista]) }}" class="btn btn-primary mx-1"><i class="fa-solid fa-pen-to-square"></i></a>
                        {{-- REMOVER --}}
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalApagar" data-bs-nomeLista="{{ $lista->nome }}" data-bs-url="{{ route('lista.destroy', ['idLista'=>$lista->id_lista]) }}"><i class="fa-solid fa-trash-can"></i></button>
                        {{-- /REMOVER --}}
                    </div>
                </td>
                <td>
                    {{ $lista->status }}
                </td>
                <td>
                    {{ $lista->nome }}
                </td>
                <td>
                    {!! $lista->produtos->count() !!}
                </td>
                <td>
                    {!! $lista->usuario->name !!}
                </td>
                <td>
                    {{ $lista->updated_at->format('d/m/Y H:i') }}h
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
{{-- /CONTEUDO --}}
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
                                <p>Certeza que deseja apagar a lista:</p>
                                <p id="lista" class=""></p>
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
@endsection
@section('script')
@parent
<script>
    const modalApagar = document.getElementById('modalApagar')
    modalApagar.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget
    const nomeLista = button.getAttribute('data-bs-nomeLista')
    const url = button.getAttribute('data-bs-url')

    $('#lista').text(nomeLista);
    $('.modal-title').text(nomeLista);
    $('#formApagar').attr('action', url);

    })
</script>
@endsection