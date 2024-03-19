<?php
    $is_login = true;
    require "config.php";
    include "header.php";
?>

<style>
    .caixa-login{
        margin: auto;
        width: 320px;
        text-align: center;
        padding: 20px;
        background-color: white;
    }
    html {
        background: #00000080;
    }
    h5{
        color: #757575;
    }
</style>

<div class="caixa-login mdl-shadow--4dp" style="margin-top:20vh">
    <h5>
        Login
    </h5>
    <form id="form-login" action="login/confirma_login.php" method="POST">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text" id="usuario" name="usuario">
            <label class="mdl-textfield__label" for="usuario">Usuário</label>
        </div>		
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" id="password" type="password" name="senha">
            <label class="mdl-textfield__label" for="password">Senha</label>
        </div>
        <div>
            <button id="btn-login" type="button" onclick="login()" class="mdl-button mdl-js-button mdl-button--raised  mdl-button--colored">Entrar</button>
        </div>
        <span id="login-error-msg" class="error-msg"></span>
    </form>
</div>

<script>
    function login()
    {
        $("#btn-login").prop("disabled",true);
        $("#login-error-msg").html('');

        var form = $("#form-login");
        var actionUrl = form.attr('action');
        
        $.ajax({
            type: "POST",
            url: actionUrl,
            data: form.serialize(),
            success: function(data)
            {
                if(data == "0"){
                    $("#login-error-msg").html('Login ou Senha inválidos.');
                    $("#btn-login").prop("disabled",false);
                }else{
                    window.location="<?php echo $SITE.'home.php' ?>";
                }
                
            },
            error: function (request, status, error) {
                $("#btn-login").prop("disabled",false);
                $("#login-error-msg").html('Erro na conexão, tente novamente.');
            }
        });
    }
</script>
<?php
    include "footer.php";
?>