<?php 
    $tittle = "Listagem de Clientes";
    require "../config.php";
    include "../verifica_se_logado.php";
    require "../conn.php";
    include "../header.php";
    include "../funcoes.php";
    include "../modal_exclusao.php";

    $filtro = (isset($_GET['filtro'])) ? preg_replace("/[^a-zA-Z0-9]/", "", $_GET['filtro']) : '';
    $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;

    $sql_total = $conn->query('SELECT COUNT(id) as TOTAL FROM clientes');
    $result = $sql_total->fetchAll();
    $ultima_page = ceil($result[0]['TOTAL']/10);
    
    if($ultima_page == 0)
        $ultima_page = 1;

    $sql_listagem = $conn->query('SELECT * FROM clientes 
                                    WHERE nome LIKE "%'.$filtro.'%" 
                                    OR data_nascimento LIKE "%'.$filtro.'%" 
                                    OR cpf LIKE "%'.$filtro.'%" 
                                    OR rg LIKE "%'.$filtro.'%" 
                                    OR telefone LIKE "%'.$filtro.'%" 
                                ORDER BY nome LIMIT 10 OFFSET '.(intval($pagina)-1)*10);
    $rows = $sql_listagem->fetchAll();
?>

<main class="mdl-layout__content mdl-color--grey-100 main-container w-100">
    <a href="<?php echo $SITE; ?>cliente/formulario.php" class="mdl-button mdl-js-button mdl-button--raised  mdl-button--colored">
        Cadastrar novo Cliente
    </a>
    <br><br>
    <div>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text" id="filtro_nome" value="<?php echo $filtro; ?>">
            <label class="mdl-textfield__label" for="nome">Filtro</label>
        </div>
        <button type="button" onclick="filtrar()" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored table-btn" data-upgraded=",MaterialButton">
            <i class="material-icons">search</i>
        </button>
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
                        <td class="mdl-data-table__cell--non-numeric" colspan="6">Nenhum Cliente Encontrado!</td>
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
                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent table-btn" data-upgraded=",MaterialButton"
                                        onclick="abrirModalExclusao('window.location=\'<?php echo $SITE; ?>cliente/excluir.php?id=<?php echo $row['id']; ?>\'','<?php echo $row['id']; ?>','<?php echo $row['nome']; ?>')">
                                    <i class="material-icons">delete</i>
                                </button>
                            </td>
                        </tr>
                    <?php 
                        }
                    }
                ?>
            </tbody>
        </table>
        <div style="display: flex">
            <p class="titulo-paginacao">Página (10 registros por página)</p>
            <button class="mdl-button mdl-js-button mdl-js-ripple-effect" <?php if($pagina == 1) echo 'disabled';?> onclick="trocarPagina(1)">
                <i class="material-icons">first_page</i>
            </button>
            <button class="mdl-button mdl-js-button mdl-js-ripple-effect" <?php if($pagina == 1) echo 'disabled';?> onclick="trocarPagina(<?php echo $pagina; ?> - 1)">
                <i class="material-icons">chevron_left</i>
            </button>
            <p class="numero-paginacao"><?php echo $pagina; ?></p>
            <button class="mdl-button mdl-js-button mdl-js-ripple-effect" <?php if($pagina == $ultima_page) echo 'disabled';?> onclick="trocarPagina(<?php echo $pagina; ?> + 1)">
                <i class="material-icons">chevron_right</i>
            </button>
            <button class="mdl-button mdl-js-button mdl-js-ripple-effect" <?php if($pagina == $ultima_page) echo 'disabled';?> onclick="trocarPagina(<?php echo $ultima_page; ?>)">
                <i class="material-icons">last_page</i>
            </button>
        </div>
    </div>
    <br>
    <a href="<?php echo $SITE; ?>home.php" class="mdl-button mdl-js-button mdl-button--raised  mdl-button--colored">
        Voltar
    </a>
</main>

<script>
    function filtrar()
    {
        window.location="<?php echo $SITE.'cliente/listar.php?filtro='?>"+$("#filtro_nome").val()+"<?php echo '&pagina='.$pagina ?>";
    }

    function trocarPagina(value)
    {
        window.location="<?php echo $SITE.'cliente/listar.php?filtro='.$filtro.'&pagina=' ?>"+value;
    }
</script>

<?php
    include "../footer.php";
?>