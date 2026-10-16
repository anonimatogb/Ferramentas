<?php
session_start();
include_once '../Controller/ProdutoController.php';
include_once '../Db/database.php';

if(empty($_SESSION['id_usuario'])){
    echo "<script>window.alert('Você precisa estar logado para acessar esta página.');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $minimo = $_POST['minimo'];
    $estoque = $_POST['estoque'];

    $produtoController = new ProdutoController($pdo);
    $resultado = $produtoController->cadastrarProduto($nome, $descricao,$minimo,$estoque);

    if ($resultado) {
        echo "<script>window.alert('Produto cadastrado com sucesso!');</script>";
        echo "<script>window.location.href='inicio.php';</script>";                  
    } else {
        echo "<script>window.alert('Erro ao cadastrar produto.');</script>";
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
</head>
<body>
    <header>
        <h1>Bem-vindo, <?php $_SESSION['nome'] ?>!</h1>
        <a href="inicio.php">Inicio</a>
        <a href="editarusuario.php">Editar</a>
        <a href="cadastroproduto.php">Cadastrar Produto</a>
        <a href="movimentacao.php">Histórico Movimentações</a>
        <a href="sair.php">Sair</a>
    </header>
    <form action="cadastroproduto.php" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao" required><br><br>

        <label for="minimo">Quantidade Mínima:</label>
        <input type="number" id="minimo" name="minimo" min="1" required><br><br>

        <label for="estoque">Quantidade em Estoque:</label>
        <input type="number" id="estoque" name="estoque" min="1" required><br><br>

        <input type="submit" value="Cadastrar Produto">
        <a href="inicio.php">Voltar</a>
</body>
</html>