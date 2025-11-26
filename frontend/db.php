<?php
$host = "localhost";
$user = "root";
$pass = "1234";
$db   = "scar";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>
