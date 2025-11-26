<?php
require '../../db.php';

$rfid = $_POST['rfid'];
$nome = $_POST['nome'];
$especi = $_POST['especi'];
$turno = $_POST['turno'];

$sql = "INSERT INTO colaboradores (rfid, nome, especi, turno) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $rfid, $nome, $especi, $turno);

echo $stmt->execute() ? "ok" : "erro";
?>
