document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const idCirugia = urlParams.get("id"); // Obtiene el ID de la URL

    // Verificar si no hay ID en la URL
    if (!idCirugia) {
        alert("Error: No se proporcionó un ID de cirugía.");
        return;
    }

    // Verificar que el formulario existe antes de añadir el event listener
    const form = document.getElementById('modificarCirugia');
    if (!form) {
        console.error("No se encontró el formulario 'modificarCirugia'.");
        alert("Error: No se encontró el formulario de modificación.");
        return;
    }

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        let cirugia = document.getElementById('cirugia').value;
        let medico = document.getElementById('medico').value;
        let sala = document.getElementById('sala').value;
        let fecha = document.getElementById('fecha').value;

        // Verificar que todos los campos sean completados
        if (!cirugia || !medico || !sala || !fecha) {
            alert("Todos los campos son obligatorios.");
            return;
        }

        // Crear el objeto FormData con los datos del formulario
        let formData = new FormData();
        formData.append("id", idCirugia);
        formData.append("nombre_cirugia", cirugia);
        formData.append("id_medico", medico);
        formData.append("id_sala", sala);
        formData.append("fecha", fecha);

        console.log("Enviando datos...");
        console.log([...formData.entries()]); // Verifica qué datos se están enviando

        // Enviar la solicitud con método POST a través de fetch
        fetch('../../backend/controllers/modificar_cirugia.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            // Verificar si la respuesta es correcta
            if (!response.ok) {
                throw new Error("Error en la respuesta del servidor");
            }
            return response.json();
        })
        .then(data => {
            // Verificar si el servidor devolvió éxito
            if (data.success) {
                alert("Cirugía modificada correctamente.");
                window.location.href = '../../frontend/views/tabla_cirugias.php';
            } else {
                alert("Hubo un error: " + data.error);
            }
        })
        .catch(error => {
            // Manejar cualquier error en la solicitud o respuesta
            console.error("Error en la solicitud:", error);
            alert("Hubo un error al procesar la solicitud. Por favor, intenta de nuevo.");
        });
    });
});
