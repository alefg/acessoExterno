<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gerenciar Solicitações') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- Filtros e Exportação -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="GET" action="#">
                                <div class="row g-3 align-items-end">
                                    <div class="col-md-4">
                                        <label for="status" class="form-label">Filtrar por Status</label>
                                        <select name="status" id="status" class="form-select">
                                            <option value="">Todos</option>
                                            <option value="Pendente">Pendente</option>
                                            <option value="Em análise">Em análise</option>
                                            <option value="Aprovado">Aprovado</option>
                                            <option value="Concluído">Concluído</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-secondary">Filtrar</button>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <a href="#" class="btn btn-success">Exportar para CSV</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tabela de Solicitações -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>#ID</th>
                                    <th>Nome</th>
                                    <th>Status</th>
                                    <th>Data</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- O Controller passará a variável $solicitacoes --}}
                                @forelse ($solicitacoes as $solicitacao)
                                    <tr>
                                        <td>{{ $solicitacao->id }}</td>
                                        <td>{{ $solicitacao->nome_completo }}</td>
                                        <td>{{ $solicitacao->status }}</td>
                                        <td>{{ $solicitacao->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('solicitacoes.show', $solicitacao) }}" class="btn btn-sm btn-info">Detalhes</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Nenhuma solicitação corresponde aos filtros.</td>
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