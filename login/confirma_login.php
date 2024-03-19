<?php
    require '../config.php';
    require "../conn.php";

    $sql = 'SELECT login, senha FROM usuarios
            WHERE login = :login AND senha = :senha';
    $prepare_sql = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $prepare_sql->execute(['login' => $_POST['usuario'], 'senha' => $_POST['senha']]);
    $rows = $prepare_sql->fetchAll();

    if(count($rows) > 0){
        $_SESSION["usuario"] = $_POST['usuario'];
        $_SESSION["session_time"] = time();
        echo '1';
    }else{
        echo '0';
    }
?>