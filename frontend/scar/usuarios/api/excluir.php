<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require "../../db.php";

if (!isset($_POST['id'])) {
    echo json_encode(["status" => "erro", "msg" => "ID não informado"]);
    exit;
}

$id = $_POST['id'];

$sql = "DELETE FROM colaboradores WHERE id=?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(["status" => "erro", "msg" => "Erro na query: " . $conn->error]);
    exit;
}

$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();
$conn->close();

echo json_encode(["status" => "ok"]);
exit;
