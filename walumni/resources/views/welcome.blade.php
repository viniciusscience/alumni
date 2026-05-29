@extends('layouts.app')

@section('title', 'Alumni | Atualização de Egressos')

@push('styles')
    <style>
        .hero-shell {
            position: relative;
            overflow: hidden;
            padding: 4.5rem 0 2rem;
        }

        .hero-shell::before,
        .hero-shell::after {
            content: '';
            position: absolute;
            inset: auto;
            border-radius: 999px;
            opacity: 0.7;
            pointer-events: none;
        }

        .hero-shell::before {
            width: 20rem;
            height: 20rem;
            top: -6rem;
            left: -7rem;
            background: rgba(46, 78, 148, 0.11);
        }

        .hero-shell::after {
            width: 16rem;
            height: 16rem;
            right: -5rem;
            bottom: 2rem;
            background: rgba(10, 143, 79, 0.11);
        }

        .hero-card,
        .form-card,
        .info-card {
            position: relative;
            z-index: 1;
            border: 1px solid rgba(224, 226, 230, 0.92);
            box-shadow: 0 18px 45px rgba(22, 33, 60, 0.08);
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
            font-size: clamp(2.25rem, 5vw, 4.2rem);
            line-height: 1.02;
            font-weight: 800;
            margin-bottom: 1rem;
        }

        .hero-lead {
            color: #4f5764;
            font-size: 1.05rem;
            max-width: 42rem;
        }

        .chip-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.65rem;
            margin: 1.5rem 0 0;
            padding: 0;
            list-style: none;
        }

        .chip-list li {
            background: rgba(255, 255, 255, 0.82);
            color: var(--alumni-blue);
            border: 1px solid rgba(46, 78, 148, 0.14);
            border-radius: 999px;
            padding: 0.55rem 0.9rem;
            font-size: 0.92rem;
            font-weight: 600;
        }

        .section-title {
            color: var(--alumni-blue);
            font-weight: 800;
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

        .step-pill {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(10, 143, 79, 0.12);
            color: var(--alumni-green);
            font-weight: 700;
            flex: 0 0 auto;
        }

        .info-card h3,
        .form-card h2 {
            color: var(--alumni-blue);
        }

        .form-label {
            color: var(--alumni-blue);
            font-weight: 600;
        }

        .form-control,
        .form-select {
            border-color: #d7dbe1;
            padding-top: 0.85rem;
            padding-bottom: 0.85rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: rgba(10, 143, 79, 0.55);
            box-shadow: 0 0 0 0.2rem rgba(10, 143, 79, 0.12);
        }

        .support-note {
            border-left: 4px solid var(--alumni-green);
            background: rgba(10, 143, 79, 0.06);
        }
    </style>
@endpush

@section('content')
    <section class="hero-shell">
        <div class="container">
            @if (session('status'))
                <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
                    <strong>Confira os campos abaixo:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <div class="hero-card bg-white rounded-5 p-4 p-md-5">
                        <div class="hero-kicker mb-3">Acompanhamento de egressos</div>
                        <h1 class="hero-title">Atualize seus dados e fortaleça sua trajetória após a graduação.</h1>
                        <p class="hero-lead mb-4">
                            Este portal centraliza as informações do egresso para manter o vínculo com a faculdade,
                            apoiar oportunidades de emprego e gerar indicadores confiáveis para relatórios institucionais e MEC/Inep.
                        </p>

                        <div class="d-flex flex-wrap gap-3 mb-4">
                            <a href="#atualizacao" class="btn btn-alumni-primary btn-lg rounded-pill px-4">Atualizar cadastro</a>
                            <a href="#dados" class="btn btn-outline-secondary btn-lg rounded-pill px-4">Ver meus dados</a>
                        </div>

                        <ul class="chip-list">
                            <li>Dados pessoais atualizados</li>
                            <li>CNPJ e cargo da empresa atual</li>
                            <li>Base para vagas e sugestões futuras</li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="info-card bg-white rounded-5 p-4 p-md-5 h-100">
                        <h3 class="h4 mb-3">Por que manter seu cadastro atualizado?</h3>
                        <div class="metric-box p-3 mb-3">
                            <strong>Empregabilidade</strong>
                            <span>Estruturamos a base para estimar a porcentagem de egressos empregados.</span>
                        </div>
                        <div class="metric-box p-3 mb-3">
                            <strong>Relacionamento</strong>
                            <span>Facilita convites, mentorias, eventos e comunicação com a faculdade.</span>
                        </div>
                        <div class="metric-box p-3">
                            <strong>Inteligência de dados</strong>
                            <span>Permite cruzar curso, empresa, cargo e cidade para apoiar decisões acadêmicas.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-5">
        <div class="container">
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="info-card bg-white rounded-5 p-4 h-100">
                        <div class="step-pill mb-3">1</div>
                        <h3 class="h5">Dados pessoais</h3>
                        <p class="section-muted mb-0">Nome, e-mail, telefone, curso, ano de conclusão e cidade para manter o vínculo atualizado.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-card bg-white rounded-5 p-4 h-100">
                        <div class="step-pill mb-3">2</div>
                        <h3 class="h5">Emprego atual</h3>
                        <p class="section-muted mb-0">Empresa, CNPJ, cargo, área, regime e data de início para medir empregabilidade com mais precisão.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-card bg-white rounded-5 p-4 h-100">
                        <div class="step-pill mb-3">3</div>
                        <h3 class="h5">Atualização futura</h3>
                        <p class="section-muted mb-0">Autorizações e preferências para oportunidades, mentorias e novas comunicações da instituição.</p>
                    </div>
                </div>
            </div>

            <div class="row g-4 align-items-start">
                <div class="col-lg-5" id="dados">
                    <div class="info-card bg-white rounded-5 p-4 p-md-5 mb-4">
                        <h2 class="section-title h3 mb-3">Seus dados no sistema</h2>
                        <p class="section-muted mb-4">
                            Esta área assume que você já está autenticado no ambiente institucional. Os dados são tratados para acompanhamento de egressos, contato institucional e indicadores, com respeito à LGPD.
                        </p>
                        <div class="support-note rounded-4 p-3">
                            <strong class="d-block text-success mb-1">Importante</strong>
                            <span class="section-muted">As informações salvas alimentam os indicadores do painel e ações institucionais compatíveis com a LGPD.</span>
                        </div>
                    </div>

                    <div class="info-card bg-white rounded-5 p-4 p-md-5">
                        <h3 class="h4 mb-3">O que vamos acompanhar</h3>
                        <div class="d-flex gap-3 mb-3">
                            <div class="step-pill">✓</div>
                            <div>
                                <strong class="d-block text-dark">Status profissional</strong>
                                <span class="section-muted">Empregado, autônomo, pós-graduação, recolocação ou transição.</span>
                            </div>
                        </div>
                        <div class="d-flex gap-3 mb-3">
                            <div class="step-pill">✓</div>
                            <div>
                                <strong class="d-block text-dark">Mercado e localização</strong>
                                <span class="section-muted">Cidade, UF e área de atuação para análises por região.</span>
                            </div>
                        </div>
                        <div class="d-flex gap-3">
                            <div class="step-pill">✓</div>
                            <div>
                                <strong class="d-block text-dark">Consentimento e comunicação</strong>
                                <span class="section-muted">Autorização para contato e comunicação institucional com base em consentimento.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7" id="atualizacao">
                    <div class="form-card bg-white rounded-5 p-4 p-md-5">
                        <div class="d-flex flex-column flex-md-row justify-content-between gap-2 align-items-md-end mb-4">
                            <div>
                                <h2 class="h3 mb-2">Atualização de cadastro do egresso</h2>
                                <p class="section-muted mb-0">Preencha os campos abaixo para manter seu histórico atualizado e apoiar o painel de empregabilidade.</p>
                            </div>
                            <span class="badge rounded-pill text-bg-light border px-3 py-2">Fluxo autenticado do Alumni</span>
                        </div>

                        <form method="POST" action="{{ route('egresso.update') }}" class="row g-3">
                            @csrf

                            @if (auth()->check())
                                <div class="col-12">
                                    <div class="alert alert-light border rounded-4 mb-0">
                                        Você está autenticado como <strong>{{ auth()->user()->name }}</strong> e seus dados serão vinculados à sua conta.
                                    </div>
                                </div>
                            @endif

                            <div class="col-md-6">
                                <label for="nome" class="form-label">Nome completo</label>
                                <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', auth()->user()->name ?? '') }}" placeholder="Seu nome completo" required {{ auth()->check() ? 'readonly' : '' }}>
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', auth()->user()->email ?? '') }}" placeholder="voce@exemplo.com" required {{ auth()->check() ? 'readonly' : '' }}>
                            </div>

                            <div class="col-md-4">
                                <label for="telefone" class="form-label">Telefone / WhatsApp</label>
                                <input type="text" name="telefone" id="telefone" class="form-control" value="{{ old('telefone') }}" placeholder="(00) 00000-0000" required>
                            </div>

                            <div class="col-md-5">
                                <label for="curso" class="form-label">Curso</label>
                                <input type="text" name="curso" id="curso" class="form-control" value="{{ old('curso') }}" placeholder="Ex.: Engenharia de Software" required>
                            </div>

                            <div class="col-md-3">
                                <label for="ano_conclusao" class="form-label">Ano de conclusão</label>
                                <input type="number" name="ano_conclusao" id="ano_conclusao" class="form-control" value="{{ old('ano_conclusao') }}" min="1900" max="2100" placeholder="2025" required>
                            </div>

                            <div class="col-12 mt-4">
                                <h3 class="h5 section-title mb-0">Emprego atual</h3>
                            </div>

                            <div class="col-md-6">
                                <label for="empresa_atual" class="form-label">Empresa atual</label>
                                <input type="text" name="empresa_atual" id="empresa_atual" class="form-control" value="{{ old('empresa_atual') }}" placeholder="Nome da empresa ou instituição">
                            </div>

                            <div class="col-md-3">
                                <label for="cnpj_empresa" class="form-label">CNPJ</label>
                                <input type="text" name="cnpj_empresa" id="cnpj_empresa" class="form-control" value="{{ old('cnpj_empresa') }}" placeholder="00.000.000/0001-00">
                            </div>

                            <div class="col-md-3">
                                <label for="cargo_atual" class="form-label">Cargo</label>
                                <input type="text" name="cargo_atual" id="cargo_atual" class="form-control" value="{{ old('cargo_atual') }}" placeholder="Ex.: Analista">
                            </div>

                            <div class="col-md-4">
                                <label for="area_atuacao" class="form-label">Área de atuação</label>
                                <input type="text" name="area_atuacao" id="area_atuacao" class="form-control" value="{{ old('area_atuacao') }}" placeholder="Tecnologia, saúde, educação...">
                            </div>

                            <div class="col-md-4">
                                <label for="regime_trabalho" class="form-label">Regime</label>
                                <select name="regime_trabalho" id="regime_trabalho" class="form-select">
                                    <option value="" @selected(old('regime_trabalho') === null || old('regime_trabalho') === '')>Selecione</option>
                                    <option value="CLT" @selected(old('regime_trabalho') === 'CLT')>CLT</option>
                                    <option value="PJ" @selected(old('regime_trabalho') === 'PJ')>PJ</option>
                                    <option value="Autônomo" @selected(old('regime_trabalho') === 'Autônomo')>Autônomo</option>
                                    <option value="Estágio" @selected(old('regime_trabalho') === 'Estágio')>Estágio</option>
                                    <option value="Servidor público" @selected(old('regime_trabalho') === 'Servidor público')>Servidor público</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="data_inicio_emprego" class="form-label">Data de início</label>
                                <input type="date" name="data_inicio_emprego" id="data_inicio_emprego" class="form-control" value="{{ old('data_inicio_emprego') }}">
                            </div>

                            <div class="col-md-6">
                                <label for="cidade" class="form-label">Cidade</label>
                                <input type="text" name="cidade" id="cidade" class="form-control" value="{{ old('cidade') }}" placeholder="Cidade onde reside ou trabalha">
                            </div>

                            <div class="col-md-2">
                                <label for="uf" class="form-label">UF</label>
                                <input type="text" name="uf" id="uf" maxlength="2" class="form-control text-uppercase" value="{{ old('uf') }}" placeholder="SP">
                            </div>

                            <div class="col-md-4">
                                <label for="linkedin" class="form-label">LinkedIn</label>
                                <input type="url" name="linkedin" id="linkedin" class="form-control" value="{{ old('linkedin') }}" placeholder="https://linkedin.com/in/...">
                            </div>

                            <div class="col-12 mt-4">
                                <h3 class="h5 section-title mb-0">Atualização futura e consentimentos</h3>
                            </div>

                            <div class="col-md-4">
                                <label for="status_profissional" class="form-label">Status profissional</label>
                                <select name="status_profissional" id="status_profissional" class="form-select">
                                    <option value="" @selected(old('status_profissional') === null || old('status_profissional') === '')>Selecione</option>
                                    <option value="Empregado" @selected(old('status_profissional') === 'Empregado')>Empregado</option>
                                    <option value="Autônomo" @selected(old('status_profissional') === 'Autônomo')>Autônomo</option>
                                    <option value="Desempregado" @selected(old('status_profissional') === 'Desempregado')>Desempregado</option>
                                    <option value="Estudando" @selected(old('status_profissional') === 'Estudando')>Estudando</option>
                                    <option value="Não informado" @selected(old('status_profissional') === 'Não informado')>Não informado</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="interesse_vagas" class="form-label">Interesse em vagas</label>
                                <select name="interesse_vagas" id="interesse_vagas" class="form-select">
                                    <option value="" @selected(old('interesse_vagas') === null || old('interesse_vagas') === '')>Selecione</option>
                                    <option value="Sim" @selected(old('interesse_vagas') === 'Sim')>Sim</option>
                                    <option value="Talvez" @selected(old('interesse_vagas') === 'Talvez')>Talvez</option>
                                    <option value="Não" @selected(old('interesse_vagas') === 'Não')>Não</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="interesse_mentoria" class="form-label">Interesse em mentoria</label>
                                <select name="interesse_mentoria" id="interesse_mentoria" class="form-select">
                                    <option value="" @selected(old('interesse_mentoria') === null || old('interesse_mentoria') === '')>Selecione</option>
                                    <option value="Sim" @selected(old('interesse_mentoria') === 'Sim')>Sim</option>
                                    <option value="Não" @selected(old('interesse_mentoria') === 'Não')>Não</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" value="1" id="consentimento_contato" name="consentimento_contato" @checked(old('consentimento_contato')) required>
                                    <label class="form-check-label" for="consentimento_contato">
                                        Li e estou ciente de que meus dados serão tratados para acompanhamento de egressos, indicadores institucionais e contato profissional, conforme a LGPD, e autorizo esse tratamento para as finalidades informadas.
                                    </label>
                                    <div class="form-text">O consentimento é obrigatório para concluir a atualização.</div>
                                </div>
                            </div>

                            <div class="col-12 d-flex flex-column flex-md-row gap-3 align-items-md-center mt-3">
                                <button type="submit" class="btn btn-alumni-primary btn-lg rounded-pill px-4">Salvar atualização</button>
                                <span class="section-muted">Uso exclusivo para fins institucionais e relacionamento com egressos.</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
