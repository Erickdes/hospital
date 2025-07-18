<?php
session_start();
include '../config/db.php';  // Asegúrate de que este archivo existe y tiene conexión válida

// Limpiar cualquier salida previa
ob_clean();
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['username']) || !isset($data['password'])) {
    echo json_encode(['success' => false, 'error' => 'Datos incompletos']);
    exit();
}

$username = $data['username'];
$password = $data['password'];

// Consultar la base de datos
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = :username");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Verifica si el usuario existe y la contraseña es correcta  DE DONDE CONTRASENA????
if ($user && $password === $user['contrasena']) {
    $_SESSION['usuario'] = $username;
    $_SESSION['rol'] = $user['puesto'];  

    echo json_encode(['success' => true, 'redirect' => '../../frontend/views/dashboard.php']);
} else {
    echo json_encode(['success' => false, 'error' => 'Credenciales inválidas']);
}

// Asegurar que no haya salida extra
exit();
?>
