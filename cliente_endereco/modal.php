<dialog class="mdl-dialog modal-cadastro" id="modal-cliente">
    <h4 class="mdl-dialog__title">Endereço</h4>
    <div class="mdl-dialog__content">
        <div style="display: grid;">
            <input hidden type="text" id="id-endereco" name="id-endereco" value="-1">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="cep" name="cep" value="" autocomplete="off" maxlength="9" onkeypress="somenteNumeros(event); maskCep(this)" onfocusout="pesquisaCep(this.value)">
                <label class="mdl-textfield__label" for="cep">Cep</label>
            </div>
            <span id="cep-error-msg" class="error-msg modal-error-msg"></span>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="estado" name="estado" value="" maxlength="2">
                <label class="mdl-textfield__label" for="estado">Estado</label>
            </div>
            <span id="estado-error-msg" class="error-msg modal-error-msg"></span>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="cidade" name="cidade" value="">
                <label class="mdl-textfield__label" for="cidade">Cidade</label>
            </div>
            <span id="cidade-error-msg" class="error-msg modal-error-msg"></span>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="bairro" name="bairro" value="">
                <label class="mdl-textfield__label" for="bairro">Bairro</label>
            </div>
            <span id="bairro-error-msg" class="error-msg modal-error-msg"></span>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="rua" name="rua" value="">
                <label class="mdl-textfield__label" for="rua">Rua</label>
            </div>
            <span id="rua-error-msg" class="error-msg modal-error-msg"></span>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="numero" name="numero" value="">
                <label class="mdl-textfield__label" for="numero">Número</label>
            </div>
            <span id="numero-error-msg" class="error-msg modal-error-msg"></span>
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
        if(!modalValidarCampos())
            return;

        if($("#id-endereco").val() < 0){
            id_unico = new Date().getTime() + "_novo";
        }else{
            id_unico = $("#id-endereco").val();
        }

        html_td = "<td class=\"mdl-data-table__cell--non-numeric\"><input hidden name=\"enderecos[id][]\" value=\""+$("#id-endereco").val()+"\"><input hidden name=\"enderecos[cep][]\" value=\""+$("#cep").val().replace('-', '')+"\">"+$("#cep").val()+"</td>"+
                "<td><input hidden name=\"enderecos[estado][]\" value=\""+$("#estado").val()+"\">"+$("#estado").val()+"</td>"+
                "<td><input hidden name=\"enderecos[cidade][]\" value=\""+$("#cidade").val()+"\">"+$("#cidade").val()+"</td>"+
                "<td><input hidden name=\"enderecos[bairro][]\" value=\""+$("#bairro").val()+"\">"+$("#bairro").val()+"</td>"+
                "<td><input hidden name=\"enderecos[rua][]\" value=\""+$("#rua").val()+"\">"+$("#rua").val()+"</td>"+
                "<td><input hidden name=\"enderecos[numero][]\" value=\""+$("#numero").val()+"\">"+$("#numero").val()+"</td>"+
                "<td><input hidden name=\"enderecos[complemento][]\" value=\""+$("#complemento").val()+"\">"+$("#complemento").val()+"</td>"+
                "<td>"+
                    "<button type=\"button\" class=\"mdl-button mdl-js-button mdl-button--raised mdl-button--accent table-btn\" style=\"margin-right: 5px;\" data-upgraded=\",MaterialButton\""+
                    "onclick=\""+
                        "abrirModalEndereco();"+
                        "carregarEndereco('"+id_unico+"', '"+$("#cep").val().replace("-", "")+"', '"+$("#estado").val()+"', '"+$("#cidade").val()+"', '"+$("#bairro").val()+"', '"+$("#rua").val()+"', '"+$("#numero").val()+"', '"+$("#complemento").val()+"');"+
                        "\"><i class=\"material-icons\">edit</i>"+
                    "</button>"+
                    "<button type=\"button\" onclick=\"removeEndereco($(this).parent().parent(),-1)\" class=\"mdl-button mdl-js-button mdl-button--raised mdl-button--accent table-btn\" data-upgraded=\",MaterialButton\">"+
                        "<i class=\"material-icons\">delete</i>"+
                    "</button>"+
                "</td>";

        if($("#id-endereco").val() < 0){
            $("#cliente-endereco-body").append(
                "<tr id='linha_endereco_"+id_unico+"'>"+html_td+"</tr>"
            );
        }else{
            $("#linha_endereco_"+id_unico).html(
                html_td
            );
        }
        document.querySelector('#modal-cliente').close();
        limparCampos();
    }

    function abrirModalEndereco()
    {
        limparCampos();
        document.querySelector('#modal-cliente').showModal();
    }

    function limparCampos()
    {
        $("#id-endereco").val(-1);
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

    function carregarEndereco(id, cep, estado, cidade, bairro, rua, numero, complemento)
    {
        $("#id-endereco").val(id);
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

    function modalLimparMensagensErro()
    {
        $(".modal-error-msg").html('');
    }

    function modalValidarCampos()
    {
        modalLimparMensagensErro();
        erro = false;

        if($("#cep").val().length != 9){
            $("#cep-error-msg").html('Informe um CEP valido.');
            erro = true;
        }
        if($("#estado").val().length == 0){
            $("#estado-error-msg").html('Estado não pode ser vazio.');
            erro = true;
        }
        if($("#cidade").val().length == 0){
            $("#cidade-error-msg").html('Cidade não pode ser vazio.');
            erro = true;
        }
        if($("#bairro").val().length == 0){
            $("#bairro-error-msg").html('Bairro não pode ser vazio.');
            erro = true;
        }
        if($("#rua").val().length == 0){
            $("#rua-error-msg").html('Rua não pode ser vazio.');
            erro = true;
        }
        if($("#numero").val().length == 0){
            $("#numero-error-msg").html('Número não pode ser vazio.');
            erro = true;
        }

        if(erro){
            return false;
        }

        return true;
    }
</script>