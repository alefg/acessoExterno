<x-public-layout>
    <div class="card shadow-sm">
        <div class="card-header">
            <h1 class="h4 mb-0">Passo 2: Preparação dos Documentos</h1>
        </div>
        <div class="card-body">
            <p class="lead">Preencha e assine o “Termo de declaração de Concordância e Veracidade” (<a href="#">CLIQUE AQUI PARA ACESSAR E BAIXAR O TERMO</a>). Este termo pode ser preenchido com ou sem certificado digital ICP-Brasil.</p>
            <p>Segue abaixo a lista de documentos exigidos em cada caso:</p>

            <div class="row">
                <!-- Preenchimento Manual -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5>Preenchimento Manual</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Cópia digitalizada do “Termo de Declaração de Concordância e Veracidade” preenchido e assinado manualmente.</li>
                                <li class="list-group-item">Cópia digitalizada de documento de identificação civil no qual conste CPF.</li>
                                <li class="list-group-item">Cópia digitalizada de procuração, termo de posse, ata ou outro documento caso esteja representando uma organização.</li>
                                <li class="list-group-item">Autorretrato (selfie) segurando o documento de identificação.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Preenchimento Digital -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5>Preenchimento Digital (com Adobe ou Certificado ICP-Brasil)</h5>
                        </div>
                        <div class="card-body">
                             <ul class="list-group list-group-flush">
                                <li class="list-group-item">PDF do “Termo de Declaração de Concordância e Veracidade” assinado digitalmente.</li>
                                <li class="list-group-item">Cópia digitalizada de procuração, termo de posse, ata ou outro documento caso esteja representando uma organização (pessoa jurídica).</li>
                            </ul>
                            <div class="alert alert-info mt-3">
                                <strong>Importante:</strong> Caso realize o procedimento com o certificado digital, não imprima o termo. Baixe o arquivo, preencha os campos e assine-o digitalmente.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('solicitacao.create') }}" class="btn btn-success">Prosseguir para o Formulário &raquo;</a>
            </div>
        </div>
    </div>
</x-public-layout>