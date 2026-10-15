<?php
session_start();


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
</header>
</body>
</html>