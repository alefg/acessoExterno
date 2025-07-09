<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Arquivo extends Model
{
    use HasFactory;

    protected $fillable = [
        'solicitacao_id',
        'tipo_documento',
        'caminho_arquivo',
        'nome_original',
        'mime_type',
        'tamanho',
    ];

    public function solicitacao(): BelongsTo
    {
        return $this->belongsTo(Solicitacao::class);
    }
}