<?php


use App\Http\Controllers\MotoristaController;
use App\Http\Controllers\ViagemController;
use App\Http\Controllers\VeiculoController;

Route::resource('veiculos', VeiculoController::class);
Route::resource('motoristas', MotoristaController::class);
Route::resource('viagens', ViagemController::class);

// Route::get('viagens', [ViagemController::class, 'index'])->name('viagens.index');
// Route::post('viagens', [ViagemController::class, 'store'])->name('viagens.store');
// Route::get('viagens/create', [ViagemController::class, 'create'])->name('viagens.create');
// Route::get('viagens/{viagem}', [ViagemController::class, 'show'])->name('viagens.show');
// Route::put('viagens/{viagem}', [ViagemController::class, 'update'])->name('viagens.update');
// Route::delete('viagens/{viagem}', [ViagemController::class, 'destroy'])->name('viagens.destroy');
// Route::get('viagens/{viagem}/edit', [ViagemController::class, 'edit'])->name('viagens.edit');

