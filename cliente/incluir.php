<?php 
    require "../config.php";
    include "../verifica_se_logado.php";
    require "../conn.php";

    $sql = 'INSERT INTO clientes (nome, data_nascimento, cpf, rg, telefone)
            VALUES (:nome, :data_nascimento, :cpf, :rg, :telefone)';
    $prepare_sql = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $prepare_sql->execute([
                            'nome' => $_POST['nome'], 
                            'data_nascimento' => $_POST['data'], 
                            'cpf' => $_POST['cpf'], 
                            'rg' => $_POST['rg'], 
                            'telefone' => $_POST['telefone']
                        ]);
                        
    header('Location: ' . $SITE.'cliente/listar.php');
?>