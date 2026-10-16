<?php 
include_once '../Db/database.php';

class MovimentacaoModel{
  private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

   public function movimento($id_usuario,$id_produto,$quantidade){
 try {
            $stmt = $this->pdo->prepare("INSERT INTO produtos (id_usuario, id_produto, quantidade, horas) VALUES (:id_usuario, :id_produto, :quantidade, now())");
            $stmt->bindParam(':id_usuario', $id_usuario);
            $stmt->bindParam(':id_produto', $id_produto);
            $stmt->bindParam(':quantidade', $quantidade);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao cadastrar produto: " . $e->getMessage();
            return false;
        }

   }








}