document.getElementById('formAgregarCirugia').addEventListener('submit', function(event) {
    event.preventDefault();

    let cirugia = document.getElementById('cirugia').value;
    let medico = document.getElementById('medico').value;
    let sala = document.getElementById('sala').value;

    if (!cirugia || !medico || !sala) {
        alert("Todos los campos son obligatorios.");
        return false;
    }

    this.submit();
});
