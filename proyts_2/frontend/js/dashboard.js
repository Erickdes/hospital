document.addEventListener("DOMContentLoaded", function () {
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
            if (data && data.error) {
                console.error('Error en los datos:', data.error);
                document.getElementById('noCirugias').style.display = 'block';
                return;
            }

            const tabla = document.getElementById("tablaCirugias");
            tabla.innerHTML = ""; // Limpia la tabla antes de llenarla

            if (data.length === 0) {
                document.getElementById('noCirugias').style.display = 'block'; // Muestra mensaje si no hay cirugías
            } else {
                document.getElementById('noCirugias').style.display = 'none'; // Oculta mensaje si hay cirugías
                data.forEach(cirugia => {
                    const tr = document.createElement('tr');
                    
                    // Si la fecha es "0001-01-01", mostrar "CANCELADA"
                    let fechaCirugia = (cirugia.fecha === "0001-01-01") ? "CANCELADA" : cirugia.fecha;

                    tr.innerHTML = `
                        <td>${cirugia.nombre_cirugia}</td>
                        <td>${cirugia.medico}</td>
                        <td>${cirugia.sala}</td>
                        <td>${fechaCirugia}</td>
                        <td>
                            <button onclick="editarCirugia(${cirugia.id})">Editar</button>
                            <button onclick="eliminarCirugia(${cirugia.id})">Cancelar</button>
                        </td>
                    `;
                    tabla.appendChild(tr);
                });
            }
        })
        .catch(error => {
            console.error("Error al obtener cirugías:", error);
            document.getElementById('noCirugias').style.display = 'block'; // Muestra el mensaje de error si ocurre un problema
        });
}

// Función para editar cirugía
function editarCirugia(id) {
    window.location.href = `../../frontend/views/modificar_cirugia.php?id=${id}`;
}

// Función para cancelar cirugía
function eliminarCirugia(id) {
    if (confirm('¿Seguro que quieres cancelar esta cirugía?')) {
        fetch('../../backend/controllers/cancelar_cirugia.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: id })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Cirugía cancelada.');
                fetchCirugias(); // Recargar la lista de cirugías
            } else {
                alert('Error al cancelar la cirugía.');
            }
        })
        .catch(error => {
            console.error('Error al cancelar cirugía:', error);
        });
    }
}
