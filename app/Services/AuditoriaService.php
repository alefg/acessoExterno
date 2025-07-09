<?php

namespace App\Services;

use App\Models\Auditoria; // Presume-se que este modelo será criado
use App\Models\Solicitacao;
use App\Models\User;
use Carbon\Carbon;

/**
 * Class AuditoriaService
 * @package App\Services
 *
 * Responsável por registrar logs de auditoria para ações importantes no sistema.
 */
class AuditoriaService
{
    /**
     * Registra a criação de uma nova solicitação.
     */
    public function registrarCriacao(Solicitacao $solicitacao): void
    {
        $this->registrarAcao($solicitacao, 'Criação da Solicitação', null, ['status_inicial' => 'Pendente']);
    }

    /**
     * Registra a mudança de status de uma solicitação.
     */
    public function registrarMudancaStatus(Solicitacao $solicitacao, string $statusAntigo, string $statusNovo, User $responsavel): void
    {
        $this->registrarAcao(
            $solicitacao,
            "Status alterado de '{$statusAntigo}' para '{$statusNovo}'",
            $responsavel
        );
    }

    /**
     * Registra a conclusão da solicitação e calcula o tempo de resposta.
     */
    public function registrarConclusao(Solicitacao $solicitacao): void
    {
        $tempoRespostaHoras = $solicitacao->created_at->diffInHours(Carbon::now());

        $this->registrarAcao(
            $solicitacao,
            'Solicitação Concluída',
            $solicitacao->analista, // Assumindo que o analista é salvo na solicitação
            ['tempo_resposta_horas' => $tempoRespostaHoras]
        );
    }

    /**
     * Método genérico para criar um registro de auditoria.
     *
     * @param array|null $detalhes Dados adicionais em formato JSON.
     */
    protected function registrarAcao(Solicitacao $solicitacao, string $acao, ?User $usuario, ?array $detalhes = []): void
    {
        Auditoria::create([
            'solicitacao_id' => $solicitacao->id,
            'user_id' => $usuario?->id,
            'acao' => $acao,
            'detalhes' => $detalhes,
        ]);
    }
}