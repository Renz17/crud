document.getElementById("login-form").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevenir el envío del formulario por defecto
    
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var errorMessage = document.getElementById("error-message");

    // Validación básica de campos
    if (username.trim() === "" || password.trim() === "") {
        errorMessage.textContent = "Por favor, introduce un nombre de usuario y una contraseña.";
        return;
    }

    // Enviar los datos del formulario al servidor utilizando fetch o XMLHttpRequest
    fetch("../../login_check.php", {
        method: "POST",
        body: new FormData(document.getElementById("login-form"))
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("Error en la solicitud.");
        }
        return response.text();
    })
    .then(data => {
        // Verificar la respuesta del servidor y mostrar mensajes de error si es necesario
        if (data === "error") {
            errorMessage.textContent = "Error en la autenticación. Por favor, verifica tus credenciales.";
        } else {
            // Si la autenticación es exitosa, redirigir al usuario a la página de inicio
            window.location.href = "inicio.html";
        }
    })
    .catch(error => {
        console.error("Error:", error);
        errorMessage.textContent = "Se produjo un error durante la autenticación. Por favor, inténtalo de nuevo más tarde.";
    });
});
