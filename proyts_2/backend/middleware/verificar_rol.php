<?php
include '../middleware/verificar_sesion.php';
function verificarRol($roles = []) {
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header('Location: /frontend/views/login.html');
        exit();
    }
    
    if (!in_array($_SESSION['rol'], $roles)) {
        header('Location: /frontend/views/dashboard_' . $_SESSION['rol'] . '.php');
        exit();
    }
}
?>
