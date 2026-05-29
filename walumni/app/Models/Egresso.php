<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Egresso extends Model
{
    use HasFactory;

    protected $table = 'egressos';

    protected $fillable = [
        'user_id',
        'public_token',
        'nome',
        'email',
        'telefone',
        'curso',
        'ano_conclusao',
        'cidade',
        'uf',
        'linkedin',
        'empresa_atual',
        'cnpj_empresa',
        'cargo_atual',
        'area_atuacao',
        'regime_trabalho',
        'data_inicio_emprego',
        'status_profissional',
        'interesse_vagas',
        'interesse_mentoria',
        'consentimento_contato',
    ];

    protected $casts = [
        'ano_conclusao' => 'integer',
        'data_inicio_emprego' => 'date',
        'consentimento_contato' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function updates()
    {
        return $this->hasMany(EgressoUpdate::class);
    }
}
