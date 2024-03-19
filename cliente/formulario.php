<?php 
    require "../config.php";
    include "../verifica_se_logado.php";
    require "../conn.php";
    require "../funcoes.php";

    $id = "";
    $nome = "";
    $data = "";
    $cpf = "";
    $rg = "";
    $telefone = "";
    $result_enderecos = [];

    if(isset($_GET['id'])){
        $tittle = "Edição de Clientes";
        $form_action = $SITE . "cliente/editar.php";
        $sql = $conn->query('SELECT * FROM clientes WHERE id = '.$_GET['id']);
        $result = $sql->fetchAll()[0];

        $sql_enderecos = $conn->query('SELECT * FROM cliente_endereco WHERE cliente_id = '.$_GET['id']);
        $result_enderecos = $sql_enderecos->fetchAll();

        $id = $result['id'];
        $nome = $result['nome'];
        $data = $result['data_nascimento'];
        $cpf = mascara("###.###.###-##",$result['cpf']);
        $rg = mascara("##.###.###-#",$result['rg']); 
        $telefone = $result['telefone'];
        if(strlen($telefone) == 11)
            $telefone = mascara("(##) #####-####",$result['telefone']); 
        else
            $telefone = mascara("(##) ####-####",$result['telefone']); 
    }else{
        $tittle = "Cadastro de Clientes";
        $form_action = $SITE . "cliente/incluir.php";
    }
    
    include "../header.php";
    include "../cliente_endereco/modal.php";
?>

<main class="mdl-layout__content mdl-color--grey-100 main-container w-100">
    <form id="form-cliente" action="<?php echo $form_action; ?>" method="post">
        <div style="display: grid;">
            <input hidden type="text" id="id" name="id" value="<?php echo $id; ?>">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="nome" name="nome" value="<?php echo $nome; ?>">
                <label class="mdl-textfield__label" for="nome">Nome</label>
            </div>
            <span id="nome-error-msg" class="error-msg"></span>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-dirty">
                <input class="mdl-textfield__input" type="date" id="data" name="data" value="<?php echo $data; ?>">
                <label class="mdl-textfield__label" for="data">Data de Nascimento</label>
            </div>
            <span id="data-error-msg" class="error-msg"></span>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="cpf" name="cpf" value="<?php echo $cpf; ?>" autocomplete="off" maxlength="14" onkeypress="somenteNumeros(event); maskCPF(this)">
                <label class="mdl-textfield__label" for="cpf">CPF</label>
            </div>
            <span id="cpf-error-msg" class="error-msg"></span>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="rg" name="rg" value="<?php echo $rg; ?>" autocomplete="off" maxlength="12" onkeypress="somenteNumeros(event); maskRG(this)">
                <label class="mdl-textfield__label" for="rg">RG</label>
            </div>
            <span id="rg-error-msg" class="error-msg"></span>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="telefone" name="telefone" 
                value="<?php echo $telefone; ?>" 
                autocomplete="off" maxlength="15" onkeypress="somenteNumeros(event); maskTelefone(this)">
                <label class="mdl-textfield__label" for="telefone">Telefone</label>
            </div>
            <span id="telefone-error-msg" class="error-msg"></span>
        </div>
        <div>
            <h4>Endereços:</h4>
            <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp w-100">
                <thead>
                    <tr>
                        <th class="mdl-data-table__cell--non-numeric">Cep</th>
                        <th>Estado</th>
                        <th>Cidade</th>
                        <th>Bairro</th>
                        <th>Rua</th>
                        <th>Número</th>
                        <th>Complemento</th>
                        <th width="150"></th>
                    </tr>
                </thead>
                <tbody id="cliente-endereco-body">
                    <?php 
                        foreach($result_enderecos as $endereco) {
                    ?>
                        <tr id="linha_endereco_<?php echo $endereco['id'] ?>">
                            <td class="mdl-data-table__cell--non-numeric"><input hidden name="enderecos[id][]" value="<?php echo $endereco['id'] ?>"><input hidden name="enderecos[cep][]" value="<?php echo $endereco['cep'] ?>"><?php echo mascara("#####-###",$endereco['cep']); ?></td>
                            <td><input hidden name="enderecos[estado][]" value="<?php echo $endereco['estado'] ?>"><?php echo $endereco['estado']; ?></td>
                            <td><input hidden name="enderecos[cidade][]" value="<?php echo $endereco['cidade'] ?>"><?php echo $endereco['cidade']; ?></td>
                            <td><input hidden name="enderecos[bairro][]" value="<?php echo $endereco['bairro'] ?>"><?php echo $endereco['bairro']; ?></td>
                            <td><input hidden name="enderecos[rua][]" value="<?php echo $endereco['rua'] ?>"><?php echo $endereco['rua']; ?></td>
                            <td><input hidden name="enderecos[numero][]" value="<?php echo $endereco['numero'] ?>"><?php echo $endereco['numero']; ?></td>
                            <td><input hidden name="enderecos[complemento][]" value="<?php echo $endereco['complemento'] ?>"><?php echo $endereco['complemento']; ?></td>
                            <td>
                                <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent table-btn" style="margin-right: 5px;" data-upgraded=",MaterialButton"
                                onclick="
                                        abrirModalEndereco();
                                        carregarEndereco(<?php echo '\''.$endereco['id'].'\',\''.$endereco['cep'].'\',\''.$endereco['estado'].'\',\''.$endereco['cidade'].'\',\''.$endereco['bairro'].'\',\''.$endereco['rua'].'\',\''.$endereco['numero'].'\',\''.$endereco['complemento'].'\''; ?>);
                                        " 
                                >
                                    <i class="material-icons">edit</i>
                                </button>
                                <button type="button" onclick="removeEndereco($(this).parent().parent(),<?php echo $endereco['id']; ?>)" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent table-btn" data-upgraded=",MaterialButton">
                                    <i class="material-icons">delete</i>
                                </button>
                            </td>
                        </tr>
                    <?php 
                        }
                    ?>
                    <input hidden id="enderecos_deletados" name="enderecos_deletados" value="">
                </tbody>
            </table>
            <button type="button" onclick="abrirModalEndereco()" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent" style="margin-top: 15px;">
                Incluir Novo Endereço
            </button>
        </div>
        <br><br>
        <button id="btn-submit" type="button" onclick="enviarFormulario()" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent" style="margin-bottom: 5px;">
            <?php
                echo ($id == "" ? 'Cadastrar' : 'salvar')
            ?>
        </button>
        <br>
        <a href="<?php echo $SITE; ?>cliente/listar.php" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
            Cancelar
        </a>
    </form>
</main>

<script>
    function removeEndereco(linha_endereco,id_endereco)
    {
        $(linha_endereco).remove();
        if(id_endereco > 0){
            if($("#enderecos_deletados").val() == ""){
                $("#enderecos_deletados").val(id_endereco);
            }else{
                document.getElementById("enderecos_deletados").value += ","+id_endereco;
            }
        }
    }
    
    function limparMensagensErro()
    {
        $(".error-msg").html('');
    }

    function validarCampos()
    {
        limparMensagensErro();
        erro = false;

        if($("#nome").val().length == 0){
            $("#nome-error-msg").html('Nome não pode ser vazio.');
            erro = true;
        }
        if($("#data").val().length == 0){
            $("#data-error-msg").html('Selecione uma Data de Nascimento.');
            erro = true;
        }
        if($("#cpf").val().length != 14){
            $("#cpf-error-msg").html('Informe um CPF valido.');
            erro = true;
        }
        if($("#rg").val().length != 12){
            $("#rg-error-msg").html('Informe um RG valido.');
            erro = true;
        }
        if($("#telefone").val().length < 14){
            $("#telefone-error-msg").html('Informe um Telefone valido.');
            erro = true;
        }

        if(erro){
            $("#btn-submit").prop("disabled",false);
            return false;
        }

        return true;
    }

    function enviarFormulario()
    {
        $("#btn-submit").prop("disabled",true);

        if(!validarCampos())
            return;


        var form = $("#form-cliente");
        var actionUrl = form.attr('action');
        
        $.ajax({
            type: "POST",
            url: actionUrl,
            data: form.serialize(),
            success: function(data)
            {
                console.log(data);
                if(data == "done"){
                    window.location="<?php echo $SITE.'cliente/listar.php' ?>"
                }else{
                    $("#btn-submit").prop("disabled",false);
                    alert(data);
                }
            },
            error: function (request, status, error) {
                $("#btn-submit").prop("disabled",false);
            }
        });
    }
</script>

<?php 
    include "../footer.php";
?>