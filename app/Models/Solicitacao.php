<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Solicitacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'protocolo',
        'nome_completo',
        'tipo_representacao',
        'email_pessoal',
        'email_sei',
        'orgao_id',
        'area_id',
        'status',
        'termos_aceitos',
        'observacoes',
        'responsavel_id',
        'data_conclusao',
    ];

    protected function casts(): array
    {
        return [
            'termos_aceitos' => 'boolean',
            'data_conclusao' => 'datetime',
        ];
    }

    public function orgao(): BelongsTo
    {
        return $this->belongsTo(Orgao::class);
    }

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function responsavel(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsavel_id');
    }

    public function arquivos(): HasMany
    {
        return $this->hasMany(Arquivo::class);
    }

    public function auditorias(): HasMany
    {
        return $this->hasMany(Auditoria::class);
    }
}