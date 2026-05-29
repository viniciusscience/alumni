<?php

namespace Database\Seeders;

use App\Models\Egresso;
use App\Models\EgressoUpdate;
use Illuminate\Database\Seeder;

class EgressoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $samples = [
            [
                'public_token' => 'ALUMNI-ANA-2023',
                'nome' => 'Ana Paula Silva',
                'email' => 'ana.silva@alumni.test',
                'telefone' => '(11) 98888-1111',
                'curso' => 'Engenharia de Software',
                'ano_conclusao' => 2023,
                'cidade' => 'São Paulo',
                'uf' => 'SP',
                'linkedin' => 'https://www.linkedin.com/in/anapaulasilva',
                'empresa_atual' => 'Nexa Digital',
                'cnpj_empresa' => '12.345.678/0001-90',
                'cargo_atual' => 'Analista de Produto',
                'area_atuacao' => 'Tecnologia',
                'regime_trabalho' => 'CLT',
                'data_inicio_emprego' => '2024-02-01',
                'status_profissional' => 'Empregado',
                'interesse_vagas' => 'Sim',
                'interesse_mentoria' => 'Sim',
                'consentimento_contato' => true,
            ],
            [
                'public_token' => 'ALUMNI-BRUNO-2022',
                'nome' => 'Bruno Costa',
                'email' => 'bruno.costa@alumni.test',
                'telefone' => '(21) 97777-2222',
                'curso' => 'Administração',
                'ano_conclusao' => 2022,
                'cidade' => 'Rio de Janeiro',
                'uf' => 'RJ',
                'linkedin' => 'https://www.linkedin.com/in/brunocosta',
                'empresa_atual' => 'Costa Consultoria',
                'cnpj_empresa' => '23.456.789/0001-01',
                'cargo_atual' => 'Consultor PJ',
                'area_atuacao' => 'Negócios',
                'regime_trabalho' => 'PJ',
                'data_inicio_emprego' => '2024-01-10',
                'status_profissional' => 'Autônomo',
                'interesse_vagas' => 'Talvez',
                'interesse_mentoria' => 'Não',
                'consentimento_contato' => true,
            ],
            [
                'public_token' => 'ALUMNI-CARLA-2021',
                'nome' => 'Carla Mendes',
                'email' => 'carla.mendes@alumni.test',
                'telefone' => '(31) 96666-3333',
                'curso' => 'Psicologia',
                'ano_conclusao' => 2021,
                'cidade' => 'Belo Horizonte',
                'uf' => 'MG',
                'linkedin' => 'https://www.linkedin.com/in/carlamendes',
                'empresa_atual' => 'Hospital Vida',
                'cnpj_empresa' => '34.567.890/0001-12',
                'cargo_atual' => 'Psicóloga',
                'area_atuacao' => 'Saúde',
                'regime_trabalho' => 'CLT',
                'data_inicio_emprego' => '2023-06-20',
                'status_profissional' => 'Empregado',
                'interesse_vagas' => 'Sim',
                'interesse_mentoria' => 'Sim',
                'consentimento_contato' => true,
            ],
            [
                'public_token' => 'ALUMNI-DIEGO-2024',
                'nome' => 'Diego Lima',
                'email' => 'diego.lima@alumni.test',
                'telefone' => '(41) 95555-4444',
                'curso' => 'Análise e Desenvolvimento de Sistemas',
                'ano_conclusao' => 2024,
                'cidade' => 'Curitiba',
                'uf' => 'PR',
                'linkedin' => 'https://www.linkedin.com/in/diegolima',
                'empresa_atual' => null,
                'cnpj_empresa' => null,
                'cargo_atual' => null,
                'area_atuacao' => 'Tecnologia',
                'regime_trabalho' => null,
                'data_inicio_emprego' => null,
                'status_profissional' => 'Estudando',
                'interesse_vagas' => 'Sim',
                'interesse_mentoria' => 'Sim',
                'consentimento_contato' => false,
            ],
            [
                'public_token' => 'ALUMNI-EDUARDA-2020',
                'nome' => 'Eduarda Ribeiro',
                'email' => 'eduarda.ribeiro@alumni.test',
                'telefone' => '(85) 94444-5555',
                'curso' => 'Pedagogia',
                'ano_conclusao' => 2020,
                'cidade' => 'Fortaleza',
                'uf' => 'CE',
                'linkedin' => 'https://www.linkedin.com/in/eduardaribeiro',
                'empresa_atual' => 'Secretaria Municipal de Educação',
                'cnpj_empresa' => '45.678.901/0001-23',
                'cargo_atual' => 'Servidora pública',
                'area_atuacao' => 'Educação',
                'regime_trabalho' => 'Servidor público',
                'data_inicio_emprego' => '2022-03-12',
                'status_profissional' => 'Servidor público',
                'interesse_vagas' => 'Não',
                'interesse_mentoria' => 'Sim',
                'consentimento_contato' => true,
            ],
        ];

        foreach ($samples as $sample) {
            $egresso = Egresso::query()->updateOrCreate(
                ['email' => $sample['email']],
                $sample
            );

            EgressoUpdate::query()->create([
                'egresso_id' => $egresso->id,
                'source' => 'seeder',
                'payload' => $sample,
            ]);
        }
    }
}
