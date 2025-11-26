<?php
session_start();

// Bloqueia acesso sem login
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login/login.php");
    exit();
}

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ../login/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - SCAR</title>

    <!-- CSS dentro da própria pasta usuarios -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Ícone -->
    <link rel="shortcut icon" href="../login/img/Scar.png" type="image/x-icon">

    <!-- Ícones Flaticon -->
    <link rel='stylesheet'
          href='https://cdn-uicons.flaticon.com/3.0.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
</head>

<body page="lista">

    <!-- CABEÇALHO -->
    <div class="container-head">
        <img src="../login/img/Scar.png" alt="">
        <h2>SCAR</h2>

        <p style="color:white; margin-left:10px;">
            Logado como <strong><?= $_SESSION['usuario'] ?></strong>
        </p>
    </div>

    <!-- LISTA -->
    <div id="listaRegistros">

        <div class="container-cabecalho">

            <div class="f-pesquisa">
                <input placeholder="PESQUISAR" autofocus id="inputPesquisa" class="inputPesquisa">
            </div>

            <div class="user-menu">
                <div class="user" onclick="toggleMenu()">
                    <i class="fi fi-rr-user" id="user"></i>
                </div>

                <ul class="menu">
                    <li><a href="#">Perfil</a></li>
                    <li><a href="#">Configurações</a></li>
                    <li><a href="painel.php?logout=1">Sair</a></li>
                </ul>
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>RFID</th>
                        <th>Nome</th>
                        <th>Especialização</th>
                        <th>Turno</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="listaRegistrosBody">
                    <!-- Carregado pelo script.js -->
                </tbody>
            </table>
        </div>

        <div class="botao-adicionar">
            <button onclick="visualizar('cadastro', true)">Adicionar</button>
        </div>

    </div>

    <!-- FORMULÁRIO DE CADASTRO / EDITAR -->
    <form id="cadastroRegistros">

        <!-- ❗ Necessário para edição funcionar -->
        <input type="hidden" id="id_edit">

        <div class="input-rfid">
            <h2>RFID</h2>
            <input type="text" id="rfid" placeholder="RFID do Colaborador">
        </div>

        <div class="input-Nome">
            <h2>Nome</h2>
            <input type="text" id="nome" placeholder="Nome do Colaborador">
        </div>

        <div class="input-especializacao">
            <h2>Especialização</h2>
            <select id="especi">
                <option value="Segurança">Segurança</option>
                <option value="Secretaria">Secretário(a)</option>
                <option value="Recepcionista">Recepcionista</option>
                <option value="Médico">Médico(a)</option>
                <option value="Cirurgião">Cirurgião</option>
                <option value="Visitante">Visitante</option>
            </select>
        </div>

        <div class="input-turno">
            <h2>Turno</h2>
            <select id="turno">
                <option value="Manhã">Manhã</option>
                <option value="Tarde">Tarde</option>
                <option value="Noite">Noite</option>
            </select>
        </div>

        <div class="buttons">
            <button type="button" onclick="salvarRegistro()">Cadastrar</button>
            <button type="button" onclick="visualizar('lista')" class="botao-cancelar">Cancelar</button>
        </div>

    </form>

    <!-- JS dentro da pasta usuarios -->
    <script src="script.js"></script>

</body>
</html>
