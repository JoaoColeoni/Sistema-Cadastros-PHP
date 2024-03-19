<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistema Teste</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="<?php echo $SITE; ?>css/material.blue_grey-indigo.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $SITE; ?>css/main.css">
</head>
<body>
    
<?php if(!isset($is_login)) { 
    $_SESSION["session_time"] = time();
?>
    <header class="mdl-layout__header is-casting-shadow" style="display: flex">
        <div style="display: flex">
            <span class="page-title"><?php echo $tittle; ?></span>

            <div class="mdl-layout-spacer"></div>

            <button id="demo-menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon option-btn">
                <i class="material-icons">more_vert</i>
            </button>

            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="demo-menu-lower-right">
                <a class="mdl-menu__item" href="<?php echo $SITE; ?>/login/logout.php">Sair</a>
            </ul>
        </div>
    </header>
<?php } ?>