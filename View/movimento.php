<?php
session_start();
include_once '../Controller/MovimentacaoController.php';
include_once '../Controller/ProdutoController.php';
include_once '../Db/database.php';

if(empty($_SESSION['id_usuario'])){
    echo "<script>window.alert('Você precisa estar logado para acessar esta página.');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['tipo'];
    $id_produto = $_POST['id_produto'];
    $quantidade = $_POST['quantidade'];
   

    $movimentacaoController = new MovimentacaoController($pdo);
    $produtoController = new ProdutoController($pdo);

    if($tipo =='saida'){
        
    $produto = $produtoController->menosum($id_produto,$quantidade);
    }else{
        $produto = $produtoController->maisum($id_produto,$quantidade);
    }

    $resultado = $movimentacaoController->movimento($_SESSION['id_usuario'],$id_produto,$quantidade,$tipo);

    if ($resultado) {
        echo "<script>window.alert('Movimentação realizada com sucesso!');</script>";
        echo "<script>window.location.href='inicio.php';</script>";                  
    } else {
        echo "<script>window.alert('Erro ao movimentar produto.');</script>";
    }
}


