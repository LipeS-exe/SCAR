<?php
require '../../db.php';

$id = $_POST['id'];
$rfid = $_POST['rfid'];
$nome = $_POST['nome'];
$especi = $_POST['especi'];
$turno = $_POST['turno'];

$sql = "UPDATE colaboradores SET rfid=?, nome=?, especi=?, turno=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $rfid, $nome, $especi, $turno, $id);

echo $stmt->execute() ? "ok" : "erro";
?>
