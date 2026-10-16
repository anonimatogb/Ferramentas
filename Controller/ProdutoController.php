<?php
require_once '../Model/ProdutoModel.php';

class ProdutoController {
    private $produtoModel;

    public function __construct($pdo) {
        $this->produtoModel = new ProdutosModel($pdo);
    }

    public function cadastrarProduto($nome, $descricao,$minimo,$estoque) {
        return $this->produtoModel->cadastrarProduto($nome, $descricao,$minimo,$estoque);
    }

    public function listarProdutos() {
        return $this->produtoModel->listarProdutos();
    }

    public function editarProduto($id, $nome, $descricao, $minimo, $estoque) {
        return $this->produtoModel->editarProduto($id, $nome, $descricao, $minimo, $estoque);
    }

public function buscarPalavraChave($palavra){
    return $this->produtoModel->buscaPalavraChave($palavra);
}






}

?>