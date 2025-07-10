<?php

namespace App\Mail;

use App\Models\Solicitacao; // Supondo que o model Solicitacao exista
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NovaSolicitacaoMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * A instância da solicitação.
     *
     * @var \App\Models\Solicitacao
     */
    public $solicitacao;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Solicitacao $solicitacao
     * @return void
     */
    public function __construct(Solicitacao $solicitacao)
    {
        $this->solicitacao = $solicitacao;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nova solicitação de cadastro de usuários',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.solicitacoes.nova',
            with: [
                'url' => route('solicitacoes.show', $this->solicitacao->id), // Exemplo de rota
            ],
        );
    }
}