<?php
include_once '../Db/database.php';

class MovimentacaoModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function movimento($id_usuario, $id_produto, $quantidade, $tipo)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO movimentacao (id_usuario, id_produto, quantidade, tipo, horas) VALUES (:id_usuario, :id_produto, :quantidade, :tipo, now())");
            $stmt->bindParam(':id_usuario', $id_usuario);
            $stmt->bindParam(':id_produto', $id_produto);
            $stmt->bindParam(':quantidade', $quantidade);
            $stmt->bindParam(':tipo', $tipo);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao cadastrar produto: " . $e->getMessage();
            return false;
        }
    }

    public function listarMovimentos()
    {
        try {
            $stmt = $this->pdo->prepare("SELECT
    movimentacao.id,
    usuarios.nome AS nome_usuario,
    produtos.nome AS nome_produto,
    movimentacao.tipo,
    movimentacao.quantidade,
    movimentacao.horas
FROM movimentacao
INNER JOIN usuarios
    ON movimentacao.id_usuario = usuarios.id
INNER JOIN produtos
    ON movimentacao.id_produto = produtos.id;");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao listar movimentos: " . $e->getMessage();
            return false;
        }
    }
}
