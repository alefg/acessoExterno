<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Orgao;

class OrgaoSeeder extends Seeder
{
    /**
     * Popula a tabela de órgãos.
     *
     * @return void
     */
    public function run(): void
    {
        Orgao::create(['nome' => 'Secretaria de Estado de Planejamento e Gestão (SEPLAG)']);
        Orgao::create(['nome' => 'Secretaria de Estado de Fazenda (SEF)']);
        Orgao::create(['nome' => 'Secretaria de Estado de Educação (SEE)']);
        Orgao::create(['nome' => 'Polícia Civil de Minas Gerais (PCMG)']);
        Orgao::create(['nome' => 'Polícia Militar de Minas Gerais (PMMG)']);
    }
}