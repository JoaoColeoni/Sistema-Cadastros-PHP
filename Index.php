<?php
    require 'config.php';
    include "header.php";
    include "redirect.php";
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
    <form action="login-verifica.php" method="POST">
        <input type="hidden" name="action" value="login">	
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text" id="usuario" name="usuario">
            <label class="mdl-textfield__label" for="usuario">Usuário</label>
        </div>		
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" id="password" type="password" name="senha">
            <label class="mdl-textfield__label" for="password">Senha</label>
        </div>
        <button type="submit" class="mdl-button mdl-js-button mdl-button--raised  mdl-button--colored">Entrar</button><br>
    </form>
</div>

<?php
    include "footer.php";
?>