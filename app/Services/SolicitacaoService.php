<?php

namespace App\Services;

use App\Models\Solicitacao;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Throwable;

/**
 * Class SolicitacaoService
 * @package App\Services
 *
 * Gerencia a lógica de negócio para as solicitações de cadastro.
 */
class SolicitacaoService
{
    public function __construct(
        protected ArquivoService $arquivoService,
        protected NotificacaoService $notificacaoService,
        protected AuditoriaService $auditoriaService
    ) {}

    /**
     * Cria uma nova solicitação de cadastro a partir dos dados do formulário público.
     *
     * @param array $dados Os dados do formulário (nome, email, etc.).
     * @param array $arquivos Os arquivos enviados (termo, documento, etc.).
     * @return Solicitacao A solicitação criada.
     * @throws Throwable
     */
    public function criar(array $dados, array $arquivos): Solicitacao
    {
        return DB::transaction(function () use ($dados, $arquivos) {
            // 1. Cria a solicitação com status inicial 'Pendente'
            $solicitacao = Solicitacao::create($dados + ['status' => 'Pendente']);

            // 2. Delega o salvamento dos arquivos para o ArquivoService
            $this->arquivoService->salvarArquivos($solicitacao, $arquivos);

            // 3. Registra o evento de criação na auditoria
            $this->auditoriaService->registrarCriacao($solicitacao);

            // 4. Dispara a notificação para o responsável da área
            $this->notificacaoService->notificarNovaSolicitacao($solicitacao);

            return $solicitacao;
        });
    }

    /**
     * Processa a análise de uma solicitação, atualizando seu status e registrando na auditoria.
     *
     * @param Solicitacao $solicitacao A solicitação a ser analisada.
     * @param string $novoStatus O novo status (ex: 'Em análise', 'Aprovado', 'Concluído').
     * @param User $responsavel O usuário que está realizando a ação.
     * @param array $dadosAnalise Dados adicionais da análise (ex: observações).
     * @return Solicitacao A solicitação atualizada.
     */
    public function analisar(Solicitacao $solicitacao, string $novoStatus, User $responsavel, array $dadosAnalise = []): Solicitacao
    {
        $statusAntigo = $solicitacao->status;

        $solicitacao->status = $novoStatus;
        $solicitacao->observacoes = $dadosAnalise['observacoes'] ?? $solicitacao->observacoes;
        $solicitacao->save();

        // Registra a mudança de status na auditoria
        $this->auditoriaService->registrarMudancaStatus($solicitacao, $statusAntigo, $novoStatus, $responsavel);

        if ($novoStatus === 'Concluído') {
            $this->auditoriaService->registrarConclusao($solicitacao);
        }

        return $solicitacao;
    }
}