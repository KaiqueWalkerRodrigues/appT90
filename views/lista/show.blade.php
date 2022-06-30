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
<h1>Código: {{ $lista->id_lista }} - {{ $lista->nome }}</h1>
<p>Status: {{$lista->status}} - Usuário: {{ $lista->id_user }}</p>

{{-- FORMULÁRIO --}}
<form action="{{ route('lista.adicionarProduto', ['idLista'=>$lista->id_lista]) }}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <label for="id_produto" class="form-label">Produto *</label>
            <select name="id_produto" id="id_produto" class="form-control" required>
                <option value="">Escolha...</option>
                @foreach ($produtos as $item)
                    <option value="{{ $item->id_produto }}">{{ $item->produto }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <br>
            <button type="submit" class="btn btn-success mt-2">Adicionar Produto</button>
        </div>
    </div>
</form>
{{-- /FORMULÁRIO --}}
<br><br>
{{-- TABELA --}}
    <h1>Relação de Produtos</h1>
<table class="table">
    <thead>
      <tr>
        <th>Ações</th>
        <th>Status</th>
        <th>Produto</th>
        <th>Atualizado</th>
      </tr>
    </thead>
    <tbody class="table-group-divider">
      @foreach ($lista->produtos()->get() as $item)
      <tr>
        <th class="col-md-2">
            <div class="d-flex flex-column col-md-6">
                @if($item->status == 0)
                    {{-- <a href="{{ route('lista.confirmarProduto', ['idListaProduto'=>$item->id_lista_produto]); }}" class="btn btn-success mb-1">Confirmar</a> --}}
                    <button class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#modalConfirmar" data-bs-nomeProduto="{{ $item->produto->produto }}" data-bs-url="{{ route('lista.confirmarProduto', ['idListaProduto'=>$item->id_lista_produto]) }}">Confirmar</button>
                    {{-- REMOVER --}}
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalRemover" data-bs-nomeProduto="{{ $item->produto->produto }}" data-bs-url="{{ route('lista.removerProduto', ['idListaProduto'=>$item->id_lista_produto]) }}">Remover</button>
                    {{-- /REMOVER --}}
                @endif
            </div>
        </th>
        <td>{!! $item->iconeStatus() !!}</td>
        <td>{{ $item->produto->produto }}</td>
        <td>{{ $item->updated_at->format('d/m/Y H:i') }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>        

{{-- /TABELA --}}


{{-- MODAL CONFIRMAR --}}
<div class="modal fade" id="modalConfirmar" tabindex="-1" aria-labelledby="modalConfirmarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formConfirmar" method="post" action>
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    {{-- Titulo --}}
                    <h3 class="modal-title" id="modalConfirmarLabel"></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                        <div class="mb-3">
                            <p>Certeza que deseja confirmar o produto:</p>
                            <p id="produto"></p>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button> 
                    <button type="submit" class="btn btn-success">Confirmar Compra</button>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- /MODAL CONFIRMAR --}}

{{-- MODAL REMOVER --}}
    <div class="modal fade" id="modalRemover" tabindex="-1" aria-labelledby="modalRemoverLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formRemover" method="post" action>
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        {{-- Titulo --}}
                        <h3 class="modal-title" id="modalRemoverLabel"></h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                            <div class="mb-3">
                                <p>Certeza que deseja remover o produto:</p>
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
{{-- /MODAL REMOVER --}}

@endsection
@section('script')
@parent
    <script>
        const modalRemover = document.getElementById('modalRemover')
        modalRemover.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget
        const nomeProduto = button.getAttribute('data-bs-nomeProduto')
        const url = button.getAttribute('data-bs-url')

        $('#produto').text(nomeProduto);
        $('.modal-title').text(nomeProduto);
        $('#formRemover').attr('action', url);

        })

        const modalConfirmar = document.getElementById('modalConfirmar')
        modalConfirmar.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget
        const nomeProduto = button.getAttribute('data-bs-nomeProduto')
        const url = button.getAttribute('data-bs-url')

        $('#produto').text(nomeProduto);
        $('.modal-title').text(nomeProduto);
        $('#formConfirmar').attr('action', url);

        })
    </script>
@endsection