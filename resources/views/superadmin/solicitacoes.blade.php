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
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Todas as Solicitações de Cadastro') }}</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __("Aqui você pode visualizar e gerenciar todas as solicitações de cadastro de usuários externos de todos os órgãos.") }}
                    </p>
                    {{-- Placeholder para a tabela de solicitações --}}
                    <div class="mt-6">
                        <p>Tabela com a listagem de solicitações aparecerá aqui.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>