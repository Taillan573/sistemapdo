<?php
session_start();
require_once("classes/DAO/PessoaDAO.php");
require_once("classes/Entidade/pessoa.php");
$userDAO = new pessoaDAO();
$pessoa = new pessoa();

if ($_SESSION['logado'] != 1) {
    $display = "none;";
    $displa = "inline;";
    ?>
    <script>
        document.location.href = "index.php?=erro1";
    </script>
    <?php
} else {
    $display = "inline;";
    $displa = "none;";
}
    $email = strip_tags(trim($_GET['email']));
        if ($userDAO->deletar($email)>0) {
?>
            <script type="text/javascript">
                alert("Pessoa apagada com sucesso.");
               document.location.href="listar.php";
            </script>
        <?php
    } else {
        ?>
            <script type="text/javascript">
                alert("Pessoa não cadastrada.");
                document.location.href="listar.php";
            </script>
        <?php
}
?>
