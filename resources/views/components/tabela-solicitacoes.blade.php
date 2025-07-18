@props(['solicitacoes'])

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Solicitante
                </th>
                <th scope="col" class="px-6 py-3">
                    Órgão / Área
                </th>
                <th scope="col" class="px-6 py-3">
                    Data da Solicitação
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Ações</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($solicitacoes as $solicitacao)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        #{{ $solicitacao->id }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $solicitacao->nome_completo }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $solicitacao->area->orgao->nome ?? 'N/A' }} / {{ $solicitacao->area->nome ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $solicitacao->created_at->format('d/m/Y H:i') }}
                    </td>
                    <td class="px-6 py-4">
                        <x-status-badge :status="$solicitacao->status" />
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Analisar</a>
                    </td>
                </tr>
            @empty
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                        Nenhuma solicitação encontrada.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>