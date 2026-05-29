<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Alumni | ForgeIT')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --alumni-blue: #2e4e94;
            --alumni-green: #0a8f4f;
            --alumni-green-soft: #47a36f;
            --alumni-red: #e02c2c;
            --alumni-bg: #f0f2f5;
            --alumni-surface: #ffffff;
            --alumni-border: #e0e2e6;
            --alumni-text: #7a818c;
            --alumni-dark: #16213c;
        }

        body {
            min-height: 100vh;
            background:
                radial-gradient(circle at top left, rgba(46, 78, 148, 0.12), transparent 28%),
                radial-gradient(circle at top right, rgba(10, 143, 79, 0.12), transparent 26%),
                linear-gradient(180deg, #f7f9fc 0%, var(--alumni-bg) 100%);
            color: var(--alumni-dark);
        }

        .alumni-navbar {
            backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.88);
            border-bottom: 1px solid rgba(224, 226, 230, 0.9);
        }

        .alumni-brand {
            gap: 0.75rem;
        }

        .alumni-brand img {
            width: 44px;
            height: 44px;
            object-fit: contain;
        }

        .alumni-brand-text {
            line-height: 1.05;
        }

        .alumni-brand-text strong {
            color: var(--alumni-blue);
        }

        .alumni-brand-text span {
            color: var(--alumni-text);
            font-size: 0.875rem;
        }

        .alumni-main {
            flex: 1;
        }

        .alumni-footer {
            border-top: 1px solid rgba(224, 226, 230, 0.9);
            background: rgba(255, 255, 255, 0.74);
        }

        .btn-alumni-primary {
            background: var(--alumni-green);
            border-color: var(--alumni-green);
            color: #fff;
        }

        .btn-alumni-primary:hover,
        .btn-alumni-primary:focus {
            background: #087744;
            border-color: #087744;
            color: #fff;
        }

        .btn-alumni-ghost {
            border-color: rgba(46, 78, 148, 0.22);
            color: var(--alumni-blue);
        }

        .btn-alumni-ghost:hover,
        .btn-alumni-ghost:focus {
            background: rgba(46, 78, 148, 0.08);
            color: var(--alumni-blue);
        }
    </style>

    @stack('styles')
</head>
<body>

    <nav class="navbar navbar-expand-lg alumni-navbar sticky-top">
        <div class="container py-2">
            <a class="navbar-brand d-flex align-items-center alumni-brand" href="{{ route('egresso.landing') }}">
                <img src="{{ asset('assets/image/logo/logo.png') }}" alt="Logo Alumni">
                <span class="alumni-brand-text d-flex flex-column">
                    <strong>Alumni</strong>
                    <span>Acompanhamento de Egressos</span>
                </span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="ms-auto d-flex flex-column flex-lg-row gap-2 pt-3 pt-lg-0">
                    <a class="btn btn-alumni-ghost rounded-pill px-3" href="{{ route('egresso.painel') }}">Painel de indicadores</a>
                    <a class="btn btn-alumni-ghost rounded-pill px-3" href="#atualizacao">Atualizar dados</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="alumni-main" id="conteudo-dinamico">
        @yield('content')
    </main>

    <footer class="alumni-footer text-center text-muted py-4 mt-4">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
            <small>&copy; {{ date('Y') }} Alumni - Acompanhamento de Egressos</small>
            <small>Dados atualizados fortalecem empregabilidade, relacionamento institucional e indicadores MEC/Inep.</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/htmx.org@1.9.10"></script>
    <script>
        document.body.addEventListener('htmx:configRequest', (event) => {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (csrfToken) {
                event.detail.headers['X-CSRF-TOKEN'] = csrfToken;
            }
        });
    </script>

    @stack('scripts')
</body>
</html>