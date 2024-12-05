<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="css/index.css">

</head>
<body>
  <div class="login-container",>
    <h2>Iniciar Sesión</h2>
    <form id="loginForm">
      <input type="text" id="username" placeholder="Nombre de usuario o correo electrónico" required>
      <input type="password" id="password" placeholder="Contraseña" required>
      <div>
        <button type="button" class="btn-login" onclick="validarLogin()">Iniciar Sesión</button>
        <button type="button" class="btn-cancel" onclick="cancelarLogin()">Cancelar</button>
      </div>
      <strong id="mensaje" class="error-message"></strong>
    </form>

  </div>

  <div id="contenido1" class="contenido"></div>
  <!-- Enlace al archivo JavaScript externo -->
  <script src="login.js"></script>
</body>
</html>

