<?php

session_start();
session_destroy();

echo "<script>window.alert('Logout realizado com sucesso!');</script>";
echo "<script>window.location.href='login.php';</script>";