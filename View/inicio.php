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
     if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $palavra = $_POST['palavra'];
        $palavras = $produtoController->buscarPalavraChave($palavra);
        }
   
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
            echo "<table border='1' cellpadding='5' cellspacing='1'>";
            echo "<tr>";
            echo "<td style='color: red;'>Produto: " . htmlspecialchars($produto['nome']) . " está abaixo do estoque mínimo!<td/>
            <td>";
            echo "<a href='editarproduto.php?id=" . $produto['id'] . "'>Editar Produto</a></td>";
            echo "<td><a href='deletarproduto.php?id=" . $produto['id'] . "'
onclick=\"return confirm('Tem certeza que deseja excluir este produto?')\">
Deletar Produto</a></td>";
            echo "</tr>";
            echo "</table>";
        }   
    }

    ?>

</div>
<div class="content">
    <h2>Produtos Cadastrados</h2>
   
    <?php
    
    echo "<form action='inicio.php' method='POST'>";
    echo "<input type='text' id='palavra' name='palavra'>";
    echo "<input type='submit' value='Pesquisar Produto'>";
    echo "<a href='inicio.php'>Limpar Pesquisa</a>";
    echo "</form>";
 
   if(!empty($palavras)){
        echo "<ul>";
        foreach ($palavras as $palavra) {
            if($palavra['estoque'] < $palavra['minimo']){
                echo "<li style='color: red;'>";
                echo "<strong>Atenção: Estoque abaixo do mínimo!</strong><br>";
            } else {
                echo "<li style='color: green;'>";
            }
            echo "Nome: " . htmlspecialchars($palavra['nome']) . "<br>";
            echo "Descrição: " . htmlspecialchars($palavra['descricao']) . "<br>";
            echo "Quantidade Mínima: " . htmlspecialchars($palavra['minimo']) . "<br>";
            echo "Quantidade em Estoque: " . htmlspecialchars($palavra['estoque']) . "<br>";
            echo "<a href='editarproduto.php?id=" . $palavra['id'] . "'>Editar Produto</a><br>";
            echo "<a href='deletarproduto.php?id=" . $produto['id'] . "'
onclick=\"return confirm('Tem certeza que deseja excluir este produto?')\">
Deletar Produto</a><br>";
            echo "</li><br>";
            }
            echo "</ul>";
            }
            if (!empty($produtos) && empty($palavras)) {
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
            echo "<a href='deletarproduto.php?id=" . $produto['id'] . "'
onclick=\"return confirm('Tem certeza que deseja excluir este produto?')\">
Deletar Produto</a><br>";
            echo "</li><br>";
        }
        echo "</ul>";
    } 
    if(empty($produtos) && empty($palavras)){
echo"Nenhum Produto Cadastrado";
    }

    
    ?>





</div>



</body>
</html>