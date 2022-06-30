<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::orderBy('produto','asc')->get();
        // dd($produtos);
        return view('produto.index')->with(compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produto = null;
        return view('produto.form')
            ->with(compact('produto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produto = new Produto($request->all());
        $produto->save();
        return redirect()
            ->route('produto.show', ['id'=>$produto->id_produto])
            ->with('success','Produto Cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        // Mostrar um produto
        $produto = Produto::find($id);
        return view('produto.show')
            ->with(compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $produto = Produto::find($id);
        return view('produto.form')
            ->with(compact('produto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        // Edita produto
        $produto = Produto::find($id);
        $produto->fill($request->all());
        $produto->save();
        return redirect()
            ->route('produto.show', ['id'=>$produto->id_produto])
            ->with('edited','Produto editado com sucesso!');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $produto = Produto::find($id);
        $produto->delete();
        $produto->save();

        return redirect()
                ->back()
                ->with('danger','Produto Deletado com Sucesso');
    }
}
