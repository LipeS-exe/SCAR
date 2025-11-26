<?php
require_once "../../db.php";

$rfid = $_POST['rfid'] ?? '';
$nome = $_POST['nome'] ?? '';
$especi = $_POST['especi'] ?? '';
$turno = $_POST['turno'] ?? '';

// Verifica se já existe
$sqlCheck = $conn->prepare("SELECT * FROM tecnicos WHERE rfid = ?");
$sqlCheck->bind_param("s", $rfid);
$sqlCheck->execute();
$result = $sqlCheck->get_result();

if ($result->num_rows > 0) {
    // UPDATE
    $sql = $conn->prepare("UPDATE tecnicos SET nome=?, especi=?, turno=? WHERE rfid=?");
    $sql->bind_param("ssss", $nome, $especi, $turno, $rfid);
    $sql->execute();

    echo json_encode(["status" => "update_ok"]);
} else {
    // INSERT
    $sql = $conn->prepare("INSERT INTO tecnicos (rfid, nome, especi, turno) VALUES (?, ?, ?, ?)");
    $sql->bind_param("ssss", $rfid, $nome, $especi, $turno);
    $sql->execute();

    echo json_encode(["status" => "insert_ok"]);
}

$conn->close();
?>
