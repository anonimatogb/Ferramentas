<?php
include_once '../Db/database.php';

class ProdutosModel
{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function cadastrarProduto($nome, $descricao, $minimo, $estoque)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO produtos (nome, descricao, minimo, estoque) VALUES (:nome, :descricao, :minimo, :estoque)");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':minimo', $minimo);
            $stmt->bindParam(':estoque', $estoque);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao cadastrar produto: " . $e->getMessage();
            return false;
        }
    }

    public function listarProdutos()
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM produtos");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao listar produtos: " . $e->getMessage();
            return false;
        }
    }



    public function editarProduto($id, $nome, $descricao, $minimo, $estoque)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE produtos SET nome = COALESCE(:nome, nome), descricao = COALESCE(:descricao, descricao), minimo = COALESCE(:minimo, minimo), estoque = COALESCE(:estoque, estoque) WHERE id = :id");

            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':minimo', $minimo);
            $stmt->bindParam(':estoque', $estoque);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();

        } catch (PDOException $e) {
            echo "Erro ao editar produto: " . $e->getMessage();
            return false;
        }
    }


    public function buscaPalavraChave($palavra) {
    try {
        $stmt = $this->pdo->prepare("
            SELECT * FROM produtos
            WHERE nome LIKE :nome
               OR descricao LIKE :descricao
        ");

        $stmt->execute([
            ':nome' => "%$palavra%",
            ':descricao' => "%$palavra%"
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        echo "Erro ao procurar produtos: " . $e->getMessage();
        return false;
    }
}
}
