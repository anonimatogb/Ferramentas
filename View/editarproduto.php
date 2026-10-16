<?php
session_start();
if (empty($_SESSION['id_usuario'])) {
    echo "<script>window.alert('Você precisa estar logado para acessar esta página.');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}
include_once '../Controller/ProdutoController.php';
include_once '../Db/database.php';

$id = $_GET['id'];
$produtoController = new ProdutoController($pdo);
$produto = $produtoController->procurando($id);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = !empty($_POST['nome'])
        ? $_POST['nome']
        : null;

    $descricao = !empty($_POST['descricao'])
        ? $_POST['descricao']
        : null;

    $minimo = !empty($_POST['minimo'])
        ? $_POST['minimo']
        : null;

    $estoque = !empty($_POST['estoque'])
        ? $_POST['estoque']
        : null;



    $resultado = $produtoController->editarProduto($id, $nome, $descricao, $minimo, $estoque);

    if ($nome == null && $descricao == null && $minimo == null && $estoque == null) {
        echo "<script>window.alert('Insira ao menos um registro para edita-lo')</script>";
    } elseif ($resultado) {
        echo "<script>window.alert('Produto editado com sucesso!');</script>";
        echo "<script>window.location.href='inicio.php';</script>";
    } else {
        echo "<script>window.alert('Erro ao editar produto.');</script>";
    }
}




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de Produto</title>
</head>

<body>
    <form action="editarproduto.php?id=<?= $id ?>" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" placeholder="<?=  $produto['nome']  ?>"><br><br>

        <label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao" placeholder="<?=  $produto['descricao']  ?>"><br><br>

        <label for="minimo">Quantidade Mínima:</label>
        <input type="number" id="minimo" name="minimo" min="1" placeholder="<?=  $produto['minimo']  ?>"><br><br>

        <label for="estoque">Quantidade em Estoque:</label>
        <input type="number" id="estoque" name="estoque" min="1" placeholder="<?=  $produto['estoque']  ?>"><br><br>

        <input type="submit" value="Editar Produto">
        <a href="inicio.php">Voltar</a>




</body>

</html>