<?php
session_start();
include_once '../Db/database.php';
include_once '../Controller/UsuarioController.php';

if (!isset($_SESSION['id_usuario'])) {
    echo "<script>window.alert('Você precisa estar logado para editar o usuário.');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Recupera os dados atuais da sessão ou do formulário
    $nome = !empty($_POST['nome'])
        ? trim($_POST['nome'])
        : null;

    $email = !empty($_POST['email'])
        ? trim($_POST['email'])
        : null;

    // Senha vazia significa manter a senha atual
    $senha = !empty($_POST['senha'])
        ? $_POST['senha']
        : null;

    $id = $_SESSION['id_usuario'];

    
    $usuarioController = new UsuarioController($pdo);
    $resultado = $usuarioController->editar($nome, $email, $senha, $id);
    
    if($nome == null && $email == null && $senha==null){
echo "<script>window.alert('Insira ao menos um registro para edita-lo')</script>";
}elseif ($resultado) {
        
 if (!empty($nome)) {
            $_SESSION['nome'] = $nome;
        }
        if (!empty($email)) {
            $_SESSION['email'] = $email;
        }
echo "<script>window.alert('Usuário editado com sucesso!');</script>";
        echo "<script>window.location.href='inicio.php';</script>";
    } else {
        echo "<script>window.alert('Erro ao editar usuário.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
</head>

<body>
    <header>
        <h1>Bem-vindo, <?php $_SESSION['nome']  ?>!</h1>
        <a href="inicio.php">Inicio</a>
        <a href="editarusuario.php">Editar</a>
        <a href="cadastroproduto.php">Cadastrar Produto</a>
        <a href="movimentacao.php">Histórico Movimentações</a>
        <a href="sair.php">Sair</a>
    </header>

    <form action="editarusuario.php" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" placeholder="<?php echo $_SESSION['nome']; ?>">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="<?php echo $_SESSION['email']; ?>">
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" placeholder="Senha nova">
        <button type="submit">Editar</button>
        <a href="inicio.php">Voltar
        </a>
    </form>



</body>

</html>