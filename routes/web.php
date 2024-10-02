<?php

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/', [ProdutoController::class, 'index'])->name('index');
    Route::get('/home', [ProdutoController::class, 'index'])->name('index');

    Route::name('produtos.')->prefix('produtos')->controller(ProdutoController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/list', 'list')->name('list');
        Route::get('/new', 'new')->name('new');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::post('/buscar', 'buscar')->name('buscar');
        Route::post('/deletar', 'deletar')->name('deletar');
        Route::get('/mudarStatus/{id?}', 'mudarStatus')->name('mudarStatus');
        Route::get('/preview/{id}', 'preview')->name('preview');

    });
    Route::name('fornecedores.')->prefix('fornecedores')->controller(FornecedorController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/list', 'list')->name('list');
        Route::get('/new', 'new')->name('new');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::post('/buscar', 'buscar')->name('buscar');
        Route::post('/deletar', 'deletar')->name('deletar');
        Route::get('/mudarStatus/{id?}', 'mudarStatus')->name('mudarStatus');
        Route::get('/preview*{id}', 'preview')->name('preview');

    });
});