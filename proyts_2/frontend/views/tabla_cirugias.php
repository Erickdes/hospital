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
        <tbody id="tablaCirugias"></tbody>
    </table>

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
    <div class="modal-overlay" onclick="cerrarModal()"></div>
    <!-- Scripts -->
    <script src="../js/dashboard.js"></script>
    <script src="../js/modificar_cirugia.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            cargarCirugias();

            let fechaInput = document.getElementById('fecha');
            if (fechaInput) {
                fechaInput.addEventListener('click', function () {
                    document.getElementById('mensajeFecha').style.display = 'block';
                });
            }
        });

        function cargarCirugias() {
            fetch('../../backend/controllers/get_cirugia.php')
                .then(response => response.json())
                .then(data => {
                    const tabla = document.getElementById('tablaCirugias');
                    tabla.innerHTML = '';
                    if (data.length === 0) {
                        document.getElementById('noCirugias').style.display = 'block';
                    } else {
                        document.getElementById('noCirugias').style.display = 'none';
                        data.forEach(cirugia => {
                            let fila = document.createElement('tr');
                            fila.innerHTML = `
                                <td>${cirugia.nombre_cirugia}</td>
                                <td>${cirugia.nombre_medico}</td>
                                <td>${cirugia.nombre_sala}</td>
                                <td>${cirugia.fecha}</td>
                                <td>
                                    <button class="btnModificar" data-id="${cirugia.id}" onclick="abrirModal(${cirugia.id})">Modificar</button>
                                </td>
                            `;
                            tabla.appendChild(fila);
                        });
                    }
                });
        }

        function abrirModal(id) {
            document.getElementById('modalModificarCirugia').style.display = 'block';
            document.getElementById('idCirugia').value = id;
            cargarDatosCirugia(id);
        }

        function cerrarModal() {
            document.getElementById('modalModificarCirugia').style.display = 'none';
        }

        function cargarDatosCirugia(id) {
            fetch(`../../backend/controllers/get_cirugia.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('cirugia').value = data.nombre_cirugia;
                    document.getElementById('fecha').value = data.fecha;
                    cargarOpciones('medico', '../../backend/controllers/get_medicos.php', data.id_medico);
                    cargarOpciones('sala', '../../backend/controllers/get_salas.php', data.id_sala);
                });
        }

        function cargarOpciones(elementId, url, selectedValue) {
            fetch(url)
                .then(response => response.json())
                .then(options => {
                    const select = document.getElementById(elementId);
                    select.innerHTML = '';
                    options.forEach(option => {
                        const opt = document.createElement('option');
                        opt.value = option.id;
                        opt.textContent = option.nombre;
                        if (option.id == selectedValue) {
                            opt.selected = true;
                        }
                        select.appendChild(opt);
                    });
                });
        }

        document.getElementById('formModificarCirugia').addEventListener('submit', function (event) {
            event.preventDefault();
            let formData = new FormData(this);
            fetch('../../backend/controllers/modificar_cirugia.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Cirugía modificada correctamente');
                    cerrarModal();
                    cargarCirugias();
                } else {
                    alert('Error: ' + data.error);
                }
            })
            .catch(error => console.error('Error en la solicitud:', error));
        });
    </script>

</body>
</html>
