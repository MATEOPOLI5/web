<?php
session_start();

// Verifica si hay un mensaje para mostrar
$mensaje = '';
if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'sesion_cerrada') {
    $mensaje = "Sesión cerrada exitosamente.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TostiElotes</title>
  <link rel="stylesheet" href="estilos.css">
  
</head>

<body>
  <?php if ($mensaje): ?>
    <div class="mensaje-exito">
      <?php echo htmlspecialchars($mensaje); ?>
    </div>
  <?php endif; ?>

  <div class="login-container",>
    <form id="loginForm">
          <h2>Iniciar Sesión</h2>

    <div align="center">
        <img src="img/inic.jpg" width="70" height="70" style="border-radius: 10px;">
      </div>
      <input type="text" id="username" placeholder="Usuario" required>
      <input type="password" id="password" placeholder="Contraseña" required>
              <br>
<div>
        <button type="button" class="btn-login" onclick="validarLogin()">Iniciar</button>
        
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
