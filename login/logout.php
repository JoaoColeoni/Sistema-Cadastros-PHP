<?php
    require '../config.php';

    unset($_SESSION["usuario"]);
    header('Location: ' . $SITE);
    return;
?>