document.querySelectorAll('.cancelarCirugia').forEach(button => {
    button.addEventListener('click', function() {
        let cirugiaId = this.getAttribute('data-id');

        if (confirm('¿Seguro que quieres cancelar esta cirugía?')) {
            fetch('../../backend/controllers/cancelar_cirugia.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: cirugiaId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Cirugía cancelada.');
                    location.reload();
                } else {
                    alert('Error al cancelar.');
                }
            })
            .catch(error => {
                console.error('Error al cancelar cirugía:', error);
            });
        }
    });
});
