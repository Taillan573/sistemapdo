<?php
session_start();
require_once("classes/DAO/PessoaDAO.php");
//require_once("classes/Entidade/pessoa.php");
$userDAO = new pessoaDAO();
//$pessoa = new pessoa();
if ($_SESSION['logado'] == 1) {
    $display = "none;";
    $displa = "inline;";
    ?>
    <script>
        document.location.href = "cadastro.php";
    </script>
    <?php
} else {
    $display = "inline;";
    $displa = "none;";
}
?>
<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="stylesheet" type="text/css" href="css/estilo.css">

        <!-- Bootstrap core CSS -->
        <link href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="https://getbootstrap.com/docs/4.1/examples/sign-in/signin.css" rel="stylesheet">

        <title>Login</title>

    </head>

    <body class="text-center">
        <form method="post" class="form-signin">
            <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Bem vindo!</h1>
            <label for="inputEmail" class="sr-only">Email: </label>
            <input type="text" name="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
            <label for="inputPassword" class="sr-only">Senha:</label>
            <input type="password" name="senha" id="inputPassword" class="form-control" placeholder="Senha" required>
            <div class="checkbox mb-3">
                <a href="cadastro.php" style="text-decoration: underline;">Cadastre-se</a>
            </div>
            <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Sign in</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
        </form>
    </body>
</html>
<?php
if (isset($_POST['login'])) {
    $email = ($_POST['email']);
    $senha = ($_POST['senha']);

    if ($userDAO->login($email, $senha) == 1) {

        $_SESSION['logado'] = 1;
        ?>
        <script>
            document.location.href = "cadastro.php";
        </script>
        <?php
    } else {
        ?>
        <script type="text/javascript">
            alert("não cadastrada.");
        </script>
        <?php
    }
}