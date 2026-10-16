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

public function deletar($id){
    return $this->produtoModel->deletar($id);
}

public function procurando($id){
    return $this->produtoModel->procurando($id);
}

public function menosum($id,$quantidade){
    return $this->produtoModel->menosum($id,$quantidade);
}
public function maisum($id,$quantidade){
    return $this->produtoModel->maisum($id,$quantidade);
}

}

?>