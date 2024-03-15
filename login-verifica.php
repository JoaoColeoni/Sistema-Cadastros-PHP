<?php
    require 'config.php';

    var_dump($_POST['usuario']);

    if($_POST['usuario'] == 'admin' && $_POST['senha'] == '123'){
?>
        <script>
            window.location.href = "<?php echo $SITE ?>home";
        </script>
<?php
    }else{
?>
    <script>
        window.location.href = "<?php echo $SITE ?>";
    </script>
<?php
    }
?>