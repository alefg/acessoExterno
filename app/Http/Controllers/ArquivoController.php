<?php

namespace App\Http\Controllers;

use App\Models\Arquivo;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ArquivoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Realiza o download de um arquivo de uma solicitação.
     */
    public function download(Arquivo $arquivo)
    {
        // Usa a policy da Solicitação para verificar se o usuário pode ver os dados dela
        Gate::authorize('view', $arquivo->solicitacao);

        if (!Storage::disk('local')->exists($arquivo->caminho_arquivo)) {
            abort(404, 'Arquivo não encontrado.');
        }

        return Storage::disk('local')->download($arquivo->caminho_arquivo, $arquivo->nome_original);
    }
}