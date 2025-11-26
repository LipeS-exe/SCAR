<?php
require '../../db.php';

$sql = "SELECT * FROM colaboradores ORDER BY id DESC";
$result = $conn->query($sql);

$dados = [];

while ($row = $result->fetch_assoc()) {
    $dados[] = $row;
}

echo json_encode($dados, JSON_UNESCAPED_UNICODE);
?>
