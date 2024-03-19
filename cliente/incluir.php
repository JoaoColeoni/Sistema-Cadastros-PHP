<?php 
    require "../config.php";
    include "../verifica_se_logado.php";
    require "../conn.php";
    include "../cliente_endereco/controller.php";

    $sql = 'INSERT INTO clientes (nome, data_nascimento, cpf, rg, telefone)
            VALUES (:nome, :data_nascimento, :cpf, :rg, :telefone)';
    $prepare_sql = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $prepare_sql->execute([
        'nome' => $_POST['nome'], 
        'data_nascimento' => $_POST['data'], 
        'cpf' => preg_replace("/[^a-zA-Z0-9]/", "", $_POST['cpf']), 
        'rg' => preg_replace("/[^a-zA-Z0-9]/", "", $_POST['rg']), 
        'telefone' => preg_replace("/[^a-zA-Z0-9]/", "", $_POST['telefone'])
    ]);  
    
    $sql_ultimo_id = $conn->query('SELECT id FROM clientes ORDER BY id DESC LIMIT 1');
    $row_ultimo_id = $sql_ultimo_id->fetchAll();

    //Passa pelos endereços  
    if(isset($_POST['enderecos'])){       
        for ($i=0; $i < count($_POST['enderecos']['id']); $i++) {
            incluirEndereco(
                $conn,
                intval($row_ultimo_id[0]['id']), 
                $_POST['enderecos']['cep'][$i], 
                $_POST['enderecos']['estado'][$i], 
                $_POST['enderecos']['cidade'][$i], 
                $_POST['enderecos']['bairro'][$i], 
                $_POST['enderecos']['rua'][$i], 
                $_POST['enderecos']['numero'][$i], 
                $_POST['enderecos']['complemento'][$i]
            );
        }
    }
                        
    echo "done";
?>