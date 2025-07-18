<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Orgao;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Area>
 */
class AreaFactory extends Factory
{
    /**
     * O model correspondente.
     *
     * @var string
     */
    protected $model = Area::class;

    /**
     * Define o estado padrão do modelo.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->jobTitle(),
            'orgao_id' => Orgao::factory(),
        ];
    }
}