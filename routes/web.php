<?php

use App\Http\Controllers\ConfiguracaoTaxaController;
use App\Http\Controllers\ConsumidorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FaturaController;
use App\Http\Controllers\LeituraController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('consumidores', ConsumidorController::class)->only([
    'index', 'create', 'store', 'edit', 'update', 'destroy'
]);

Route::get('/leituras/create', [LeituraController::class, 'create'])->name('leituras.create');
Route::post('/leituras', [LeituraController::class, 'store'])->name('leituras.store');

Route::get('/faturas', [FaturaController::class, 'index'])->name('faturas.index');
Route::get('/faturas/{fatura}', [FaturaController::class, 'show'])->name('faturas.show');
Route::patch('/faturas/{fatura}/pagar', [FaturaController::class, 'pagar'])->name('faturas.pagar');

Route::get('/configuracao', [ConfiguracaoTaxaController::class, 'edit'])->name('configuracao.edit');
Route::put('/configuracao', [ConfiguracaoTaxaController::class, 'update'])->name('configuracao.update');
