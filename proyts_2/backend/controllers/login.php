<?php

session_start();
include '../config/db.php';  

header('Content-Type: application/json');

// Evitar salida previa
if (ob_get_length()) ob_clean();

$data = json_decode(file_get_contents('php://input'), true);

// Validar datos de entrada
if (!isset($data['username']) || !isset($data['password'])) {
    echo json_encode(['success' => false, 'error' => 'Datos incompletos']);
    exit();
}

$username = trim($data['username']);
$password = trim($data['password']);

// Verificar qué se está recibiendo
error_log("Usuario recibido: " . $username);
error_log("Contraseña recibida: " . $password);

// Consultar la base de datos para obtener el usuario
$stmt = $pdo->prepare("SELECT usuario, contrasena, puesto FROM usuarios WHERE usuario = :username");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo json_encode(['success' => false, 'error' => 'Usuario no encontrado']);
    exit();
}

// Mostrar la contraseña hasheada almacenada en la base de datos
error_log("Contraseña almacenada en DB: " . $user['contrasena']);

// Verificar si la contraseña almacenada tiene el formato correcto
if (!preg_match('/^\$2[ayb]\$/', $user['contrasena'])) {
    error_log("ERROR: La contraseña en la base de datos no parece estar hasheada correctamente.");
    echo json_encode(['success' => false, 'error' => 'Error en el almacenamiento de la contraseña']);
    exit();
}

// Intentar verificar la contraseña
if (password_verify($password, $user['contrasena'])) {  
    error_log("Resultado password_verify: TRUE");
    error_log("La contraseña es correcta. Iniciando sesión...");
    
    // Iniciar la sesión con los datos del usuario
    $_SESSION['usuario'] = $user['usuario'];
    $_SESSION['rol'] = $user['puesto'];
    $_SESSION['puesto'] = $user['puesto'];

    echo json_encode(['success' => true, 'redirect' => '../../frontend/views/dashboard.php']);
} else {
    error_log("ERROR: La contraseña no coincide.");
    echo json_encode(['success' => false, 'error' => 'Credenciales inválidas']);
}

exit();
