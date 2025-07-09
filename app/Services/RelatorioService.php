<?php

namespace App\Services;

use App\Models\Solicitacao;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class RelatorioService
 * @package App\Services
 *
 * Constrói e exporta relatórios e dados do sistema.
 */
class RelatorioService
{
    public function __construct(protected ArquivoService $arquivoService)
    {
    }

    /**
     * Gera e retorna o caminho para um arquivo CSV de solicitações com base em filtros.
     *
     * @param array $filtros Filtros como data, área e status.
     * @return string Caminho para o arquivo CSV gerado.
     */
    public function exportarSolicitacoesCsv(array $filtros): string
    {
        $solicitacoes = $this->buscarSolicitacoesComFiltros($filtros)->get();
        $nomeArquivo = 'relatorio_solicitacoes_' . time() . '.csv';
        $caminhoArquivo = storage_path('app/temp/' . $nomeArquivo);
        $handle = fopen($caminhoArquivo, 'w');

        // Cabeçalho do CSV
        fputcsv($handle, ['ID', 'Nome Solicitante', 'Email', 'Órgão', 'Área', 'Status', 'Data Criação', 'Data Conclusão']);

        // Dados
        foreach ($solicitacoes as $solicitacao) {
            fputcsv($handle, [
                $solicitacao->id,
                $solicitacao->nome_completo,
                $solicitacao->email,
                $solicitacao->area->orgao->nome, // Exemplo de relação
                $solicitacao->area->nome,       // Exemplo de relação
                $solicitacao->status,
                $solicitacao->created_at->format('d/m/Y H:i:s'),
                $solicitacao->status === 'Concluído' ? $solicitacao->updated_at->format('d/m/Y H:i:s') : '',
            ]);
        }

        fclose($handle);

        return $caminhoArquivo;
    }

    /**
     * Exporta um lote de documentos com base nos filtros, delegando para o ArquivoService.
     *
     * @param array $filtros
     * @return string|null Caminho para o arquivo ZIP gerado.
     */
    public function exportarDocumentosLote(array $filtros): ?string
    {
        $solicitacoes = $this->buscarSolicitacoesComFiltros($filtros)
            ->with('arquivos') // Eager load para performance
            ->get();

        return $this->arquivoService->exportarArquivosEmLote($solicitacoes);
    }

    /**
     * Constrói a query de busca de solicitações com base nos filtros fornecidos.
     *
     * @param array $filtros
     * @return Builder
     */
    private function buscarSolicitacoesComFiltros(array $filtros): Builder
    {
        $query = Solicitacao::query()->with(['area.orgao']);

        if (!empty($filtros['data_inicio'])) $query->whereDate('created_at', '>=', $filtros['data_inicio']);
        if (!empty($filtros['data_fim'])) $query->whereDate('created_at', '<=', $filtros['data_fim']);
        if (!empty($filtros['area_id'])) $query->where('area_id', $filtros['area_id']);
        if (!empty($filtros['status'])) $query->where('status', $filtros['status']);

        return $query;
    }
}