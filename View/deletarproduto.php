<?php

session_start();
include_once '../Controller/ProdutoController.php';
include_once '../DB/database.php';
if(empty($_SESSION['id_usuario'])){
    echo "<script>window.alert('Você precisa estar logado para acessar esta página.');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

        $id = $_GET['id'];
    $produtoController = new ProdutoController($pdo);
    $resultado = $produtoController->deletar($id);
if ($resultado) {
        echo "<script>window.alert('Produto deletado com sucesso!');</script>";
        echo "<script>window.location.href='inicio.php';</script>";
        } else {
            echo "<script>window.alert('Erro ao deletar produto.');</script>";
            echo "<script>window.location.href='inicio.php';</script>";
    }
        

