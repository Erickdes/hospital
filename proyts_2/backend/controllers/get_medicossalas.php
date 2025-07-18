<?php
header('Content-Type: application/json');  // Especificar que la respuesta es JSON
include '../config/db.php';

// Desactivar la salida de errores al cliente
//error_reporting(0);  // Desactiva la visualización de errores
//ini_set('display_errors', 0);

// Consulta las cirugías
try {
    $stmt = $pdo->query("SELECT c.id, c.nombre_cirugia, u.nombre AS medico, s.numero AS sala, c.fecha 
                         FROM cirugias c
                         JOIN usuarios u ON c.id_medico = u.id
                         JOIN salas s ON c.id_sala = s.id");

    $cirugias = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Verificar si se obtuvo algún resultado
    if (empty($cirugias)) {
        echo json_encode(['error' => 'No se encontraron cirugías.']);
    } else {
        echo json_encode($cirugias);
    }

} catch (PDOException $e) {
    // Manejo de errores en caso de fallos con la consulta
    echo json_encode(['error' => 'Error al obtener cirugías: ' . $e->getMessage()]);
}
?>
