<?php
include_once '../Db/database.php';

class UsuarioModel{

private $pdo;

public function __construct($pdo){
    $this->pdo = $pdo;
}

public function CadastrarUsuario($nome, $email, $senha){
    try {
        $stmt = $this->pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        return $stmt->execute();
    } catch (PDOException $e) {
        echo "Erro ao cadastrar usuário: " . $e->getMessage();
        return false;
    }
}

public function login($email,$senha){
    
    try {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erro ao realizar login: " . $e->getMessage();
        return false;
    }
}

public function editar($nome, $email, $senha, $id){
    try {
        if ($senha !== null) {
            $stmt = $this->pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email, senha = :senha WHERE id = :id");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);
            $stmt->bindParam(':id', $id);
        } else {
            $stmt = $this->pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':id', $id);
        }
        return $stmt->execute();
    } catch (PDOException $e) {
        echo "Erro ao editar usuário: " . $e->getMessage();
        return false;
    }
}







}

?>