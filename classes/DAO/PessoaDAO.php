<?php

require_once ("Conexao.php");

class PessoaDAO {

    function __construct() {
        $this->con = new Conexao();
        $this->pdo = $this->con->Connect();
    }

    public function cadastrar(pessoa $entPessoa) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO pessoa (NOME,IDADE,EMAIL,SENHA,FOTO)VALUES ( :nome,:idade, :email,:senha,:foto )");
            $param = array(
                ":nome" => $entPessoa->getNome(),
                ":idade" => $entPessoa->getIdade(),
                ":email" => $entPessoa->getEmail(),
                ":senha" => $entPessoa->getSenha(),
                ":foto" => $entPessoa->getFoto()
            );
            foreach ($param as $key => $value) {
                $stmt->bindValue($key, $value);
            }
            $stmt->execute($param);
            if (empty($entPessoa->getFoto())) {
                
            }else{
            $ultimo_id = $this->pdo->lastInsertId();

            $diretorio = 'fotos/' . $ultimo_id . '/';
            mkdir($diretorio);

            move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio . $entPessoa->getFoto());
        }
            return $stmt->rowCount();
        } catch (PDOException $ex) {

            var_dump($ex);
        }
    }

    public function consultar() {

        $stmt = $this->pdo->prepare("SELECT * FROM pessoa");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ;
        return $result;
    }

    public function consulta($email) {

        $stmt = $this->pdo->prepare("SELECT * FROM pessoa where email=:email");
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ;
        return $result;
    }

    public function login($email, $senha) {

        $stmt = $this->pdo->prepare("SELECT * FROM pessoa where email=:email and senha=:senha");
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":senha", $senha);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function deletar($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM pessoa where email=:email");
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $key ) {
            
        };
        $id=$key["id"];
        $foto=$key["foto"];
        if ($stmt->rowCount() > 0) {
            $diretorio = 'fotos/'.$id.'/';
            unlink($diretorio.$foto);
            rmdir($diretorio);
            $stmt = $this->pdo->prepare("DELETE FROM pessoa where email=:email");
            $stmt->bindValue(":email", $email);
            $stmt->execute();

            $dell = $stmt->rowCount();
            return $dell;
        }
    }

}
