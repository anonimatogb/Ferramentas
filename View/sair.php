<?php

session_start();
if(empty($_SESSION['id_usuario'])){
    echo "<script>window.alert('Você precisa estar logado para acessar esta página.');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

session_destroy();

echo "<script>window.alert('Logout realizado com sucesso!');</script>";
echo "<script>window.location.href='login.php';</script>";
