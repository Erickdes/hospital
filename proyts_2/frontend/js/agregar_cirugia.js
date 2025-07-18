document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById('agregarCirugia');
    if (!form) {
        console.error("No se encontró el formulario agregarCirugia");
        return;
    }

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        let nombreCirugia = document.getElementById('nombre_cirugia').value;
        let idMedico = document.getElementById('medico').value;
        let idSala = document.getElementById('sala').value;
        let fecha = document.getElementById('fecha').value;

        if (!nombreCirugia || !idMedico || !idSala || !fecha) {
            alert("Todos los campos son obligatorios.");
            return;
        }

        // Crear el objeto FormData para enviar los datos
        let formData = new FormData();
        formData.append("nombre_cirugia", nombreCirugia);
        formData.append("id_medico", idMedico);
        formData.append("id_sala", idSala);
        formData.append("fecha", fecha);

        // Enviar la solicitud con método POST a través de fetch
        fetch('../../backend/controllers/agregar_cirugia.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Cirugía agregada correctamente.");
                window.location.href = '../../frontend/views/dashboard.php'; // Redirige al dashboard o a donde sea necesario
            } else {
                alert("Hubo un error: " + data.error);
            }
        })
        .catch(error => console.error("Error en la solicitud:", error));
    });
});
