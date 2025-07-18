<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Relatórios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Geração de Relatórios') }}</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __("Filtre e exporte dados das solicitações em formato CSV.") }}
                    </p>
                    {{-- Placeholder para filtros e botão de exportação --}}
                    <div class="mt-6 space-y-4">
                        <p>Filtros (por data, por área, por status) e botão de exportação aparecerão aqui.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>