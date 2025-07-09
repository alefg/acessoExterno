<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SolicitacaoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Formulário público, qualquer um pode enviar.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nome_completo' => 'required|string|max:255',
            'tipo_representacao' => ['required', Rule::in(['pessoa_fisica', 'pessoa_juridica'])],
            'email_pessoal' => 'required|email|max:255',
            'email_sei' => 'required|email|max:255',
            'orgao_id' => 'required|exists:orgaos,id',
            'area_id' => 'required|exists:areas,id',
            'termo_assinado' => 'required|file|mimes:pdf,jpg,png|max:2048',
            'documento_cpf' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'selfie_documento' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'procuracao' => 'required_if:tipo_representacao,pessoa_juridica|nullable|file|mimes:pdf,jpg,png|max:2048',
            'termos_aceitos' => 'required|accepted',
        ];
    }
}