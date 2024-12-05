<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Captcha</title>
  <link rel="stylesheet" href="css/captcha.css">
</head>
<body>
   
  <div class="captcha-container">
  <!--  <h2>VERIFICA EL CAPTCHA</h2> -->
    
    <!-- Imagen CAPTCHA -->
    <img id="captchaImage" src="upxbpjh.png" alt="CAPTCHA">
    
    <!-- Input para ingresar el texto del CAPTCHA -->
    <input type="text" id="captchaInput" placeholder="Ingresa capcha">
    
    <!-- Botón para verificar el CAPTCHA -->
    <button onclick="verificarCaptcha()">Verificar</button>
    
    <p id="mensaje" class="error-message"></p>
  </div>

  <script>
    const captchas = [
      { imagen: "upxbpjh.png", valor: "upxbpjh" },
      { imagen: "caPtcHA.png", valor: "caPtcHA" },
      { imagen: "ÑigAWzñ.png", valor: "ÑigAWzñ" }
    ];

    let captchaIndex = 0; // Índice del CAPTCHA actual

    function verificarCaptcha() {
      const captchaInput = document.getElementById('captchaInput').value; // Sin convertir a mayúsculas
      const mensaje = document.getElementById('mensaje');

      // Verificamos si el valor ingresado coincide con el CAPTCHA actual
      if (captchaInput === captchas[captchaIndex].valor) {
        mensaje.textContent = "";
        window.location.href = "Correcto.php";
      } else {
        captchaIndex++;
        if (captchaIndex < captchas.length) {
          // Cambiar la imagen del CAPTCHA
          document.getElementById('captchaImage').src = captchas[captchaIndex].imagen;
          mensaje.textContent = "El CAPTCHA es incorrecto. Inténtalo de nuevo.";
          document.getElementById('captchaInput').value = ""; // Limpiar el input
        } else {
          // Si se han usado las tres imágenes, reiniciar o dar un mensaje final
          mensaje.textContent = "Has fallado todos los intentos. Recarga la página para intentar de nuevo.";
        }
      }
    }
</script>

</body>
</html>
