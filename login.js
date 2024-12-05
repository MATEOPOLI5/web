function validarLogin() {
  const username = document.getElementById('username').value;
  const password = document.getElementById('password').value;
  const mensaje = document.getElementById('mensaje');

  // Validación del formato de la contraseña
  const tieneMayuscula = /[A-Z]/;
  const tieneMinuscula = /[a-z]/;
  const tieneEspecial = /[\W_]/;
  const tieneNumero = /\d/;

  if (username === "") {
    mensaje.textContent = "Por favor ingresa tu nombre de usuario o correo electrónico.";
  } else if (password === "") {
    mensaje.textContent = "Por favor ingresa tu contraseña.";
  } else if (password.length < 8) {
    mensaje.textContent = "La contraseña debe tener al menos 8 caracteres.";
  } else if (!tieneMayuscula.test(password)) {
    mensaje.textContent = "La contraseña debe contener al menos una letra mayúscula.";
  } else if (!tieneMinuscula.test(password)) {
    mensaje.textContent = "La contraseña debe contener al menos una letra minúscula.";
  } else if (!tieneEspecial.test(password)) {
    mensaje.textContent = "La contraseña debe contener al menos un carácter especial.";
  } else if (!tieneNumero.test(password)) {
    mensaje.textContent = "La contraseña debe contener al menos un número.";
  } else {
    mensaje.textContent = "";  // Limpiar el mensaje

    // Enviar datos al servidor para validación
    fetch('validar_login.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: new URLSearchParams({ username, password })
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        // Redirigir a captcha.php si el login es exitoso
        window.location.href = "captcha.php";
      } else {
        mensaje.textContent = data.message;
      }
    })
    .catch(error => {
      mensaje.textContent = "Ocurrió un error al validar el usuario.";
      console.error(error);
    });
  }
}

function cancelarLogin() {
  document.getElementById('username').value = "";
  document.getElementById('password').value = "";
  document.getElementById('mensaje').textContent = "";
}
