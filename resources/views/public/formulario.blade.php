<x-public-layout>
    <div class="card shadow-sm">
        <div class="card-header">
            <h1 class="h4 mb-0">Passo 3: Envio da Solicitação e Documentos</h1>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('solicitacao.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Dados Pessoais -->
                <h5 class="mb-3">Seus Dados</h5>
                <div class="row g-3">
                    <div class="col-md-12">
                        <label for="nome_completo" class="form-label">Nome Completo</label>
                        <input type="text" class="form-control @error('nome_completo') is-invalid @enderror" id="nome_completo" name="nome_completo" value="{{ old('nome_completo') }}" required>
                        @error('nome_completo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">E-mail (pessoal para contato)</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                         @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="email_sei" class="form-label">E-mail cadastrado para o usuário externo no SEI</label>
                        <input type="email" class="form-control @error('email_sei') is-invalid @enderror" id="email_sei" name="email_sei" value="{{ old('email_sei') }}" required>
                         @error('email_sei')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="tipo_representacao" class="form-label">A que se destina o presente cadastro?</label>
                        <select class="form-select @error('tipo_representacao') is-invalid @enderror" id="tipo_representacao" name="tipo_representacao" required>
                            <option value="" selected disabled>Selecione...</option>
                            <option value="Pessoa Física" @if(old('tipo_representacao') == 'Pessoa Física') selected @endif>Representação: Pessoa Física</option>
                            <option value="Pessoa Jurídica" @if(old('tipo_representacao') == 'Pessoa Jurídica') selected @endif>Representação: Pessoa Jurídica</option>
                        </select>
                        @error('tipo_representacao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr class="my-4">

                <!-- Upload de Arquivos -->
                <h5 class="mb-3">Upload de Documentos</h5>
                <p class="text-muted">Anexe os documentos conforme as instruções do passo anterior. Limite de 2MB por arquivo.</p>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="termo_assinado" class="form-label">Termo de Concordância e Veracidade assinado</label>
                        <input class="form-control @error('termo_assinado') is-invalid @enderror" type="file" id="termo_assinado" name="termo_assinado" required>
                        @error('termo_assinado')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="documento_cpf" class="form-label">Documento de Identificação com CPF</label>
                        <input class="form-control @error('documento_cpf') is-invalid @enderror" type="file" id="documento_cpf" name="documento_cpf" required>
                        @error('documento_cpf')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="selfie_documento" class="form-label">Selfie segurando o Documento</label>
                        <input class="form-control @error('selfie_documento') is-invalid @enderror" type="file" id="selfie_documento" name="selfie_documento" required>
                        @error('selfie_documento')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6" id="campo-procuracao" style="display: none;">
                        <label for="procuracao" class="form-label">Procuração / Ata / Termo de Posse (para PJ)</label>
                        <input class="form-control @error('procuracao') is-invalid @enderror" type="file" id="procuracao" name="procuracao">
                        @error('procuracao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr class="my-4">

                <!-- Aceite dos Termos -->
                <div class="form-check">
                    <input type="checkbox" class="form-check-input @error('aceite_termos') is-invalid @enderror" id="aceite_termos" name="aceite_termos" required>
                    <label class="form-check-label" for="aceite_termos">Declaro que li e concordo com os termos de uso e a política de privacidade.</label>
                     @error('aceite_termos')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">Enviar Solicitação</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tipoRepresentacaoSelect = document.getElementById('tipo_representacao');
            const campoProcuracao = document.getElementById('campo-procuracao');
            const inputProcuracao = document.getElementById('procuracao');

            function toggleProcuracao() {
                if (tipoRepresentacaoSelect.value === 'Pessoa Jurídica') {
                    campoProcuracao.style.display = 'block';
                    inputProcuracao.required = true;
                } else {
                    campoProcuracao.style.display = 'none';
                    inputProcuracao.required = false;
                }
            }

            tipoRepresentacaoSelect.addEventListener('change', toggleProcuracao);
            toggleProcuracao(); // Executa na carga da página para o caso de 'old' values
        });
    </script>
</x-public-layout>