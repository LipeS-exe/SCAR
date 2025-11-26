<?php
// Se o usuário já estiver logado, manda para o painel
session_start();
if (isset($_SESSION['usuario_id'])) {
    header("Location: usuarios/painel.php");
    exit();
}

// Se não estiver logado, manda para o login
header("Location: login/login.php");
exit();
?>
