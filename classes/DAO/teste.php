<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once ("Conexao.php");
        $pdo = new Conexao();
        $qal = $pdo->connect();
        $qual = $qal->prepare("INSERT INTO pessoa (email) VALUES (email)");
        $qual->execute();
        echo ($qual->rowCount());

        echo 'tai';
        ?>
    </body>
</html>
