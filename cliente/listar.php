<?php 
    $tittle = "Listagem de Clientes";
    require "../config.php";
    include "../verifica_se_logado.php";
    require "../conn.php";
    include "../header.php";
    include "../funcoes.php";

    $sql_listagem = $conn->query('SELECT * FROM clientes');
    $rows = $sql_listagem->fetchAll();
?>

<main class="mdl-layout__content mdl-color--grey-100 main-container w-100">
    <a href="<?php echo $SITE; ?>cliente/formulario.php" class="mdl-button mdl-js-button mdl-button--raised  mdl-button--colored">
        Cadastrar novo Cliente
    </a>
    <br><br>
    <div>
        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp w-100">
            <thead>
                <tr>
                    <th class="mdl-data-table__cell--non-numeric">Nome</th>
                    <th>Data Nascimento</th>
                    <th>CPF</th>
                    <th>RG</th>
                    <th>Telefone</th>
                    <th width="150"></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    if(count($rows) == 0)
                    {
                ?>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric" colspan="6">Nenhum Cliente Registrado!</td>
                    </tr>
                <?php 
                    }
                    else{
                        foreach($rows as $row) {
                    ?>
                        <tr>
                            <td class="mdl-data-table__cell--non-numeric"><?php echo $row['nome']; ?></td>
                            <td><?php echo formataData($row['data_nascimento']); ?></td>
                            <td><?php echo mascara("###.###.###-##",$row['cpf']); ?></td>
                            <td><?php echo mascara("##.###.###-#",$row['rg']); ?></td>
                            <td>
                                <?php 
                                    if(strlen($row['telefone']) == 11)
                                        echo mascara("(##) #####-####",$row['telefone']); 
                                    else
                                        echo mascara("(##) ####-####",$row['telefone']); 
                                ?>
                            </td>
                            <td>
                                <a href="<?php echo $SITE; ?>cliente/formulario.php?id=<?php echo $row['id']; ?>" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent table-btn" data-upgraded=",MaterialButton">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a href="<?php echo $SITE; ?>cliente/excluir.php?id=<?php echo $row['id']; ?>" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent table-btn" data-upgraded=",MaterialButton">
                                    <i class="material-icons">delete</i>
                                </a>
                            </td>
                        </tr>
                    <?php 
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    <br>
    <a href="<?php echo $SITE; ?>home.php" class="mdl-button mdl-js-button mdl-button--raised  mdl-button--colored">
        Voltar
    </a>
</main>

<?php
    include "../footer.php";
?>