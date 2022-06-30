<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\{
    Lista,Produto,ListaProduto
};

class ListaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listas = Lista::all();
        return view('lista.index')->with(compact('listas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lista = null;
        return view('lista.form')->with(compact('lista'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lista = new Lista($request->all());
        $lista->id_user = Auth::user()->id;
        $lista->save();
        return redirect()->route('lista.show', ['id'=>$lista->id_lista])->with('sucess','Lista Criada com Sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lista  $lista
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $lista = Lista::find($id);
        $produtos = Produto::orderBy('produto')->get();
        return view('lista.show')->with(compact('lista','produtos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lista  $lista
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $lista = Lista::find($id);
        return view('lista.form')->with(compact('lista'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lista  $lista
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        // Edita Lista
        $lista = Lista::find($id);
        $lista->fill($request->all());
        $lista->save();
        return redirect()
            ->route('lista.show', ['id'=>$lista->id_lista])
            ->with('edited','Lista editada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lista  $lista
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id_lista)
    {
        $lista = Lista::find($id_lista);
        $lista->delete();
        $lista->save();

        return redirect()
                ->back()
                ->with('danger','Lista Apagada com Sucesso');
    }

    /**
     * Adciona um produto a lista
     *
     * @param integer $idLista
     * @param request $request
     * @return Response
     */
    public function adicionarProduto(int $idLista, request $request)
    {
        $listaProduto = new ListaProduto($request->all());
        $listaProduto->id_lista = $idLista;
        $listaProduto->save();
        return redirect()->route('lista.show',['id'=>$idLista])->with('success','Produto Adicionado com sucesso');
    }

    public function removerProduto(int $id_lista_produto)
    {
        $listaProduto = ListaProduto::find($id_lista_produto);
        $listaProduto->delete();
        $listaProduto->save();

        return redirect()
                ->back()
                ->with('danger','Removido com Sucesso');
    }

    public function confirmarProduto(int $id_lista_produto)
    {
        $listaProduto = ListaProduto::find($id_lista_produto);
        $listaProduto->fill(['status' => 1]);
        $listaProduto->save();

        return redirect()
                ->back();
    }

}
