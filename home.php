<?php 
    $tittle = "Menu Principal";
    require "config.php";
    include "verifica_se_logado.php";
    include "header.php";
?>

<main class="mdl-layout__content mdl-color--grey-100 main-container w-100">
    <div class="mdl-grid">
        <div class="w-100">        
            <p class="menu-message">
                Bem vindo <?php echo $_SESSION["usuario"] ?>!<br>
                Selecione a rotina desejada.
            </p>
        </div> 
        <a class="btn-menu" href="<?php echo $SITE; ?>cliente/listar.php">
            <i class="material-icons btn_logo">groups</i>
            <br>
            <span class="btn_text">Clientes</span>
        </a>
        <a class="btn-menu" href="<?php echo $SITE; ?>usuario/listar.php">
            <i class="material-icons btn_logo">person</i>
            <br>
            <span class="btn_text">Usuarios</span>
        </a>
    </div>
</main>

<?php
    include "footer.php";
?>