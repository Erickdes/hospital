document.addEventListener("DOMContentLoaded", function () {
    // Solo ejecuta fetchCirugias() si estamos en tabla_cirugias.php
    if (document.getElementById("tablaCirugias")) {
        fetchCirugias();
    }
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
                    if (typeof puestoUsuario !== 'undefined' && (puestoUsuario === 'jefe_unidad' || puestoUsuario === 'jefe_piso')) {
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

// Función para redirigir a la página de modificación de cirugía
function editarCirugia(id) {
    window.location.href = `modificar_cirugia.php?id=${id}`;
}

// Función para eliminar una cirugía
function eliminarCirugia(idCirugia) {
    if (confirm("¿Estás seguro de que quieres cancelar esta cirugía?")) {
        fetch('../../backend/controllers/cancelar_cirugia.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: idCirugia })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert("Cirugía cancelada correctamente.");
                fetchCirugias(); // Recargar la lista de cirugías
            } else {
                alert("Error al cancelar la cirugía: " + data.error);
            }
        })
        .catch(error => {
            console.error("Error al cancelar la cirugía:", error);
            alert("Hubo un error al procesar la solicitud.");
        });
    }
}
