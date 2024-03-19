<?php 
    require "../config.php";
    include "../verifica_se_logado.php";
    require "../conn.php";

    $sql = 'INSERT INTO usuarios (login, senha)
            VALUES (:login, :senha)';
    $prepare_sql = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $prepare_sql->execute([
        'login' => $_POST['login'], 
        'senha' => $_POST['senha']
    ]);
                        
    echo "done";
?>