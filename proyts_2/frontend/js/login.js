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
    .then(response => response.json())  // Cambiado a .json() para manejar respuesta JSON
    .then(data => {
        console.log('Respuesta del servidor:', data);  // Imprime la respuesta del servidor como objeto

        if (data.success) {
            window.location.href = data.redirect;  // Redirige si el login fue exitoso
        } else {
            // Muestra el error si no es exitoso
            document.getElementById('loading').style.display = 'none';
            document.getElementById('loginForm').style.display = 'block';
            document.getElementById('error-message').style.display = 'block';  // Muestra el mensaje de error
            document.getElementById('error-message').textContent = data.error || 'Credenciales inválidas';  // Muestra el mensaje de error

            // Limpia los campos de entrada si es necesario
            document.getElementById('username').value = '';
            document.getElementById('password').value = '';
        }
    })
    .catch(error => {
        console.error('Error en fetch:', error);
        document.getElementById('loading').style.display = 'none';
        document.getElementById('loginForm').style.display = 'block';
        alert('Hubo un error en la conessssssssssssssssxión con el servidor.');
    });
});
