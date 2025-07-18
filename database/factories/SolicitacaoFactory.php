<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Solicitacao;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Solicitacao>
 */
class SolicitacaoFactory extends Factory
{
    /**
     * O model correspondente.
     *
     * @var string
     */
    protected $model = Solicitacao::class;

    /**
     * Define o estado padrão do modelo.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tipoRepresentacaoOptions = ['Pessoa Física', 'Pessoa Jurídica'];
        $personalEmail = $this->faker->unique()->safeEmail();

        return [
            'area_id' => Area::inRandomOrder()->first()?->id ?? Area::factory(),
            'nome_completo' => $this->faker->name(),
            'email' => $personalEmail,
            'email_sei' => $this->faker->boolean(80) ? $personalEmail : $this->faker->unique()->safeEmail(),
            'tipo_representacao' => $this->faker->randomElement($tipoRepresentacaoOptions),
            'status' => 'Pendente',
            'termos_aceitos' => true,
            'observacoes' => null,
        ];
    }
}