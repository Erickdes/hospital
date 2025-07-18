<?php
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Aquí debe validar y agregar la cirugía a la base de datos
    $cirugia = $_POST['cirugia'];
    $medico = $_POST['medico'];
    $sala = $_POST['sala'];

    $stmt = $pdo->prepare("INSERT INTO cirugias (cirugia, medico_id, sala_id) VALUES (?, ?, ?)");
    $stmt->execute([$cirugia, $medico, $sala]);

    echo json_encode(['success' => true]);
}
?>
