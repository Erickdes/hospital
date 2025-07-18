<?php
header('Content-Type: application/json');
require '../config/db.php';

$query = $pdo->query("SELECT id, numero FROM salas");
$salas = $query->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($salas);
?>
