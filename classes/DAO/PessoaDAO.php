<?php
require_once ("Conexao.php");

class PessoaDAO {
    
        function __construct() {
        $this->con = new Conexao();
        $this->pdo = $this->con->Connect();
    }
    public function cadastrar(pessoa $entPessoa) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO pessoa (NOME,IDADE,EMAIL,SENHA)VALUES ( :nome,:idade, :email,:senha )");
            $param = array(
                ":nome" => $entPessoa->getNome(),
                ":idade" => $entPessoa->getIdade(),
                ":email" => $entPessoa->getEmail(),
                ":senha" => $entPessoa->getSenha()
            );
            foreach ($param as $key => $value) {
                $stmt->bindValue($key,$value);
            }
            return $stmt->execute($param);
            
        } catch (PDOException $ex) {

            var_dump($ex);
        }
    }
    public function consultar(){
        
        $stmt= $this->pdo->prepare("SELECT * FROM pessoa");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);;
        return $result;        
    }
    
    
        public function consulta($email){
        
        $stmt= $this->pdo->prepare("SELECT * FROM pessoa where email=:email");
        $stmt->bindValue(":email",$email);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);;
        return $result;        
    }
    public function login($email,$senha){
        
        $stmt= $this->pdo->prepare("SELECT * FROM pessoa where email=:email and senha=:senha");
        $stmt->bindValue(":email",$email);
        $stmt->bindValue(":senha",$senha);
        $stmt->execute();
        return $stmt->rowCount();        
    }
    public function deletar($email) {
        $stmt= $this->pdo->prepare("SELECT * FROM pessoa where email=:email");
        $stmt->bindValue(":email",$email);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
        $stmt= $this->pdo->prepare("DELETE FROM pessoa where email=:email");
        $stmt->bindValue(":email",$email);
        $stmt->execute();
        $dell=$stmt->rowCount();
        return $dell;
        }

    }

}
