<?php

namespace App\Http\Controllers;

use App\Models\Solicitacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RelatorioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Exibe a página para gerar relatórios.
     */
    public function index()
    {
        // A view terá os filtros (data, área, status)
        return view('relatorios.index');
    }

    /**
     * Exporta as solicitações em formato CSV.
     * Esta é uma implementação básica. Para cenários complexos,
     * considere usar um pacote como o Laravel Excel (Maatwebsite).
     */
    public function exportarSolicitacoes(Request $request)
    {
        $query = Solicitacao::query();

        // Lógica de filtragem (a ser implementada com base nos inputs do form)
        if ($request->filled('data_inicio')) {
            $query->whereDate('created_at', '>=', $request->data_inicio);
        }
        // ... outros filtros

        // Lógica de autorização para garantir que o responsável só exporte dados da sua área
        if (Auth::user()->role === 'responsavel') {
            $query->where('area_id', Auth::user()->area_id);
        }

        $solicitacoes = $query->get();

        // Lógica para gerar e retornar o arquivo CSV (a ser implementada)
        // Exemplo: return response()->streamDownload(...);
        return redirect()->back()->with('info', 'Funcionalidade de exportação em desenvolvimento.');
    }
}