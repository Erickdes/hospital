<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}

// include '../../backend/middleware/verificar_rol.php'; 
// verificarRol(['admin', 'medico']);  // Verifica que el usuario tenga el rol adecuado
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cirugías</title>
    <link rel="stylesheet" href="../../frontend/css/styles.css">
</head>
<body>
    <header>
        <h1>Bienvenido, <?php echo $_SESSION['usuario']; ?></h1>
        <p>Rol: <?php echo $_SESSION['rol']; ?></p>
    </header>

    <nav>
        <ul>
            <li><a href="./tabla_cirugias.php">Ver Cirugías</a></li>
            <?php if ($_SESSION['rol'] === 'admin') : ?>
                <li><a href="./agregar_cirugia.php">Agregar Cirugía</a></li>
            <?php endif; ?>
            <li><a href="../../backend/controllers/logout.php">Cerrar Sesión</a></li>
        </ul>
    </nav>

    <main>
        <section>
            <h2>Acciones disponibles</h2>
            <p>En este panel, podrás gestionar las cirugías. Según tu rol, podrás realizar distintas acciones.</p>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Hospital. Todos los derechos reservados.</p>
    </footer>

    <script src="../js/dashboard.js"></script>
</body>
</html>
