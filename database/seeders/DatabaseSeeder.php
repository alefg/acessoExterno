<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Executa os seeders da aplicação.
     */
    public function run(): void
    {
        $this->call([
            OrgaoSeeder::class,
            AreaSeeder::class,
            UserSeeder::class,
        ]);
    }
}
