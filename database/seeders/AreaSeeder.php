<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Orgao;
use App\Models\Area;

class AreaSeeder extends Seeder
{
    /**
     * Popula a tabela de áreas, associando-as aos órgãos.
     *
     * @return void
     */
    public function run(): void
    {
        // Encontra os órgãos pelo nome
        $seplag = Orgao::where('nome', 'like', '%SEPLAG%')->first();
        $sef = Orgao::where('nome', 'like', '%SEF%')->first();
        $see = Orgao::where('nome', 'like', '%SEE%')->first();

        if ($seplag) {
            Area::create(['nome' => 'Recursos Humanos', 'orgao_id' => $seplag->id]);
            Area::create(['nome' => 'Tecnologia da Informação', 'orgao_id' => $seplag->id]);
        }

        if ($sef) {
            Area::create(['nome' => 'Arrecadação', 'orgao_id' => $sef->id]);
            Area::create(['nome' => 'Fiscalização', 'orgao_id' => $sef->id]);
        }

        if ($see) {
            Area::create(['nome' => 'Superintendência de Ensino', 'orgao_id' => $see->id]);
        }
    }
}