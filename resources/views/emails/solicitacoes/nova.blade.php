<x-mail::message>
# Nova Solicitação de Cadastro

Olá,

Uma nova solicitação de cadastro de usuário externo foi recebida.

**Solicitante:** {{ $solicitacao->nome_completo }}

<x-mail::button :url="$url">
Ver Solicitação
</x-mail::button>

Atenciosamente,<br>
{{ config('app.name') }}
</x-mail::message>