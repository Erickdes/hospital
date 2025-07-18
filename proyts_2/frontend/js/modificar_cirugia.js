document.addEventListener("DOMContentLoaded", function () {
    const formModificar = document.getElementById("formModificarCirugia");
    const fechaInput = document.getElementById("fecha");
    const mensajeFecha = document.getElementById("mensajeFecha");

    // Evita error si los elementos no existen
    if (fechaInput && mensajeFecha) {
        fechaInput.addEventListener("click", function () {
            mensajeFecha.style.display = "block";
        });
    }

    // Evento para enviar el formulario de modificación
    if (formModificar) {
        formModificar.addEventListener("submit", function (event) {
            event.preventDefault();
            modificarCirugia();
        });
    }
});

// Función para modificar una cirugía
function modificarCirugia() {
    const form = document.getElementById("formModificarCirugia");
    const formData = new FormData(form);

    fetch("../../backend/controllers/modificar_cirugia.php", {
        method: "POST",
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                alert("Cirugía modificada correctamente");
                cerrarModal();
                cargarCirugias(); // Refrescar la tabla
            } else {
                alert("Error: " + data.error);
            }
        })
        .catch((error) => console.error("Error en la solicitud:", error));
}

// Función para abrir el modal y cargar datos de la cirugía
function abrirModal(id) {
    document.getElementById("modalModificarCirugia").style.display = "block";
    document.querySelector(".modal-overlay").style.display = "block";
    document.getElementById("idCirugia").value = id;
    cargarDatosCirugia(id);
}

function cerrarModal() {
    document.getElementById("modalModificarCirugia").style.display = "none";
    document.querySelector(".modal-overlay").style.display = "none";
}


// Cargar datos de una cirugía en el modal
function cargarDatosCirugia(id) {
    fetch(`../../backend/controllers/get_cirugia.php?id=${id}`)
        .then((response) => response.json())
        .then((data) => {
            document.getElementById("cirugia").value = data.nombre_cirugia;
            document.getElementById("fecha").value = data.fecha;
            cargarOpciones("medico", "../../backend/controllers/get_medicos.php", data.id_medico);
            cargarOpciones("sala", "../../backend/controllers/get_salas.php", data.id_sala);
        });
}

// Cargar opciones en los select (médicos y salas)
function cargarOpciones(elementId, url, selectedValue) {
    fetch(url)
        .then((response) => response.json())
        .then((options) => {
            const select = document.getElementById(elementId);
            select.innerHTML = ""; // Limpiar opciones previas
            options.forEach((option) => {
                const opt = document.createElement("option");
                opt.value = option.id;
                opt.textContent = option.nombre;
                if (option.id == selectedValue) {
                    opt.selected = true;
                }
                select.appendChild(opt);
            });
        });
}
