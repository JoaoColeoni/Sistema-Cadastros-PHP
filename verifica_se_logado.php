<?php
    if( !isset($_SESSION["usuario"])){
        header('Location: ' . $SITE);
    }
    if($_SESSION["session_time"] + 600 < time()){
        header('Location: ' . $SITE.'login/logout.php');
    }
?>