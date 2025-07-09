<?php

namespace App\Services;

use App\Models\Solicitacao;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

/**
 * Class ArquivoService
 * @package App\Services
 *
 * Gerencia o upload, armazenamento e exportação de arquivos.
 */
class ArquivoService
{
    /**
     * Salva os arquivos de uma solicitação no filesystem e registra no banco.
     *
     * @param Solicitacao $solicitacao A solicitação à qual os arquivos pertencem.
     * @param array<string, UploadedFile> $arquivos Array associativo de arquivos (ex: ['termo' => UploadedFile, ...]).
     * @return void
     */
    public function salvarArquivos(Solicitacao $solicitacao, array $arquivos): void
    {
        foreach ($arquivos as $tipo => $arquivo) {
            if ($arquivo instanceof UploadedFile) {
                $path = "solicitacoes/{$solicitacao->id}";
                $nomeArquivo = $tipo . '.' . $arquivo->getClientOriginalExtension();

                Storage::disk('local')->putFileAs($path, $arquivo, $nomeArquivo);

                // Assumindo um modelo 'Arquivo' para registrar os metadados
                $solicitacao->arquivos()->create([
                    'tipo_documento' => $tipo,
                    'caminho' => "{$path}/{$nomeArquivo}",
                    'nome_original' => $arquivo->getClientOriginalName(),
                ]);
            }
        }
    }

    /**
     * Gera um arquivo ZIP com os documentos de uma coleção de solicitações.
     *
     * @param Collection $solicitacoes Coleção de solicitações.
     * @return string|null Caminho para o arquivo ZIP gerado ou null em caso de falha.
     */
    public function exportarArquivosEmLote(Collection $solicitacoes): ?string
    {
        $zip = new ZipArchive();
        $nomeArquivoZip = 'exportacao_documentos_' . time() . '.zip';
        $caminhoArquivoZip = storage_path('app/temp/' . $nomeArquivoZip);

        if ($zip->open($caminhoArquivoZip, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) return null;

        foreach ($solicitacoes as $solicitacao) {
            foreach ($solicitacao->arquivos as $arquivo) {
                if (Storage::disk('local')->exists($arquivo->caminho)) {
                    $zip->addFile(Storage::path($arquivo->caminho), "solicitacao_{$solicitacao->id}/{$arquivo->nome_original}");
                }
            }
        }

        $zip->close();

        return $caminhoArquivoZip;
    }
}