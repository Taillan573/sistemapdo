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
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <style type="text/css">
            .dispray{
                display: <?php echo $display; ?>;
            }
            .disp{
                display: <?php echo $displa; ?>;
            }
        </style>
        <link rel="stylesheet" type="text/css" href="css/estilo.css">

        <!-- Bootstrap core CSS -->
        <link href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="https://getbootstrap.com/docs/4.1/examples/sign-in/signin.css" rel="stylesheet">

        <title>Cadastro</title>
    </head>

    <body class="text-center">
        <nav id="navega">
            <div id="menu">
                <a href="index.php" class=" disp btn-lg btn-primary " > Login </a>
                <a href="cadastro.php" class=" dispray btn-lg btn-primary " >Cadastrar</a>
                <a href="listar.php" class=" dispray btn-lg btn-primary " >Buscar Usuario</a>
                <a href="update.php" class=" dispray btn-lg btn-primary " >Atualizar</a>
                <a href="delete.php" class=" dispray btn-lg btn-primary " >Excluir</a>
                <a href="?acao=sair" class=" dispray btn-lg btn-primary " >Logout</a>
            </div>
        </nav>

        <form method="post" name="frmCadastro" class="form-signin">
            <h1 class="h3 mb-3 font-weight-normal">Digite o email do usuario para apagar</h1>
            <label for="inputEmail" class="sr-only">Email: </label>
            <input type="text" id="inputEmail" name="email" class="form-control" placeholder="Email"  >
            <button name="apagar" type="submit">Deletar</button>
            <p style="color: #fff;padding-top: 40px;">&copy; 2017-2018</p>
        </form>
        <table align="center" border="3">

    </body>


    <?php
//if (isset($_GET['email'])) {
    $email = strip_tags(trim($_GET['email']));
        if ($userDAO->deletar($email)>0) {
?>
            <script type="text/javascript">
                alert("Pessoa apagada com sucesso.");
            </script>
        <?php
        header("Location: listar.php");
    } else {
        ?>
            <script type="text/javascript">
                alert("Pessoa não cadastrada.");
            </script>
        <?php
}//}
?>
</html>