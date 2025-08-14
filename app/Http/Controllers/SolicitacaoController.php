<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Orgao;
use App\Models\Solicitacao;
use App\Models\Auditoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
// use App\Notifications\NovaSolicitacaoNotification; // Descomentar quando a notificação for criada

class SolicitacaoController extends Controller
{


    public function index()
    {
        // Lógica para retornar dados, view ou JSON
        return view('superadmin.solicitacoes');
    }
    /**
     * Exibe o formulário público para criar uma nova solicitação.
     */
    public function create()
    {
        $orgaos = Orgao::with('areas')->get();
        return view('public.solicitacao.create', compact('orgaos'));
    }

    /**
     * Armazena uma nova solicitação no banco de dados.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome_completo' => 'required|string|max:255',
            'tipo_representacao' => 'required|in:pessoa_fisica,pessoa_juridica',
            'email_pessoal' => 'required|email|max:255',
            'email_sei' => 'required|email|max:255',
            'orgao_id' => 'required|exists:orgaos,id',
            'area_id' => 'required|exists:areas,id',
            'termo_assinado' => 'required|file|mimes:pdf,jpg,png|max:2048',
            'documento_cpf' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'selfie_documento' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'procuracao' => 'nullable|file|mimes:pdf,jpg,png|max:2048', // Para PJ
            'termos_aceitos' => 'required|accepted',
        ]);

        try {
            DB::beginTransaction();

            $solicitacao = Solicitacao::create([
                'protocolo' => 'PROT-' . time() . Str::upper(Str::random(6)),
                'nome_completo' => $validatedData['nome_completo'],
                'tipo_representacao' => $validatedData['tipo_representacao'],
                'email_pessoal' => $validatedData['email_pessoal'],
                'email_sei' => $validatedData['email_sei'],
                'orgao_id' => $validatedData['orgao_id'],
                'area_id' => $validatedData['area_id'],
                'status' => 'pendente',
                'termos_aceitos' => true,
            ]);

            // Upload dos arquivos
            $this->uploadArquivo($request, 'termo_assinado', $solicitacao->id);
            if ($request->hasFile('documento_cpf')) {
                $this->uploadArquivo($request, 'documento_cpf', $solicitacao->id);
            }
            if ($request->hasFile('selfie_documento')) {
                $this->uploadArquivo($request, 'selfie_documento', $solicitacao->id);
            }
            if ($request->hasFile('procuracao')) {
                $this->uploadArquivo($request, 'procuracao', $solicitacao->id);
            }

            // Log de auditoria inicial
            Auditoria::create([
                'solicitacao_id' => $solicitacao->id,
                'acao' => 'Criação da Solicitação',
                'status_novo' => 'pendente',
                'detalhes' => 'Solicitação enviada pelo formulário público.',
            ]);

            DB::commit();

            // Notificar responsáveis da área (a ser implementado)
            // $area = Area::find($solicitacao->area_id);
            // Notification::send($area->users, new NovaSolicitacaoNotification($solicitacao));

            return redirect()->route('solicitacao.sucesso')->with('protocolo', $solicitacao->protocolo);
        } catch (\Exception $e) {
            DB::rollBack();
            // Logar o erro: Log::error($e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Ocorreu um erro ao processar sua solicitação. Tente novamente.']);
        }
    }

    /**
     * Função auxiliar para upload de arquivo.
     */
    private function uploadArquivo(Request $request, string $tipoDocumento, int $solicitacaoId): void
    {
        $file = $request->file($tipoDocumento);
        $path = $file->store("solicitacoes/{$solicitacaoId}", 'local');

        $solicitacao->arquivos()->create([
            'tipo_documento' => $tipoDocumento,
            'caminho_arquivo' => $path,
            'nome_original' => $file->getClientOriginalName(),
            'mime_type' => $file->getClientMimeType(),
            'tamanho' => $file->getSize(),
        ]);
    }
}