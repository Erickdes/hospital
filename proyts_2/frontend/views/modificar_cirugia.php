<?php
include '../../backend/config/db.php';

// Obtener lista de médicos
$medicos = [];
$stmt = $pdo->query("SELECT id, nombre FROM usuarios WHERE puesto = 'cirujano'"); // Solo los médicos
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $medicos[] = $row;
}
// Obtener lista de médicos
$jefesPiso = [];
$stmt = $pdo->query("SELECT id, nombre FROM usuarios WHERE puesto = 'jefe_piso'"); // Solo los médicos
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $jefesPiso[] = $row;
}

// Obtener lista de salas
$salas = [];
$stmt = $pdo->query("SELECT id, numero FROM salas"); // Obtener todas las salas
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $salas[] = $row;
}

// Obtener los datos de la cirugía
$idCirugia = $_GET['id'] ?? null;
$cirugia = null;

if ($idCirugia) {
    // Obtener los datos de la cirugía seleccionada
    $stmt = $pdo->prepare("SELECT nombre_cirugia, id_medico, id_sala, fecha, id_jefePiso FROM cirugias WHERE id = ?");
    $stmt->execute([$idCirugia]);
    $cirugia = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (!$cirugia) {
    echo "<p>Error: Cirugía no encontrada.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Cirugía</title>
</head>
<body>

<h2>Modificar Cirugía</h2>

<form id="modificarCirugia">
    <label for="cirugia">Nombre de la Cirugía:</label>
    <input type="text" id="cirugia" name="cirugia" value="<?= htmlspecialchars($cirugia['nombre_cirugia']) ?>" required>

    <label for="medico">Médico:</label>
    <select id="medico" name="medico" required>
        <?php foreach ($medicos as $medico): ?>
            <option value="<?= $medico['id'] ?>" <?= ($medico['id'] == $cirugia['id_medico']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($medico['nombre']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="sala">Sala:</label>
    <select id="sala" name="sala" required>
        <?php foreach ($salas as $sala): ?>
            <option value="<?= $sala['id'] ?>" <?= ($sala['id'] == $cirugia['id_sala']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($sala['numero']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="fecha">Fecha de la Cirugía:</label>
    <input type="text" id="fecha" name="fecha" value="<?= htmlspecialchars($cirugia['fecha']) ?>" readonly>
    <p style="color: red; font-size: 12px;">Campo no editable</p>

    <label for="jefePiso">Jefe:</label>
    <select id="jefePiso" name="jefePiso" required>
        <?php foreach ($jefesPiso as $jefePiso): ?>
            <option value="<?= $jefePiso['id'] ?>" <?= ($jefePiso['id'] == $cirugia['id_jefePiso']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($jefePiso['nombre']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Guardar Cambios</button>
</form>

<script src="../js/modificar_cirugia.js"></script>

</body>
</html>
