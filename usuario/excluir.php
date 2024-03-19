<?php 
    require "../config.php";
    include "../verifica_se_logado.php";
    require "../conn.php";

    $sql = 'DELETE FROM usuarios WHERE id = :id';
    $prepare_sql = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $prepare_sql->execute([
                            'id' => $_GET['id']
                        ]);
                        
    header('Location: ' . $SITE.'usuario/listar.php');
?>