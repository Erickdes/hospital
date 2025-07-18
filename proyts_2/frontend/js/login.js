document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();

    let username = document.getElementById('username').value;
    let password = document.getElementById('password').value;

    let data = {
        username: username,
        password: password
    };

    console.log('Enviando datos: ', data);  // Muestra los datos enviados

    // Muestra el indicador de carga y oculta el formulario
    document.getElementById('loading').style.display = 'block';
    document.getElementById('loginForm').style.display = 'none';

    fetch('../../backend/controllers/login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.text())  // Cambiado a .text() para depurar la respuesta cruda
    .then(responseText => {
        console.log('Respuesta del servidor:', responseText);  // Imprime la respuesta cruda

        // Intenta parsear el JSON solo si es válido
        try {
            const data = JSON.parse(responseText);  // Intentamos parsear la respuesta
            if (data.success) {
                window.location.href = data.redirect;
            } else {
                document.getElementById('loading').style.display = 'none';
                document.getElementById('loginForm').style.display = 'block';
                document.getElementById('error-message').style.display = 'block';  // Muestra el mensaje de error
            }
        } catch (e) {
            console.error('Error al parsear JSON:', e);
            alert('Error al procesar la respuesta del servidor.');
        }
    })
    .catch(error => {
        console.error('Error en fetch:', error);
        document.getElementById('loading').style.display = 'none';
        document.getElementById('loginForm').style.display = 'block';
        alert('Hubo un error en la conexión con el servidor.');
    });
});
