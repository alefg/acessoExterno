<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArquivoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Obtém a solicitação da rota (ex: /solicitacoes/{solicitacao}/arquivos)
        $solicitacao = $this->route('solicitacao');

        // Verifica se o usuário está logado e pode atualizar a solicitação (usando a Policy)
        return $this->user() && $solicitacao && $this->user()->can('update', $solicitacao);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'arquivo' => 'required|file|mimes:pdf,jpg,png,doc,docx|max:2048',
            'tipo_documento' => 'required|string|max:255',
        ];
    }
}