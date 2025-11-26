<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require "../../db.php";

$result = $conn->query("SELECT * FROM colaboradores ORDER BY id DESC");

$colaboradores = [];
while ($row = $result->fetch_assoc()) {
    $colaboradores[] = $row;
}

$conn->close();

echo json_encode($colaboradores);
exit;
