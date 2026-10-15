<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuario</title>
</head>
<body>


<form action="index.php" method="POST">

<label for="nome">Nome:</label>
<input type="text" id="nome" name="nome" required><br><br>

<label for="email">Email:</label>
<input type="email" id="email" name="email" required><br><br>

<label for="senha">Senha:</label>
<input type="password" id="senha" name="senha" required><br><br>

<input type="submit" value="Cadastrar">
<a href="login.php">Já tem uma conta? Faça login aqui.</a>
</form>


</body>
</html>

<?php
include_once '../Db/database.php';
include_once '../Controller/UsuarioController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $usuarioController = new UsuarioController($pdo);
    $resultado = $usuarioController->cadastrarUsuario($nome, $email, $senha);

    if ($resultado) {
        echo "<script>window.alert('Usuário cadastrado com sucesso!');</script>";
        echo "<script>window.location.href='login.php';</script>";                  
    } else {
        echo "<script>window.alert('Email já cadastrado ou erro ao cadastrar usuário.');</script>";
    }
}
?>