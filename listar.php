<?php
session_start();
require_once("classes/DAO/PessoaDAO.php");
require_once("classes/Entidade/pessoa.php");
$userDAO = new pessoaDAO();
$pessoa = new pessoa();

if ($_SESSION['logado'] != 1) {
    $display = "none;";
    $displa = "inline;";
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

            img{
                width: 110;
                height: 149;
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
                <a href="?acao=sair" class=" dispray btn-lg btn-primary " >Logout</a>
            </div>
        </nav>
        <div style="float: left;">
            <form method="post" name="frmCadastro" class="form-signin">
                <h1 class="h3 mb-3 font-weight-normal">Bem vindo!</h1>
                <label for="inputEmail" class="sr-only">Email: </label>
                <input type="text" id="inputEmail" name="email" class="form-control" placeholder="Email"  >
                <button name="btnProcurar" class="dispray" type="submit">Buscar</button>
            </form>
        </div>

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

        if (isset($_POST['btnProcurar'])) {
            $email = strip_tags(trim($_POST['email']));
            if (empty($email)) {
                ?>
                <?php
                foreach ($userDAO->consultar() as &$value) {
                    ?>
                     <div style="display: inline;">
                        <table align="center" border="3">
                            <tr>
                                <th>foto</th>
                                <td><?php
                                    $id = $value["id"];
                                    $foto = $value["foto"];
                                    echo( "<img width=\"110\" height=\"149\" src=\"fotos/$id/$foto\"/>");
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Ação</th>
                                <td><?php echo $value["nome"]; ?></td>
                            </tr><tr>

                            </tr>
                            <tr>
                                <th>Idade</th>
                                <td><?php echo $value["idade"]; ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?php echo $value["email"];
                                $id=$value["id"]; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                               <?php  echo "<a href=\"delete.php?id=$id\">Apagar</a>";?>

                               <?php  echo "<a href=\"update.php?id=$id\">Editar</a>";?>
                               </td>
                            </tr>
                    </div>
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
                <div style="display: inline;">
                    <table align="center" border="3">
                        <tr>
                            <th>foto</th>
                            <td><?php
                                $id = $value["id"];
                                $foto = $value["foto"];
                                echo( "<img src=\"fotos/$id/$foto\"/>");
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Ação</th>
                            <td><?php echo $value["nome"]; ?></td>
                        </tr><tr>

                        </tr>
                        <tr>
                            <th>Idade</th>
                            <td><?php echo $value["idade"]; ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo $value["email"]; ?></td>


                        </tr>
                </div>
                <?php
            }
        }
    }
    ?>

</body>
</html>