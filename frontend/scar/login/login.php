<?php
session_start();
require '../db.php'; // conexão

// Se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $login = $_POST['login'];
    $senha = $_POST['senha'];

    // Busca usuário no banco
    $sql = "SELECT * FROM usuarios WHERE login = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verifica senha MD5
        if ($user['senha'] === md5($senha)) {

            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['usuario'] = $user['nome'];

            header("Location: ../usuarios/painel.php");
            exit;
        } else {
            $erro = "Senha incorreta!";
        }
    } else {
        $erro = "Usuário não encontrado!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Scar</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/Scar.png" type="image/x-icon">
</head>

<body>
    <div class="container">
        <div class="main">
            <h1>LOGIN</h1>
            <p>Inserir suas informações</p>

            <form method="POST">

                <div class="grupo-nome">
                    <input required type="text" name="login" id="login">
                    <label for="login">USUARIO</label>
                </div>

                <div class="grupo-pass">
                    <input required type="password" name="senha" id="senha">
                    <label for="senha">SENHA</label>
                </div>

                <p class="mensagem">
                    <?php if (isset($erro)) echo "<span style='color:red;'>$erro</span>"; ?>
                </p>

                <button class="entrar" type="submit">LOGAR</button>

            </form>
        </div>

        <div class="scar">
            <img src="img/Scar.png" alt=" logo scar">
            <p>SCAR</p>
        </div>
    </div>
</body>
</html>
