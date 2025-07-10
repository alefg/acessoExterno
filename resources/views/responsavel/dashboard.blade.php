<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard de Solicitações') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="h4 mb-4">Solicitações Recentes</h3>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#ID</th>
                                    <th scope="col">Nome do Solicitante</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Data de Envio</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- O Controller passará a variável $solicitacoes --}}
                                @forelse ($solicitacoes as $solicitacao)
                                    <tr>
                                        <th scope="row">{{ $solicitacao->id }}</th>
                                        <td>{{ $solicitacao->nome_completo }}</td>
                                        <td>{{ $solicitacao->email }}</td>
                                        <td><span class="badge bg-warning">{{ $solicitacao->status }}</span></td>
                                        <td>{{ $solicitacao->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('solicitacoes.show', $solicitacao) }}" class="btn btn-sm btn-primary">Visualizar</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Nenhuma solicitação encontrada.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>