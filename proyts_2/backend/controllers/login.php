<?php
session_start();
include '../config/db.php';  

header('Content-Type: application/json');

// Evitar salida previa
if (ob_get_length()) ob_clean();

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['username']) || !isset($data['password'])) {
    echo json_encode(['success' => false, 'error' => 'Datos incompletos']);
    exit();
}

$username = trim($data['username']);
$password = trim($data['password']);

// Consultar la base de datos
$stmt = $pdo->prepare("SELECT usuario, contrasena, puesto FROM usuarios WHERE usuario = :username");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo json_encode(['success' => false, 'error' => 'Usuario no encontrado']);
    exit();
}

// Comparar contraseñas (sin hash)
if ($password == $user['contrasena']) {  
    $_SESSION['usuario'] = $user['usuario'];
    $_SESSION['rol'] = $user['puesto'];
    $_SESSION['puesto'] = $user['puesto'];

    echo json_encode(['success' => true, 'redirect' => '../../frontend/views/dashboard.php']);
} else {
    echo json_encode(['success' => false, 'error' => 'Credenciales inválidas']);
}

exit();
