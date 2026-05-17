<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/teste-htmx', function () {
    return '<div class="alert alert-success">O HTMX está se comunicando perfeitamente com o Laravel! O conteúdo foi carregado sem recarregar a página.</div>';
});