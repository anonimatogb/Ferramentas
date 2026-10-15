<?php
require_once '../Model/UsuarioModel.php';

class UsuarioController {
    private $usuarioModel;

    public function __construct($pdo) {
        $this->usuarioModel = new UsuarioModel($pdo);
    }

    public function cadastrarUsuario($nome, $email, $senha) {
        return $this->usuarioModel->CadastrarUsuario($nome, $email, $senha);
    }

    public function login($email,$senha)
    {
      return $this->usuarioModel->login($email,$senha);
    }

    public function editar($nome, $email, $senha, $id) {
        return $this->usuarioModel->editar($nome, $email, $senha, $id);
    }








}

?>