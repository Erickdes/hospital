<?php
session_start();

// Verifica si ya hay una sesión activa (el usuario ya ha iniciado sesión)
if (isset($_SESSION['usuario'])) {
    header('Location: frontend/views/dashboard.php'); // Redirige al dashboard si está logueado
    exit();
} else {
    header('Location: frontend/views/login.html'); // Si no está logueado, redirige al login
    exit();
}
?>
