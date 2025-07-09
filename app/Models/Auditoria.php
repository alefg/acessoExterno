<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Auditoria extends Model
{
    use HasFactory;

    protected $table = 'auditoria';

    protected $fillable = [
        'solicitacao_id',
        'user_id',
        'acao',
        'status_anterior',
        'status_novo',
        'detalhes',
    ];

    public function solicitacao(): BelongsTo
    {
        return $this->belongsTo(Solicitacao::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}