<?php
require_once '../Model/MovimentacaoModel.php';

class MovimentacaoController{
private $movimentacaoModel;

    public function __construct($pdo) {
        $this->movimentacaoModel = new MovimentacaoModel($pdo);
    }

    public function movimento($id_usuario,$id_produto,$quantidade){
return $this->movimentacaoModel->movimento($id_usuario,$id_produto,$quantidade);

    }


}