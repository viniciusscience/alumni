<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EgressoUpdate extends Model
{
    use HasFactory;

    protected $table = 'egresso_updates';

    protected $fillable = [
        'egresso_id',
        'source',
        'payload',
    ];

    protected $casts = [
        'payload' => 'array',
    ];

    public function egresso()
    {
        return $this->belongsTo(Egresso::class);
    }
}
