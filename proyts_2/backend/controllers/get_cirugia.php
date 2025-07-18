<?php
include '../../backend/config/db.php';

$idCirugia = $_GET['id'] ?? null;

if (!$idCirugia) {
    echo json_encode(["error" => "ID de cirugía no recibido"]);
    exit;
}

$stmt = $pdo->prepare("SELECT nombre_cirugia, id_medico, id_sala, fecha FROM cirugias WHERE id = ?");
$stmt->execute([$idCirugia]);
$cirugia = $stmt->fetch(PDO::FETCH_ASSOC);

if ($cirugia) {
    echo json_encode($cirugia);
} else {
    echo json_encode(["error" => "Cirugía no encontrada"]);
}
?>
