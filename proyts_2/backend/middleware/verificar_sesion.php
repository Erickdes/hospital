<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../frontend/views/login.html");
    exit();
}
