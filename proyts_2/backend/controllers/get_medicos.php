<?php
header('Content-Type: application/json');
require '../config/db.php';

$query = $pdo->query("SELECT id, nombre FROM usuarios");
$medicos = $query->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($medicos);
?>
