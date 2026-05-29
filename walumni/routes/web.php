<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EgressoController;

Route::get('/', function () {
    return redirect()->route('egresso.landing');
});

Route::get('/egressos', [EgressoController::class, 'landing'])->name('egresso.landing');

Route::get('/login', function () {
    return redirect()->route('egresso.landing');
})->name('login');

Route::post('/egressos/atualizar', [EgressoController::class, 'store'])->name('egresso.update');

Route::get('/painel', [EgressoController::class, 'dashboard'])->name('egresso.painel');

Route::get('/teste-htmx', function () {
    return '<div class="alert alert-success">O HTMX está se comunicando perfeitamente com o Laravel! O conteúdo foi carregado sem recarregar a página.</div>';
});