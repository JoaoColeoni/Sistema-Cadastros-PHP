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
        $cpf = $result['cpf'];
        $rg = $result['rg'];
        $telefone = $result['telefone'];
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
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="date" id="data" name="data" value="<?php echo $data; ?>">
                <label class="mdl-textfield__label" for="data">Data de Nascimento</label>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="cpf" name="cpf" value="<?php echo mascara("###.###.###-##",$cpf); ?>" autocomplete="off" maxlength="14" onkeypress="somenteNumeros(event); maskCPF(this)">
                <label class="mdl-textfield__label" for="cpf">CPF</label>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="rg" name="rg" value="<?php echo mascara("##.###.###-#",$rg); ?>" autocomplete="off" maxlength="12" onkeypress="somenteNumeros(event); maskRG(this)">
                <label class="mdl-textfield__label" for="rg">RG</label>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="telefone" name="telefone" 
                value="<?php 
                            if(strlen($telefone) == 11)
                                    echo mascara("(##) #####-####",$telefone); 
                                else
                                    echo mascara("(##) ####-####",$telefone);  
                        ?>" 
                autocomplete="off" maxlength="15" onkeypress="somenteNumeros(event); maskTelefone(this)">
                <label class="mdl-textfield__label" for="telefone">Telefone</label>
            </div>
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
                        <tr>
                            <td class="mdl-data-table__cell--non-numeric"><input hidden name="enderecos[]['cep']" value="<?php echo $endereco['cep'] ?>"><?php echo mascara("#####-###",$endereco['cep']); ?></td>
                            <td><input hidden name="enderecos[]['estado']" value="<?php echo $endereco['estado'] ?>"><?php echo $endereco['estado']; ?></td>
                            <td><input hidden name="enderecos[]['cidade']" value="<?php echo $endereco['cidade'] ?>"><?php echo $endereco['cidade']; ?></td>
                            <td><input hidden name="enderecos[]['bairro']" value="<?php echo $endereco['bairro'] ?>"><?php echo $endereco['bairro']; ?></td>
                            <td><input hidden name="enderecos[]['rua']" value="<?php echo $endereco['rua'] ?>"><?php echo $endereco['rua']; ?></td>
                            <td><input hidden name="enderecos[]['numero']" value="<?php echo $endereco['numero'] ?>"><?php echo $endereco['numero']; ?></td>
                            <td><input hidden name="enderecos[]['complemento']" value="<?php echo $endereco['complemento'] ?>"><?php echo $endereco['complemento']; ?></td>
                            <td>
                                <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent table-btn" style="margin-right: 5px;" data-upgraded=",MaterialButton"
                                onclick="
                                        alterarEndereco(<?php echo '\''.$endereco['cep'].'\',\''.$endereco['estado'].'\',\''.$endereco['cidade'].'\',\''.$endereco['bairro'].'\',\''.$endereco['rua'].'\',\''.$endereco['numero'].'\',\''.$endereco['complemento'].'\''; ?>);
                                        document.querySelector('#modal-cliente').showModal();
                                        " 
                                >
                                    <i class="material-icons">edit</i>
                                </button>
                                <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent table-btn" data-upgraded=",MaterialButton">
                                    <i class="material-icons">delete</i>
                                </button>
                            </td>
                        </tr>
                    <?php 
                        }
                    ?>
                </tbody>
            </table>
            <button type="button" onclick="document.querySelector('#modal-cliente').showModal()" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent" style="margin-top: 15px;">
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
    function enviarFormulario()
    {
        $("#btn-submit").prop("disabled",true);

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