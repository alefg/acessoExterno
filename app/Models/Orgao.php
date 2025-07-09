<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Orgao extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
    ];

    public function areas(): HasMany
    {
        return $this->hasMany(Area::class);
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