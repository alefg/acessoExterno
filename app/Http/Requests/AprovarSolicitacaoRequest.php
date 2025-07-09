<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AprovarSolicitacaoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Obtém a solicitação da rota (via route model binding).
        $solicitacao = $this->route('solicitacao');

        // Verifica se o usuário autenticado pode atualizar esta solicitação (via Policy).
        return $this->user()->can('update', $solicitacao);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'status' => ['required', Rule::in(['em_analise', 'aprovado', 'concluido'])],
            'observacoes' => 'nullable|string',
        ];
    }
}