<?php 
    require "../config.php";
    include "../verifica_se_logado.php";
    require "../conn.php";

    var_dump($_POST);

    /*$sql = 'UPDATE clientes 
            SET nome = :nome, data_nascimento = :data_nascimento , cpf = :cpf , rg = :rg , telefone = :telefone
            WHERE id = :id';
    $prepare_sql = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);

    $prepare_sql->execute([
                            'id' => intval($_POST['id']), 
                            'nome' => $_POST['nome'], 
                            'data_nascimento' => $_POST['data'], 
                            'cpf' => preg_replace("/[^a-zA-Z0-9]/", "", $_POST['cpf']), 
                            'rg' => preg_replace("/[^a-zA-Z0-9]/", "", $_POST['rg']), 
                            'telefone' => preg_replace("/[^a-zA-Z0-9]/", "", $_POST['telefone'])
                        ]);               
                        
    echo "done";*/
?>