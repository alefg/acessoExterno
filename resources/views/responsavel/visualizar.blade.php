<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalhes da Solicitação #{{ $solicitacao->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="row">
                <!-- Coluna de Detalhes -->
                <div class="col-lg-8">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header">
                            Dados do Solicitante
                        </div>
                        <div class="card-body">
                            <p><strong>Nome Completo:</strong> {{ $solicitacao->nome_completo }}</p>
                            <p><strong>E-mail de Contato:</strong> {{ $solicitacao->email }}</p>
                            <p><strong>E-mail SEI:</strong> {{ $solicitacao->email_sei }}</p>
                            <p><strong>Tipo de Representação:</strong> {{ $solicitacao->tipo_representacao }}</p>
                            <p><strong>Data de Envio:</strong> {{ $solicitacao->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="card shadow-sm">
                        <div class="card-header">
                            Documentos Anexados
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                {{-- Assumindo que os caminhos dos arquivos estão no model --}}
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Termo de Concordância e Veracidade
                                    <a href="#" class="btn btn-sm btn-outline-primary">Download</a>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Documento de Identificação com CPF
                                    <a href="#" class="btn btn-sm btn-outline-primary">Download</a>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Selfie segurando o Documento
                                    <a href="#" class="btn btn-sm btn-outline-primary">Download</a>
                                </li>
                                @if ($solicitacao->tipo_representacao == 'Pessoa Jurídica')
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Procuração / Ata / Termo de Posse
                                    <a href="#" class="btn btn-sm btn-outline-primary">Download</a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Coluna de Análise -->
                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            Análise da Solicitação
                        </div>
                        <div class="card-body">
                            {{-- Inclui o formulário de análise --}}
                            @include('responsavel.analisar')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>