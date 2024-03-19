<?php 
    require "../config.php";
    include "../verifica_se_logado.php";
    require "../conn.php";
    require "../funcoes.php";
    
    $id = "";
    $login = "";
    $senha = "";

    if(isset($_GET['id'])){
        $tittle = "Edição de Usuário";
        $form_action = $SITE . "usuario/editar.php";
        $sql = $conn->query('SELECT * FROM usuarios WHERE id = '.$_GET['id']);
        $result = $sql->fetchAll()[0];

        $id = $result['id'];
        $login = $result['login'];
        $senha = $result['senha'];
    }else{
        $tittle = "Cadastro de Usuário";
        $form_action = $SITE . "usuario/incluir.php";
    }
    
    include "../header.php";
?>

<main class="mdl-layout__content mdl-color--grey-100 main-container w-100">
    <form id="form-usuario" action="<?php echo $form_action; ?>" method="post">
        <div style="display: grid;">
            <input hidden type="text" id="id" name="id" value="<?php echo $id; ?>">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="login" name="login" value="<?php echo $login; ?>">
                <label class="mdl-textfield__label" for="login">Login</label>
            </div>
            <span id="login-error-msg" class="error-msg"></span>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-dirty">
                <input class="mdl-textfield__input" type="password" id="senha" name="senha" value="<?php echo $senha; ?>">
                <label class="mdl-textfield__label" for="senha">Senha</label>
            </div>
            <span id="senha-error-msg" class="error-msg"></span>
        </div>
        <br><br>
        <button id="btn-submit" type="button" onclick="enviarFormulario()" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent" style="margin-bottom: 5px;">
            <?php
                echo ($id == "" ? 'Cadastrar' : 'salvar')
            ?>
        </button>
        <br>
        <a href="<?php echo $SITE; ?>usuario/listar.php" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
            Cancelar
        </a>
    </form>
</main>

<script>
    function limparMensagensErro()
    {
        $(".error-msg").html('');
    }

    function validarCampos()
    {
        limparMensagensErro();
        erro = false;

        if($("#login").val().length == 0){
            $("#login-error-msg").html('Login não pode ser vazio.');
            erro = true;
        }
        if($("#senha").val().length < 5){
            $("#senha-error-msg").html('Senha precisa ter pelo menos 5 caracteres.');
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


        var form = $("#form-usuario");
        var actionUrl = form.attr('action');
        
        $.ajax({
            type: "POST",
            url: actionUrl,
            data: form.serialize(),
            success: function(data)
            {
                console.log(data);
                if(data == "done"){
                    window.location="<?php echo $SITE.'usuario/listar.php' ?>"
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