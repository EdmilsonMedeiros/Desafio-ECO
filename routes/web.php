<?php

use App\Http\Controllers\MovimentoDiarioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(Auth::user()){
        return redirect()->route('contribuicao.index');
    }
    return view('auth/login');
});

Auth::routes();

Route::resource('/contribuicao', App\Http\Controllers\ContribuicaoController::class);
Route::get('/contribuicao/pdf/{contribuicao}', [App\Http\Controllers\ContribuicaoController::class, 'PDFRecibo'])->name('contribuicao.pdf');
Route::resource('/contribuinte', App\Http\Controllers\ContribuinteController::class);
Route::resource('/movimentos', App\Http\Controllers\MovimentoDiarioController::class);
Route::get('/movimentos/update/{user}', [App\Http\Controllers\MovimentoDiarioController::class, 'updateMovimentosDia'])->name('updateMovimentosDia');
Route::get('/movimentos/historico/{id}', [App\Http\Controllers\MovimentoDiarioController::class, 'historico'])->name('movimentos.historico');

Route::get('/movimentos/pdf/{user}', [MovimentoDiarioController::class, 'PDFMovimentoDiario'])->name('movimentos.PDFMovimentoDiario');
