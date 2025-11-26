<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require "../../db.php";

if (!isset($_POST['rfid'], $_POST['nome'], $_POST['especi'], $_POST['turno'])) {
    echo json_encode(["status" => "erro", "msg" => "Faltando campos"]);
    exit;
}

$rfid = $_POST['rfid'];
$nome = $_POST['nome'];
$especi = $_POST['especi'];
$turno = $_POST['turno'];

$sql = "INSERT INTO colaboradores (rfid, nome, especi, turno) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(["status" => "erro", "msg" => "Erro na query: " . $conn->error]);
    exit;
}

$stmt->bind_param("ssss", $rfid, $nome, $especi, $turno);
$stmt->execute();
$stmt->close();
$conn->close();

echo json_encode(["status" => "ok"]);
exit;
