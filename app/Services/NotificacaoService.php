<?php

namespace App\Services;

use App\Mail\NovaSolicitacaoMail; // Presume-se que esta classe Mailable será criada
use App\Models\Solicitacao;
use Illuminate\Support\Facades\Mail;

/**
 * Class NotificacaoService
 * @package App\Services
 *
 * Centraliza o envio de notificações do sistema.
 */
class NotificacaoService
{
    /**
     * Envia notificação por e-mail para o responsável da área sobre uma nova solicitação.
     *
     * @param Solicitacao $solicitacao
     * @return void
     */
    public function notificarNovaSolicitacao(Solicitacao $solicitacao): void
    {
        // A lógica assume que a relação $solicitacao->area->responsavel retorna o usuário correto.
        $responsavel = $solicitacao->area->responsavel;

        if ($responsavel && $responsavel->email) {
            Mail::to($responsavel->email)->send(new NovaSolicitacaoMail($solicitacao));
        }
    }
}