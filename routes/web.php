<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ListaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

/**
 * Rotas de PRODUTOS
 */

Route::prefix('produtos')->group(function () {
    Route::get('/', [ProdutoController::class, 'index'])
        ->name('produto.index');

    Route::get('/novo',[ProdutoController::class, 'create'])
        ->name('produto.create');

        Route::get('/{id}/editar',[ProdutoController::class, 'edit'])
        ->name('produto.edit');

    Route::post('/cadastrar',[ProdutoController::class, 'store'])
        ->name('produto.store');

    Route::post('/{id}/atualizar',[ProdutoController::class, 'update'])
        ->name('produto.update');

    Route::get('/{id}/ver',[ProdutoController::class, 'show'])
        ->name('produto.show');

    Route::post('/{id}/excluir',[ProdutoController::class, 'destroy'])
        ->name('produto.destroy');
});

/**
 *  /Rotas de Listas de Compras
 */
Route::prefix('listas')->group(function () {
    Route::get('/', [ListaController::class, 'index'])
        ->name('lista.index');

    Route::get('/novo',[ListaController::class, 'create'])
        ->name('lista.create');

        Route::get('/{id}/editar',[ListaController::class, 'edit'])
        ->name('lista.edit');

    Route::post('/cadastrar',[ListaController::class, 'store'])
        ->name('lista.store');

    Route::post('/{id}/atualizar',[ListaController::class, 'update'])
        ->name('lista.update');

    Route::get('/{id}/ver',[ListaController::class, 'show'])
        ->name('lista.show');

    Route::post('/{idLista}/apagarLista', [ListaController::class, 'destroy'])
        ->name('lista.destroy');
        
    Route::post('/{idLista}/adicionarProduto', [ListaController::class, 'adicionarProduto'])
        ->name('lista.adicionarProduto');

    Route::post('/{idListaProduto}/removerProduto', [ListaController::class, 'removerProduto'])
        ->name('lista.removerProduto');
    
    Route::post('/{idListaProduto}/confirmarProduto', [ListaController::class, 'confirmarProduto'])
    ->name('lista.confirmarProduto');


});


require __DIR__.'/auth.php';


