{{-- Este arquivo é um "partial" para ser incluído na view de visualização --}}
<form action="{{ route('solicitacoes.update', $solicitacao) }}" method="POST">
    @csrf
    @method('PATCH')

    <div class="mb-3">
        <label for="status" class="form-label"><strong>Alterar Status</strong></label>
        <select class="form-select" id="status" name="status" required>
            <option value="Pendente" @if($solicitacao->status == 'Pendente') selected @endif>Pendente</option>
            <option value="Em análise" @if($solicitacao->status == 'Em análise') selected @endif>Em análise</option>
            <option value="Aprovado" @if($solicitacao->status == 'Aprovado') selected @endif>Aprovado</option>
            <option value="Concluído" @if($solicitacao->status == 'Concluído') selected @endif>Concluído</option>
            <option value="Recusado" @if($solicitacao->status == 'Recusado') selected @endif>Recusado</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="observacoes" class="form-label"><strong>Observações / Justificativa</strong></label>
        <textarea class="form-control" id="observacoes" name="observacoes" rows="5" placeholder="Adicione comentários ou a justificativa para a alteração de status.">{{ $solicitacao->observacoes }}</textarea>
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary">
            Atualizar Solicitação
        </button>
        
        <hr>

        <a href="#" class="btn btn-success">
            Executar Cadastro no SEI!
        </a>
    </div>
</form>