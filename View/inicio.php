<?php
session_start();
    include_once '../Controller/ProdutoController.php';
    include_once '../Db/database.php';


if(empty($_SESSION['id_usuario'])){
    echo "<script>window.alert('Você precisa estar logado para acessar esta página.');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

    $produtoController = new ProdutoController($pdo);
    $produtos = $produtoController->listarProdutos();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>
<body>
<header>
    <h1>Bem-vindo, <?php echo $_SESSION['nome']; ?>!</h1>
    <h2><?php echo $_SESSION['id_usuario']; ?></h2>
    <a href="editarusuario.php">Editar</a>
    <a href="sair.php">Sair</a>
    <a href="cadastroproduto.php">Cadastrar Produto</a>
</header>
<div class="aleta">
    <h2>Atenção</h2>
    <p>Produtos com estoque abaixo do mínimo serão destacados em vermelho.</p>
    <p>Produtos com estoque acima ou igual ao mínimo serão destacados em verde.</p>
    <?php
    foreach ($produtos as $produto) {
        if($produto['estoque'] < $produto['minimo']){
            echo "<h3 style='color: red;'>Produto: " . htmlspecialchars($produto['nome']) . " está abaixo do estoque mínimo!<h3/><a href='editarproduto.php?id=" . $produto['id'] . "'>Editar Produto</a><br>";
           
        }
    }

    ?>

</div>
<div class="content">
    <h2>Produtos Cadastrados</h2>
    <?php

    if (!empty($produtos)) {
        echo "<ul>";
        foreach ($produtos as $produto) {
            if($produto['estoque'] < $produto['minimo']){
                echo "<li style='color: red;'>";
                echo "<strong>Atenção: Estoque abaixo do mínimo!</strong><br>";
            } else {
                echo "<li style='color: green;'>";
            }
            echo "Nome: " . htmlspecialchars($produto['nome']) . "<br>";
            echo "Descrição: " . htmlspecialchars($produto['descricao']) . "<br>";
            echo "Quantidade Mínima: " . htmlspecialchars($produto['minimo']) . "<br>";
            echo "Quantidade em Estoque: " . htmlspecialchars($produto['estoque']) . "<br>";
            echo "<a href='editarproduto.php?id=" . $produto['id'] . "'>Editar Produto</a><br>";
            echo "</li><br>";
        }
        echo "</ul>";
    } else {
        echo "<p>Nenhum produto cadastrado.</p>";
    }
    ?>





</div>



</body>
</html>