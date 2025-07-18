<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Area;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Popula a tabela de usuários com perfis de superadmin e responsáveis de área.
     *
     * @return void
     */
    public function run(): void
    {
        // Usuário Superadmin
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@acesso.mg.gov.br',
            'password' => Hash::make('password'), // Lembre-se de trocar em produção
            'role' => 'superadmin',
            'area_id' => null, // Superadmin não pertence a uma área específica
        ]);

        // Encontra algumas áreas para associar os responsáveis
        $areaRhSeplag = Area::where('nome', 'Recursos Humanos')->first();
        $areaTiSeplag = Area::where('nome', 'Tecnologia da Informação')->first();
        $areaArrecadacaoSef = Area::where('nome', 'Arrecadação')->first();

        // Usuários Responsáveis de Área
        if ($areaRhSeplag) {
            User::factory()->create([
                'name' => 'Responsável RH SEPLAG',
                'email' => 'rh.seplag@acesso.mg.gov.br',
                'password' => Hash::make('password'),
                'role' => 'responsavel',
                'area_id' => $areaRhSeplag->id,
            ]);
        }

        // Adicionar mais responsáveis conforme necessário...
    }
}