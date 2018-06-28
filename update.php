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
            <h1 class="h3 mb-3 font-weight-normal">Bem vindo!</h1>
            <label for="inputNome" class="sr-only">Nome: </label>
            <input type="text" id="inputNome" name="nome" class="form-control" placeholder="Nome"  autofocus/>
            <label for="inputIdade"  class="sr-only">Idade:</label>
            <input type="text" id="inputIdade" name="idade" class="form-control" placeholder="Idade" />
            <label for="inputEmail" class="sr-only">Email: </label>
            <input type="text" id="inputEmail" name="email" class="form-control" placeholder="Email"  >
            <label for="inputSenha" class="sr-only">Senha:</label>
            <input type="password" id="inputSenha" name="senha" class="form-control" placeholder="Senha" >
            <button name="btnCadastrar" type="submit">Cadastrar</button>
            <button name="btnProcurar" class="dispray" type="submit">Buscar</button>
            <p style="color: #fff;padding-top: 40px;">&copy; 2017-2018</p>
        </form>
        <table align="center" border="3">

    </body>

    <?php
    if (isset($_GET["acao"])) {
        
        if($_GET["acao"]=="sair"){
        $_SESSION['logado'] = 0;
        ?>
        <script>
            document.location.href = "index.php";
        </script>
    <?php
    }}


if (isset($_POST['btnCadastrar'])) {
    $pessoa->setNome($_POST['nome']);
    $pessoa->setIdade($_POST['idade']);
    $pessoa->setEmail($_POST['email']);
    $pessoa->setSenha($_POST['senha']);

    if ($userDAO->cadastrar($pessoa)) {
        ?>
            <script type="text/javascript">
                alert("Cadastrado com sucesso.");
            </script>
        <?php
    } else {
        ?>
            <script type="text/javascript">
                alert("Pessoa não cadastrada.");
            </script>
        <?php
    }
}
if (isset($_POST['btnProcurar'])) {
    $email = strip_tags(trim($_POST['email']));
    if (empty($email)) {
        ?>
            <tr>
                <th>Nome</th>
                <th>Idade</th>
                <th>Email</th>
                <th>Ação</th>
            </tr>
        <?php
        foreach ($userDAO->consultar() as &$value) {
            ?>

                <tr>
                    <td><?php echo $value["nome"]; ?></td>
                    <td><?php echo $value["idade"]; ?></td>
                    <td><?php echo $value["email"]; ?></td>
                </tr>
            <?php
        }
    } else {
        ?>
            <tr>
                <th>Nome</th>
                <th>Idade</th>
                <th>Email</th>
                <th>Ação</th>
            </tr>
        <?php
        foreach ($userDAO->consulta($email) as &$value) {
            ?>
                <tr>
                    <td><?php echo $value["nome"]; ?></td>
                    <td><?php echo $value["idade"]; ?></td>
                    <td><?php echo $value["email"]; ?></td>
                </tr>
            <?php
        }
    }
}
?>
</html>