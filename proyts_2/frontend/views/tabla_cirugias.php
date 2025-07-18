<?php
include '../../backend/middleware/verificar_sesion.php';
session_start();
include '../../backend/config/db.php';

// Verificar si la clave 'puesto' está definida en la sesión
$puesto_usuario = isset($_SESSION['puesto']) ? $_SESSION['puesto'] : '';  // Valor por defecto vacío si no está definida
?>
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
                <th>Jefe de Piso</th> <!-- Nueva columna para el jefe de piso -->
                <?php if ($puesto_usuario == 'jefe_unidad' || $puesto_usuario == 'jefe_piso'): ?>
                    <th>Acciones</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody id="tablaCirugias">
            <!-- Aquí se cargarán las filas dinámicamente con JavaScript -->
        </tbody>
    </table>
    <nav>
        <ul>
            <li><a href="dashboard.php">Volver a la pagina principal</a></li>
        </ul>
    </nav>
    <script>
        // Definir la variable puestoUsuario antes de cargar dashboard.js
        const puestoUsuario = "<?php echo $puesto_usuario; ?>";
    </script>
    <script src="../js/dashboard.js"></script>


    <script>
        // Aseguramos que la variable 'puestoUsuario' no esté declarada antes


        document.addEventListener("DOMContentLoaded", function() {
            fetchCirugias();
        });

        function fetchCirugias() {
            fetch('../../backend/controllers/get_medicossalas.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.json();
                })
                .then(data => {
                    const tabla = document.getElementById("tablaCirugias");
                    const mensajeNoCirugias = document.getElementById('noCirugias');

                    if (!tabla || !mensajeNoCirugias) {
                        console.error("Error: No se encontraron los elementos en el DOM.");
                        return;
                    }

                    tabla.innerHTML = ""; // Limpiar la tabla antes de llenarla

                    if (data.length === 0) {
                        mensajeNoCirugias.style.display = 'block';
                    } else {
                        mensajeNoCirugias.style.display = 'none';
                        data.forEach(cirugia => {
                            const tr = document.createElement('tr');

                            let fechaCirugia = (cirugia.fecha === "0001-01-01") ? "CANCELADA" : cirugia.fecha;

                            let accionesHTML = '';
                            if (puestoUsuario === 'jefe_unidad' || puestoUsuario === 'jefe_piso') {
                                accionesHTML = `
                                    <td>
                                        <button onclick="editarCirugia(${cirugia.id})">Editar</button>
                                        <button onclick="eliminarCirugia(${cirugia.id})">Cancelar</button>
                                    </td>
                                `;
                            }

                            tr.innerHTML = `
                                <td>${cirugia.nombre_cirugia}</td>
                                <td>${cirugia.medico}</td>
                                <td>${cirugia.sala}</td>
                                <td>${fechaCirugia}</td>
                                <td>${cirugia.jefe}</td>
                                ${accionesHTML}
                            `;
                            tabla.appendChild(tr);
                        });
                    }
                })
                .catch(error => {
                    console.error("Error al obtener cirugías:", error);
                    const mensajeNoCirugias = document.getElementById('noCirugias');
                    if (mensajeNoCirugias) {
                        mensajeNoCirugias.style.display = 'block';
                    }
                });
        }
    </script>

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

                <label for="jefePiso">Jefe:</label>
                <select id="jefePiso" name="id_jefePiso" required></select>

                <button type="submit">Guardar cambios</button>
            </form>
        </div>
    </div>

</body>

</html>