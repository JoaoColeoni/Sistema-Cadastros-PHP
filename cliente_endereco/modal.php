<dialog class="mdl-dialog modal-cadastro" id="modal-cliente">
    <h4 class="mdl-dialog__title">Endereço</h4>
    <div class="mdl-dialog__content">
        <div style="display: grid;">
            <input hidden type="text" id="id" name="id" value="">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="cep" name="cep" value="" autocomplete="off" maxlength="9" onkeypress="somenteNumeros(event); maskCep(this)" onfocusout="pesquisaCep(this.value)">
                <label class="mdl-textfield__label" for="cep">Cep</label>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="estado" name="estado" value="" maxlength="2">
                <label class="mdl-textfield__label" for="estado">Estado</label>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="cidade" name="cidade" value="">
                <label class="mdl-textfield__label" for="cidade">Cidade</label>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="bairro" name="bairro" value="">
                <label class="mdl-textfield__label" for="bairro">Bairro</label>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="rua" name="rua" value="">
                <label class="mdl-textfield__label" for="rua">Rua</label>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="numero" name="numero" value="">
                <label class="mdl-textfield__label" for="numero">Número</label>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="complemento" name="complemento" value="">
                <label class="mdl-textfield__label" for="complemento">Complemento</label>
            </div>
        </div>
    </div>
    <div class="mdl-dialog__actions">
        <button type="button" class="mdl-button mdl-button--raised mdl-button--accent" onclick="salvarEndereco()">Salvar</button>
        <button type="button" class="mdl-button mdl-button--raised mdl-button--colored" onclick="document.querySelector('#modal-cliente').close()">Cancelar</button>
    </div>
</dialog>

<script>
    function salvarEndereco()
    {
        $("#cliente-endereco-body").append(
            "<tr>"+
                "<td class=\"mdl-data-table__cell--non-numeric\">"+$("#cep").val()+"</td>"+
                "<td>"+$("#estado").val()+"</td>"+
                "<td>"+$("#cidade").val()+"</td>"+
                "<td>"+$("#bairro").val()+"</td>"+
                "<td>"+$("#rua").val()+"</td>"+
                "<td>"+$("#numero").val()+"</td>"+
                "<td>"+$("#complemento").val()+"</td>"+
                "<td>"+
                    "<button type=\"button\" class=\"mdl-button mdl-js-button mdl-button--raised mdl-button--accent table-btn\" data-upgraded=\",MaterialButton\">"+
                        "<i class=\"material-icons\">edit</i>"+
                    "</button>"+
                    "<button type=\"button\"    class=\"mdl-button mdl-js-button mdl-button--raised mdl-button--accent table-btn\" data-upgraded=\",MaterialButton\">"+
                        "<i class=\"material-icons\">delete</i>"+
                    "</button>"+
                "</td>"+
            "</tr>"
        );
        document.querySelector('#modal-cliente').close();
        limparCampos();
    }

    function limparCampos()
    {
        $("#cep").val('');
        $("#estado").val('');
        $("#cidade").val('');
        $("#bairro").val('');
        $("#rua").val('');
        $("#numero").val('');
        $("#complemento").val('');

        $("#cep").parent().removeClass('is-dirty');
        $("#estado").parent().removeClass('is-dirty');
        $("#cidade").parent().removeClass('is-dirty');
        $("#bairro").parent().removeClass('is-dirty');
        $("#rua").parent().removeClass('is-dirty');
        $("#numero").parent().removeClass('is-dirty');
        $("#complemento").parent().removeClass('is-dirty');
    }

    function alterarEndereco(cep, estado, cidade, bairro, rua, numero, complemento)
    {
        cep = cep.substring(0, 5) + "-" + cep.substring(5,8);
        $("#cep").val(cep);
        $("#estado").val(estado);
        $("#cidade").val(cidade);
        $("#bairro").val(bairro);
        $("#rua").val(rua);
        $("#numero").val(numero);
        $("#complemento").val(complemento);

        $("#cep").parent().addClass('is-dirty');
        $("#estado").parent().addClass('is-dirty');
        $("#cidade").parent().addClass('is-dirty');
        $("#bairro").parent().addClass('is-dirty');
        $("#rua").parent().addClass('is-dirty');
        $("#numero").parent().addClass('is-dirty');
        $("#complemento").parent().addClass('is-dirty');
    }

    function pesquisaCep(cep)
    {
        cep = cep.replace('-', '');
        if(cep.length == 8){
            $.ajax({url: "http://viacep.com.br/ws/"+cep+"/json/", async: false, success: function(result){
                if(result['erro'])
                    return;
                $("#estado").val(result['uf']);
                $("#estado").parent().addClass('is-dirty');
                $("#cidade").val(result['localidade']);
                $("#cidade").parent().addClass('is-dirty');
                $("#bairro").val(result['bairro']);
                $("#bairro").parent().addClass('is-dirty');
                $("#rua").val(result['logradouro']);
                $("#rua").parent().addClass('is-dirty');
            }});
        }
    }
</script>