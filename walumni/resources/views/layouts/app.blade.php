<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- O token CSRF em uma meta tag facilita o resgate via JavaScript -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Alumni | ForgeIT')</title>

    <!-- Bootstrap 5 CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body { display: flex; flex-direction: column; min-height: 100vh; background-color: #f8f9fa; }
        main { flex: 1; }
    </style>
</head>
<body>

    <!-- Cabeçalho / Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="/">UNIVINTE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <!-- Exemplo de navegação tradicional do Laravel -->
                        <a class="nav-link" href="/">Início</a>
                    </li>
                    <li class="nav-item">
                        <!-- Exemplo de botão pronto para carregar conteúdo via HTMX -->
                        <a class="nav-link" href="#" hx-get="/alunos" hx-target="#conteudo-dinamico">Alunos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" hx-get="/vagas" hx-target="#conteudo-dinamico">Vagas e Bolsas</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Área de Conteúdo Principal -->
    <main class="container" id="conteudo-dinamico">
        <!-- A diretiva yield define onde o conteúdo das outras páginas será injetado -->
        @yield('content')
    </main>

    <!-- Rodapé -->
    <footer class="bg-light text-center text-muted py-3 mt-4 border-top">
        <small>&copy; {{ date('Y') }} UNIVINTE. Todos os direitos reservados.</small>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- HTMX via CDN -->
    <script src="https://unpkg.com/htmx.org@1.9.10"></script>
    
    <!-- Configuração de Segurança HTMX + Laravel -->
    <script>
        // Intercepta todas as requisições do HTMX e injeta o token CSRF do Laravel
        document.body.addEventListener('htmx:configRequest', (event) => {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            if (csrfToken) {
                event.detail.headers['X-CSRF-TOKEN'] = csrfToken;
            }
        });
    </script>

    <!-- Área para injeção de scripts específicos de outras páginas -->
    @stack('scripts')
</body>
</html>