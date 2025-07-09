<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'orgao_id',
        'nome',
    ];

    public function orgao(): BelongsTo
    {
        return $this->belongsTo(Orgao::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function solicitacoes(): HasMany
    {
        return $this->hasMany(Solicitacao::class);
    }
}