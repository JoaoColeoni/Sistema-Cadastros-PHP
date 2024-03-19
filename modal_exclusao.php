<dialog class="mdl-dialog modal-exclusao" id="modal-exclusao">
    <h4 class="mdl-dialog__title">Excluir</h4>
    <div class="mdl-dialog__content">
        Deseja realmente Excluir o registro <span id="texto-registro"></span>
    </div>
    <div class="mdl-dialog__actions">
        <button type="button" class="mdl-button mdl-button--raised mdl-button--accent" id="btn-confirmacao" onclick="">Sim</button>
        <button type="button" class="mdl-button mdl-button--raised mdl-button--colored" onclick="document.querySelector('#modal-exclusao').close()">Não</button>
    </div>
</dialog>

<script>
    function abrirModalExclusao(acao,id,descricao)
    {
        $('#texto-registro').html(id+" - "+descricao);
        $('#btn-confirmacao').attr("onclick",acao);
        document.querySelector('#modal-exclusao').showModal();
    }
</script>