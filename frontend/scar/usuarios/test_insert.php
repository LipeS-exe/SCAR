<?php
$conn = new mysqli("localhost", "root", "", "scar");

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$titulo = "Teste rápido";
$descricao = "Inserção de teste";
$usuario_id = 1;

$sql = "INSERT INTO chamados (titulo, descricao, usuario_id)
        VALUES ('$titulo', '$descricao', '$usuario_id')";

if ($conn->query($sql) === TRUE) {
    echo "OK! Inserido.";
} else {
    echo "Erro: " . $conn->error;
}

$conn->close();
?>
