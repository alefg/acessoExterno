<?php

namespace App\Http\Controllers;

use App\Models\Solicitacao;
use App\Models\Auditoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ResponsavelController extends Controller
{
    public function __construct()
    {
        // Garante que apenas usuários autenticados acessem este controller
        $this->middleware('auth');
    }

    /**
     * Exibe o painel com a lista de solicitações da área do responsável.
     */
    public function index()
    {
        $user = Auth::user();
        $solicitacoes = Solicitacao::where('area_id', $user->area_id)
            ->with('orgao', 'area')
            ->latest()
            ->paginate(15);

        return view('responsavel.dashboard', compact('solicitacoes'));
    }

    /**
     * Exibe os detalhes de uma solicitação específica.
     */
    public function show(Solicitacao $solicitacao)
    {
        // Garante que o responsável só veja solicitações da sua área
        Gate::authorize('view', $solicitacao);

        $solicitacao->load('arquivos', 'auditorias.user');

        return view('responsavel.show', compact('solicitacao'));
    }

    /**
     * Atualiza o status e as observações de uma solicitação.
     */
    public function update(Request $request, Solicitacao $solicitacao)
    {
        Gate::authorize('update', $solicitacao);

        $validated = $request->validate([
            'status' => 'required|in:em_analise,aprovado,concluido',
            'observacoes' => 'nullable|string',
        ]);

        $statusAnterior = $solicitacao->status;

        $solicitacao->status = $validated['status'];
        $solicitacao->observacoes = $validated['observacoes'];
        $solicitacao->responsavel_id = Auth::id();

        if ($validated['status'] === 'concluido') {
            $solicitacao->data_conclusao = now();
        }

        $solicitacao->save();

        Auditoria::create([
            'solicitacao_id' => $solicitacao->id,
            'user_id' => Auth::id(),
            'acao' => 'Atualização de Status',
            'status_anterior' => $statusAnterior,
            'status_novo' => $validated['status'],
            'detalhes' => $validated['observacoes'] ?? 'Status alterado pelo responsável.',
        ]);

        return redirect()->route('responsavel.show', $solicitacao)->with('success', 'Solicitação atualizada com sucesso!');
    }
}