<?php 
    require "../config.php";
    include "../verifica_se_logado.php";
    require "../conn.php";

    $sql = 'UPDATE usuarios 
            SET login = :login, senha = :senha
            WHERE id = :id';
    $prepare_sql = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);

    $prepare_sql->execute([
                            'id' => intval($_POST['id']), 
                            'login' => $_POST['login'], 
                            'senha' => $_POST['senha']
                        ]);
                        
    echo "done";
?>