<?php
include '../../backend/config/db.php'; // Asegúrate de que la ruta sea correcta

// Verificar que la solicitud sea POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Método no permitido - esperado POST, recibido ' . $_SERVER['REQUEST_METHOD']]);
    exit();
}

// Obtener los datos de la cirugía desde la solicitud
$idCirugia = $_POST['id'] ?? null;
$nombreCirugia = $_POST['nombre_cirugia'] ?? null;
$idMedico = $_POST['id_medico'] ?? null;
$idSala = $_POST['id_sala'] ?? null;
$fecha = $_POST['fecha'] ?? null;

// Validar que todos los datos sean correctos
if (!$idCirugia || !$nombreCirugia || !$idMedico || !$idSala || !$fecha) {
    echo json_encode(['success' => false, 'error' => 'Faltan datos en la solicitud']);
    exit();
}

// Actualizar la cirugía en la base de datos
$stmt = $pdo->prepare("UPDATE cirugias SET nombre_cirugia = ?, id_medico = ?, id_sala = ?, fecha = ? WHERE id = ?");
$stmt->execute([$nombreCirugia, $idMedico, $idSala, $fecha, $idCirugia]);

// Responder con éxito
echo json_encode(['success' => true]);
?>
