@extends('layouts.app')

@section('title', 'Alumni | Painel de Indicadores')

@push('styles')
    <style>
        .panel-hero {
            padding: 3.5rem 0 1.5rem;
        }

        .hero-kicker {
            color: var(--alumni-green);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-size: 0.78rem;
            font-weight: 700;
        }

        .hero-title {
            color: var(--alumni-blue);
            font-size: clamp(2.25rem, 5vw, 4rem);
            line-height: 1.02;
            font-weight: 800;
        }

        .hero-lead {
            color: #4f5764;
            font-size: 1.05rem;
            max-width: 42rem;
        }

        .section-muted {
            color: var(--alumni-text);
        }

        .metric-box {
            border-radius: 1.25rem;
            background: linear-gradient(180deg, rgba(46, 78, 148, 0.08), rgba(10, 143, 79, 0.08));
            border: 1px solid rgba(224, 226, 230, 0.95);
        }

        .metric-box strong {
            color: var(--alumni-blue);
            display: block;
            font-size: 1.4rem;
        }

        .metric-box span {
            color: var(--alumni-text);
            font-size: 0.9rem;
        }

        .stat-card,
        .section-card {
            border: 1px solid rgba(224, 226, 230, 0.92);
            box-shadow: 0 16px 36px rgba(22, 33, 60, 0.08);
        }

        .stat-value {
            color: var(--alumni-blue);
            font-size: clamp(1.8rem, 3vw, 2.6rem);
            font-weight: 800;
            line-height: 1;
        }

        .stat-label {
            color: var(--alumni-text);
        }

        .section-card h2,
        .section-card h3 {
            color: var(--alumni-blue);
        }

        .progress {
            height: 0.75rem;
            background: rgba(224, 226, 230, 0.9);
        }

        .progress-bar {
            background: linear-gradient(90deg, var(--alumni-green), var(--alumni-green-soft));
        }

        .table thead th {
            color: var(--alumni-blue);
            font-size: 0.88rem;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .table tbody td {
            vertical-align: middle;
        }
    </style>
@endpush

@section('content')
    <section class="panel-hero">
        <div class="container">
            <div class="row align-items-end g-3 mb-4">
                <div class="col-lg-8">
                    <span class="hero-kicker">Painel administrativo</span>
                    <h1 class="hero-title mb-2" style="font-size: clamp(2rem, 4vw, 3.3rem);">Indicadores de egressos e empregabilidade</h1>
                    <p class="hero-lead mb-0">
                        Visão consolidada para acompanhar atualização cadastral, vínculo com o mercado e sinais iniciais de empregabilidade.
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('egresso.landing') }}" class="btn btn-alumni-primary rounded-pill px-4">Voltar para a landing</a>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-4 col-xl-2">
                    <div class="stat-card bg-white rounded-5 p-4 h-100">
                        <div class="stat-label mb-2">Egressos cadastrados</div>
                        <div class="stat-value">{{ $totalEgressos }}</div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-2">
                    <div class="stat-card bg-white rounded-5 p-4 h-100">
                        <div class="stat-label mb-2">Empregados</div>
                        <div class="stat-value">{{ $egressosEmpregados }}</div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-2">
                    <div class="stat-card bg-white rounded-5 p-4 h-100">
                        <div class="stat-label mb-2">% empregados</div>
                        <div class="stat-value">{{ $percentualEmpregados }}%</div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-2">
                    <div class="stat-card bg-white rounded-5 p-4 h-100">
                        <div class="stat-label mb-2">Com CNPJ</div>
                        <div class="stat-value">{{ $comCnpj }}</div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-2">
                    <div class="stat-card bg-white rounded-5 p-4 h-100">
                        <div class="stat-label mb-2">Atualizados 90d</div>
                        <div class="stat-value">{{ $atualizados90d }}</div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-2">
                    <div class="stat-card bg-white rounded-5 p-4 h-100">
                        <div class="stat-label mb-2">Atualizações 30d</div>
                        <div class="stat-value">{{ $atualizacoes30d }}</div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-lg-7">
                    <div class="section-card bg-white rounded-5 p-4 p-md-5 h-100" id="empregabilidade-chart" data-empregabilidade='@json($empregabilidadeSerie)'>
                        <div class="d-flex flex-column flex-md-row justify-content-between gap-2 mb-4">
                            <div>
                                <h2 class="h4 mb-1">Empregabilidade consolidada</h2>
                                <p class="section-muted mb-0">Base usada para o futuro gráfico de porcentagem de egressos empregados.</p>
                            </div>
                            <span class="badge rounded-pill text-bg-light border px-3 py-2">{{ $percentualEmpregados }}% empregados</span>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between small mb-2">
                                <span class="section-muted">Meta de acompanhamento</span>
                                <span class="text-dark fw-semibold">{{ $percentualEmpregados }}%</span>
                            </div>
                            <div class="progress rounded-pill">
                                <div class="progress-bar" role="progressbar" style="width: {{ $percentualEmpregados }}%;" aria-valuenow="{{ $percentualEmpregados }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="metric-box p-3 h-100">
                                    <strong>{{ $interessadosVagas }}</strong>
                                    <span>Interessados em vagas</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="metric-box p-3 h-100">
                                    <strong>{{ $interessadosMentoria }}</strong>
                                    <span>Interessados em mentoria</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="metric-box p-3 h-100">
                                    <strong>{{ $atualizacoes30d }}</strong>
                                    <span>Atualizações recentes</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="section-card bg-white rounded-5 p-4 p-md-5 h-100">
                        <h3 class="h4 mb-4">Distribuição por status</h3>
                        <div class="d-grid gap-3">
                            @forelse ($statusDistribuicao as $item)
                                <div>
                                    <div class="d-flex justify-content-between small mb-1">
                                        <span class="text-dark fw-semibold">{{ $item->status_profissional ?: 'Não informado' }}</span>
                                        <span class="section-muted">{{ $item->total }}</span>
                                    </div>
                                    <div class="progress rounded-pill">
                                        <div class="progress-bar" style="width: {{ $totalEgressos > 0 ? round(($item->total / $totalEgressos) * 100, 1) : 0 }}%"></div>
                                    </div>
                                </div>
                            @empty
                                <p class="section-muted mb-0">Ainda não há dados suficientes para exibir o detalhamento por status.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-lg-7">
                    <div class="section-card bg-white rounded-5 p-4 p-md-5 h-100">
                        <h3 class="h4 mb-4">Egressos por curso</h3>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Curso</th>
                                        <th>Total</th>
                                        <th>Empregados</th>
                                        <th>%</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($egressosPorCurso as $curso)
                                        <tr>
                                            <td>{{ $curso->curso }}</td>
                                            <td>{{ $curso->total }}</td>
                                            <td>{{ $curso->empregados }}</td>
                                            <td>{{ $curso->total > 0 ? round(($curso->empregados / $curso->total) * 100, 1) : 0 }}%</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">Sem registros para consolidar por curso.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="section-card bg-white rounded-5 p-4 p-md-5 h-100">
                        <h3 class="h4 mb-4">Egressos por ano de conclusão</h3>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Ano</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($egressosPorAno as $ano)
                                        <tr>
                                            <td>{{ $ano->ano_conclusao }}</td>
                                            <td>{{ $ano->total }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center text-muted py-4">Nenhum dado cadastrado.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="section-card bg-white rounded-5 p-4 p-md-5 h-100">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="h4 mb-0">Últimas atualizações recebidas</h3>
                            <span class="badge rounded-pill text-bg-light border px-3 py-2">Auditoria de mudanças</span>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Egresso</th>
                                        <th>Origem</th>
                                        <th>Empresa</th>
                                        <th>Cargo</th>
                                        <th>Atualizado em</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($ultimasAtualizacoes as $update)
                                        <tr>
                                            <td>{{ $update->egresso?->nome ?? 'Registro sem vínculo' }}</td>
                                            <td>{{ $update->source }}</td>
                                            <td>{{ data_get($update->payload, 'empresa_atual', '---') }}</td>
                                            <td>{{ data_get($update->payload, 'cargo_atual', '---') }}</td>
                                            <td>{{ $update->created_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-4">Sem atualizações recentes.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
