<?php
include '../../backend/config/db.php'; // Asegúrate de que la ruta sea correcta

// Verificar que la solicitud sea POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Método no permitido - esperado POST, recibido ' . $_SERVER['REQUEST_METHOD']]);
    exit();
}

// Obtener los datos de la cirugía desde la solicitud
$nombreCirugia = $_POST['nombre_cirugia'] ?? null;
$idMedico = $_POST['id_medico'] ?? null;
$idSala = $_POST['id_sala'] ?? null;
$fecha = $_POST['fecha'] ?? null;
$idJefePiso = $_POST['id_jefePiso'] ?? null;

// Validar que todos los datos sean correctos
if (!$nombreCirugia || !$idMedico || !$idSala || !$fecha || !$idJefePiso) {
    echo json_encode(['success' => false, 'error' => 'Faltan datos en la solicitud']);
    exit();
}

// Insertar la nueva cirugía en la base de datos
$stmt = $pdo->prepare("INSERT INTO cirugias (nombre_cirugia, id_medico, id_sala, fecha, id_jefePiso) VALUES (?, ?, ?, ?, ?)");
$stmt->execute([$nombreCirugia, $idMedico, $idSala, $fecha, $idJefePiso]);

// Responder con éxito
echo json_encode(['success' => true]);
?>
