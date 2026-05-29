<?php

namespace App\Http\Controllers;

use App\Models\Egresso;
use App\Models\EgressoUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EgressoController extends Controller
{
    public function landing()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'telefone' => ['required', 'string', 'max:30'],
            'curso' => ['required', 'string', 'max:255'],
            'ano_conclusao' => ['required', 'integer', 'min:1900', 'max:2100'],
            'empresa_atual' => ['nullable', 'string', 'max:255'],
            'cnpj_empresa' => ['nullable', 'string', 'max:20'],
            'cargo_atual' => ['nullable', 'string', 'max:255'],
            'area_atuacao' => ['nullable', 'string', 'max:255'],
            'regime_trabalho' => ['nullable', 'string', 'max:100'],
            'data_inicio_emprego' => ['nullable', 'date'],
            'cidade' => ['nullable', 'string', 'max:255'],
            'uf' => ['nullable', 'string', 'size:2'],
            'linkedin' => ['nullable', 'url', 'max:255'],
            'status_profissional' => ['nullable', 'string', 'max:100'],
            'interesse_vagas' => ['nullable', 'string', 'max:50'],
            'interesse_mentoria' => ['nullable', 'string', 'max:50'],
            'consentimento_contato' => ['accepted'],
        ]);

        $egresso = Egresso::query()->firstOrNew([
            'user_id' => $user->id,
        ]);

        if (empty($egresso->public_token)) {
            $egresso->public_token = Str::upper(Str::random(12));
        }

        $egresso->fill([
            'user_id' => $user?->id,
            'nome' => $validated['nome'],
            'email' => $validated['email'],
            'telefone' => $validated['telefone'],
            'curso' => $validated['curso'],
            'ano_conclusao' => $validated['ano_conclusao'],
            'empresa_atual' => $validated['empresa_atual'] ?? null,
            'cnpj_empresa' => $validated['cnpj_empresa'] ?? null,
            'cargo_atual' => $validated['cargo_atual'] ?? null,
            'area_atuacao' => $validated['area_atuacao'] ?? null,
            'regime_trabalho' => $validated['regime_trabalho'] ?? null,
            'data_inicio_emprego' => $validated['data_inicio_emprego'] ?? null,
            'cidade' => $validated['cidade'] ?? null,
            'uf' => strtoupper((string) ($validated['uf'] ?? '')) ?: null,
            'linkedin' => $validated['linkedin'] ?? null,
            'status_profissional' => $validated['status_profissional'] ?? null,
            'interesse_vagas' => $validated['interesse_vagas'] ?? null,
            'interesse_mentoria' => $validated['interesse_mentoria'] ?? null,
            'consentimento_contato' => $request->boolean('consentimento_contato'),
        ]);

        $egresso->save();

        EgressoUpdate::query()->create([
            'egresso_id' => $egresso->id,
            'source' => 'authenticated',
            'payload' => $validated,
        ]);

        return redirect()
            ->route('egresso.landing')
            ->with('status', 'Recebemos sua atualização com sucesso. Seus dados já foram salvos para uso no sistema Alumni.')
            ->withInput($request->except('_token'));
    }

    public function dashboard()
    {
        $totalEgressos = Egresso::query()->count();
        $egressosEmpregados = Egresso::query()
            ->where(function ($query) {
                $query->whereNotNull('empresa_atual')
                    ->where('empresa_atual', '!=', '')
                    ->orWhereIn('status_profissional', ['Empregado', 'Autônomo', 'Servidor público', 'Estágio']);
            })
            ->count();
        $comCnpj = Egresso::query()
            ->whereNotNull('cnpj_empresa')
            ->where('cnpj_empresa', '!=', '')
            ->count();
        $atualizados90d = Egresso::query()
            ->where('updated_at', '>=', now()->subDays(90))
            ->count();
        $interessadosVagas = Egresso::query()
            ->whereIn('interesse_vagas', ['Sim', 'Talvez'])
            ->count();
        $interessadosMentoria = Egresso::query()
            ->where('interesse_mentoria', 'Sim')
            ->count();
        $atualizacoes30d = EgressoUpdate::query()
            ->where('created_at', '>=', now()->subDays(30))
            ->count();

        $percentualEmpregados = $totalEgressos > 0
            ? round(($egressosEmpregados / $totalEgressos) * 100, 1)
            : 0;
        $percentualNaoEmpregados = $totalEgressos > 0
            ? round(100 - $percentualEmpregados, 1)
            : 0;
        $empregabilidadeSerie = [
            'labels' => ['Empregados', 'Nao empregados'],
            'values' => [
                $egressosEmpregados,
                max($totalEgressos - $egressosEmpregados, 0),
            ],
            'percentuais' => [
                $percentualEmpregados,
                $percentualNaoEmpregados,
            ],
            'total' => $totalEgressos,
        ];

        $egressosPorCurso = Egresso::query()
            ->select('curso', DB::raw('COUNT(*) as total'), DB::raw("SUM(CASE WHEN status_profissional IN ('Empregado', 'Autônomo', 'Servidor público', 'Estágio') OR (empresa_atual IS NOT NULL AND empresa_atual != '') THEN 1 ELSE 0 END) as empregados"))
            ->groupBy('curso')
            ->orderByDesc('total')
            ->limit(6)
            ->get();

        $egressosPorAno = Egresso::query()
            ->select('ano_conclusao', DB::raw('COUNT(*) as total'))
            ->groupBy('ano_conclusao')
            ->orderByDesc('ano_conclusao')
            ->limit(6)
            ->get();

        $statusDistribuicao = Egresso::query()
            ->select('status_profissional', DB::raw('COUNT(*) as total'))
            ->groupBy('status_profissional')
            ->orderByDesc('total')
            ->get();

        $ultimasAtualizacoes = EgressoUpdate::query()
            ->with('egresso')
            ->latest()
            ->limit(5)
            ->get();

        return view('painel', compact(
            'totalEgressos',
            'egressosEmpregados',
            'percentualEmpregados',
            'percentualNaoEmpregados',
            'empregabilidadeSerie',
            'comCnpj',
            'atualizados90d',
            'interessadosVagas',
            'interessadosMentoria',
            'atualizacoes30d',
            'egressosPorCurso',
            'egressosPorAno',
            'statusDistribuicao',
            'ultimasAtualizacoes'
        ));
    }
}
