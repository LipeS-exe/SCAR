<?php
require '../../db.php';

$id = $_POST['id'];

$sql = "DELETE FROM colaboradores WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

echo $stmt->execute() ? "ok" : "erro";
?>
