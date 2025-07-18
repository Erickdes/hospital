<?php
include '../config/db.php';
//file_put_contents("../logs/debug.txt", print_r($_POST, true)); // Guardar los datos en un log
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Método no permitido - esperado POST, recibido ' . $_SERVER['REQUEST_METHOD']]);
    exit();
}

if (!isset($_POST['id'], $_POST['nombre_cirugia'], $_POST['id_medico'], $_POST['id_sala'], $_POST['fecha'])) {
    echo json_encode(['success' => false, 'error' => 'Datos incompletos', 'recibido' => $_POST]);
    exit();
}

header('Content-Type: application/json');

// Validar si los datos llegaron por POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
    exit();
}

// Validar que todos los campos existan
if (!isset($_POST['id'], $_POST['nombre_cirugia'], $_POST['id_medico'], $_POST['id_sala'], $_POST['fecha'])) {
    echo json_encode(['success' => false, 'error' => 'Datos incompletos']);
    exit();
}

// Asignar valores
$id = $_POST['id'];
$nombre_cirugia = $_POST['nombre_cirugia'];
$id_medico = $_POST['id_medico'];
$id_sala = $_POST['id_sala'];
$fecha = $_POST['fecha'];

try {
    $stmt = $pdo->prepare("UPDATE cirugias SET nombre_cirugia = ?, id_medico = ?, id_sala = ?, fecha = ? WHERE id = ?");
    $result = $stmt->execute([$nombre_cirugia, $id_medico, $id_sala, $fecha, $id]);

    echo json_encode(['success' => $result]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'Error en la base de datos: ' . $e->getMessage()]);
}
?>
