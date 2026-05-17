<!-- Indica que esta página usa o layout que criamos acima -->
@extends('layouts.app')

<!-- Define o título da aba do navegador -->
@section('title', 'Painel Inicial | Alumni')

<!-- Injeta o conteúdo abaixo dentro da tag <main> do layout.blade.php -->
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body text-center py-5">
                    <h1 class="display-5 fw-bold text-primary">Bem-vindo ao Sistema Alumni</h1>
                    <p class="lead mt-3">
                        O ambiente de desenvolvimento está configurado com Laravel 13, HTMX e Bootstrap 5.
                    </p>
                    <hr class="my-4">
                    <p>
                        Para testar a reatividade do HTMX, clique no botão abaixo.
                    </p>
                    
                    <!-- Este botão fará uma requisição GET para a rota /teste-htmx e substituirá apenas o conteúdo da div #resposta -->
                    <button class="btn btn-success btn-lg" 
                            hx-get="/teste-htmx" 
                            hx-target="#resposta" 
                            hx-swap="innerHTML">
                        Testar Conexão HTMX
                    </button>

                    <div id="resposta" class="mt-4 fw-bold text-secondary"></div>
                </div>
            </div>
        </div>
    </div>
@endsection