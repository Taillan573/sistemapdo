<?php

class pessoa {
    
    private $id;
    private $nome;
    private $idade;
    private $email;
    private $senha;
    
    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

        function getNome() {
        return $this->nome;
    }

    function getIdade() {
        return $this->idade;
    }

    function getEmail() {
        return $this->email;
    }

    function getSenha() {
        return $this->senha;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setIdade($idade) {
        $this->idade = $idade;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }


}
