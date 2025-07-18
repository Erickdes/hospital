<?php
include '../config/db.php'; // Conectar a la base de datos

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id'])) {
    $id = $data['id'];

    try {
        $stmt = $pdo->prepare("UPDATE cirugias SET fecha = '0001-01-01' WHERE id = ?");
        $stmt->execute([$id]);

        echo json_encode(["success" => true]);
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "error" => "ID no proporcionado"]);
}
?>
