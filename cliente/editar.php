<?php 
    require "../config.php";
    include "../verifica_se_logado.php";
    require "../conn.php";
    include "../cliente_endereco/controller.php";

    $sql = 'UPDATE clientes 
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

    //Passa pelos endereços 
    if(isset($_POST['enderecos'])){             
        for ($i=0; $i < count($_POST['enderecos']['id']); $i++) {
            if($_POST['enderecos']['id'][$i] == -1)
            {
                incluirEndereco(
                    $conn,
                    intval($_POST['id']), 
                    $_POST['enderecos']['cep'][$i], 
                    $_POST['enderecos']['estado'][$i], 
                    $_POST['enderecos']['cidade'][$i], 
                    $_POST['enderecos']['bairro'][$i], 
                    $_POST['enderecos']['rua'][$i], 
                    $_POST['enderecos']['numero'][$i], 
                    $_POST['enderecos']['complemento'][$i]
                );
            }else{
                editarEndereco(
                    $conn,
                    $_POST['enderecos']['id'][$i], 
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
    }
    
    if($_POST['enderecos_deletados'] != ""){
        foreach (explode(",",$_POST['enderecos_deletados']) as $endereco_id) {
            excluirEndereco($conn, $endereco_id);
        }
    }
                        
    echo "done";
?>