<?php include '../../backend/config/db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Cirugías</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h2>Lista de Cirugías</h2>
    <!-- Mensaje de error o vacío si no se encuentran cirugías -->
    <div id="noCirugias" style="display: none; color: red;">
        No se han encontrado cirugías registradas.
    </div>
    <table border="1">
        <thead>
            <tr>
                <th>Cirugía</th>
                <th>Médico</th>
                <th>Sala</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="tablaCirugias">
            <!-- Aquí se cargarán las filas dinámicamente con JavaScript -->
        </tbody>
    </table>

    <script src="../js/dashboard.js"></script>

    <!-- Modal para modificar cirugía -->
<div id="modalModificarCirugia" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="cerrarModal()">&times;</span>
        <h2>Modificar Cirugía</h2>
        <form id="formModificarCirugia">
            <input type="hidden" id="idCirugia" name="id">
            
            <label for="cirugia">Nombre de la cirugía:</label>
            <input type="text" id="cirugia" name="nombre_cirugia" required>
            
            <label for="medico">Médico:</label>
            <select id="medico" name="id_medico" required></select>
            
            <label for="sala">Sala:</label>
            <select id="sala" name="id_sala" required></select>
            
            <label for="fecha">Fecha:</label>
            <input type="text" id="fecha" name="fecha" disabled>
            <p id="mensajeFecha" style="display: none; color: red;">Campo no editable</p>
            
            <button type="submit">Guardar cambios</button>
        </form>
    </div>
</div>

</body>
</html>
