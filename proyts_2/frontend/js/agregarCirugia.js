document.addEventListener('DOMContentLoaded', function() {
    fetch('backend/api/get_medicossalas.php')
        .then(response => response.json())
        .then(data => {
            const medicoSelect = document.getElementById('medico');
            const salaSelect = document.getElementById('sala');
            
            data.forEach(item => {
                let optionMedico = document.createElement('option');
                optionMedico.value = item.id;
                optionMedico.textContent = item.medico;
                medicoSelect.appendChild(optionMedico);
                
                let optionSala = document.createElement('option');
                optionSala.value = item.sala;
                optionSala.textContent = item.sala;
                salaSelect.appendChild(optionSala);
            });
            
        })
        .catch(error => console.error('Error:', error));
});
