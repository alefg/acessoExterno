<x-mail::message>
# Atualização da sua Solicitação

Olá, {{ $solicitacao->nome_completo }},

O status da sua solicitação de cadastro de usuário externo no SEI!MG foi atualizado.

**Novo Status:** {{ $solicitacao->status }}

Atenciosamente,<br>
{{ config('app.name') }}
</x-mail::message>