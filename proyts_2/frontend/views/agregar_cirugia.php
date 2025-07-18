<?php
include '../../backend/config/db.php';

// Obtener lista de médicos
$medicos = [];
$stmt = $pdo->query("SELECT id, nombre FROM usuarios WHERE puesto = 'cirujano'");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $medicos[] = $row;
}

// Obtener lista de salas
$salas = [];
$stmt = $pdo->query("SELECT id, numero FROM salas");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $salas[] = $row;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Cirugía</title>
</head>
<body>

<h2>Agregar Nueva Cirugía</h2>

<form id="agregarCirugia">
    <label for="nombre_cirugia">Nombre de la Cirugía:</label>
    <input type="text" id="nombre_cirugia" name="nombre_cirugia" required>

    <label for="medico">Médico:</label>
    <select id="medico" name="medico" required>
        <?php foreach ($medicos as $medico): ?>
            <option value="<?= $medico['id'] ?>"><?= htmlspecialchars($medico['nombre']) ?></option>
        <?php endforeach; ?>
    </select>

    <label for="sala">Sala:</label>
    <select id="sala" name="sala" required>
        <?php foreach ($salas as $sala): ?>
            <option value="<?= $sala['id'] ?>"><?= htmlspecialchars($sala['numero']) ?></option>
        <?php endforeach; ?>
    </select>

    <label for="fecha">Fecha de la Cirugía:</label>
    <input type="date" id="fecha" name="fecha" required>

    <button type="submit">Agregar Cirugía</button>
</form>

<script src="../js/agregar_cirugia.js"></script>

</body>
</html>
