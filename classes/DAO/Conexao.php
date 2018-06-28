<?php

class Conexao {

    public $pdo;

    public function connect() {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=cadastro', 'root', '');
        } catch (PDOException $e) {
            var_dump($e);
        }
        return $pdo;
    }

}
