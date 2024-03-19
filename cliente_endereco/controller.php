<?php

    function excluirEndereco($conn, $id){
        $sql = 'DELETE FROM cliente_endereco WHERE id = :id';
        $prepare_sql = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $prepare_sql->execute([
                                'id' => $id
                            ]);
        return true;
    }

    function incluirEndereco($conn, $cliente_id, $cep, $estado, $cidade, $bairro, $rua, $numero, $complemento){
        $sql = 'INSERT INTO cliente_endereco (cliente_id, cep, estado, cidade, bairro, rua, numero, complemento)
                VALUES (:cliente_id, :cep, :estado, :cidade, :bairro, :rua, :numero, :complemento)';
        $prepare_sql = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $prepare_sql->execute([
                                'cliente_id' => $cliente_id, 
                                'cep' => $cep, 
                                'estado' => $estado, 
                                'cidade' => $cidade, 
                                'bairro' => $bairro, 
                                'rua' => $rua, 
                                'numero' => $numero, 
                                'complemento' => $complemento, 
                            ]);
        return true;
    }

    function editarEndereco($conn, $id, $cep, $estado, $cidade, $bairro, $rua, $numero, $complemento){
        $sql = 'UPDATE cliente_endereco 
                SET cep = :cep, estado = :estado, cidade = :cidade, bairro = :bairro, rua = :rua, numero = :numero, complemento = :complemento
                WHERE id = :id';
        $prepare_sql = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $prepare_sql->execute([
                                'id' => $id, 
                                'cep' => $cep, 
                                'estado' => $estado, 
                                'cidade' => $cidade, 
                                'bairro' => $bairro, 
                                'rua' => $rua, 
                                'numero' => $numero, 
                                'complemento' => $complemento, 
                            ]); 

        return true;
    }

?>