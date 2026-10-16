<?php
session_start();
include_once '../Controller/MovimentacaoController.php';
include_once '../Db/database.php';

if (empty($_SESSION['id_usuario'])) {
    echo "<script>window.alert('Você precisa estar logado para acessar esta página.');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

$movimentacaoController = new MovimentacaoController($pdo);
$movimentos = $movimentacaoController->listarMovimentos();
echo" <header>
        <h1>Bem-vindo, ". $_SESSION['nome'] ."!</h1>
        <a href='inicio.php'>Inicio</a>
        <a href='editarusuario.php'>Editar</a>
        <a href='cadastroproduto.php'>Cadastrar Produto</a>
        <a href='movimentacao.php'>Histórico Movimentações</a>
        <a href='sair.php'>Sair</a>
    </header>";

foreach ($movimentos as $movimento) {
    if($movimento['tipo'] == 'saida'){
           
                echo "<table border='1' cellpadding='5' cellspacing='1'>";
                echo "<tr>";
                echo "<td style='color: red;'>Usuário: " . htmlspecialchars($movimento['nome_usuario']) . " <td/>";
                echo "<td style='color: red;'>Produto: " . htmlspecialchars($movimento['nome_produto']) . " <td/>";
                echo "<td style='color: red;'>Quantidade: " . htmlspecialchars($movimento['quantidade']) . " <td/>";
                echo "<td style='color: red;'>tipo: " . htmlspecialchars($movimento['tipo']) . " <td/>";
                echo "<td style='color: red;'>Data: " . date('d/m/Y H:i:s', strtotime($movimento['horas'])) . "<td/>
                ";
                
                }else{
echo "<table border='1' cellpadding='5' cellspacing='1'>";
                echo "<tr>";
                echo "<td style='color: green;'>Usuário: " . htmlspecialchars($movimento['nome_usuario']) . " <td/>";
                echo "<td style='color: green;'>Produto: " . htmlspecialchars($movimento['nome_produto']) . " <td/>";
                echo "<td style='color: green;'>Quantidade: " . htmlspecialchars($movimento['quantidade']) . " <td/>";
                echo "<td style='color: green;'>tipo: " . htmlspecialchars($movimento['tipo']) . " <td/>";
                echo "<td style='color: green;'>Data: " . htmlspecialchars($movimento['horas']) . "<td/>
                ";
                }
                echo "</tr>";
                echo "</table>";
    
                }
?>

