<?php
session_start(); // Inicia la sesión

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    // Redirigir a la página de login si no está autenticado
    header('Location: index.php');
    exit();
}

$nombre = $_SESSION['usuario']['nombre'];
$apellido_p = $_SESSION['usuario']['apellido_p'];
$apellido_m = $_SESSION['usuario']['apellido_m'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de Alumnos, Docentes y Materias</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 

  <link rel="stylesheet" href="css/menu.css">
</head>


<body>
  <div class="color">
    
         <!--Empieza el menú-->
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
      <a class="navbar-brand" href="#">Menú</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Cerrar <span
                class="sr-only">(current)</span></a>

          </li>
          <li class="nav-item">
            <a class="nav-link" href="javascript:buscar(1,1,0,1);">
                Usuario</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="javascript:buscar(1,1,0,6);">
                Mostrar Usuario</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="javascript:buscar(2,1,0,1);">
                Productos</a>
         </li> <li class="nav-item">
            <a class="nav-link" href="javascript:buscar(2,1,0,6);">
                ver producto</a>
          </li>     
          <li class="nav-item">
            <a class="nav-link" onclick="cargarFormularioVentas()">
                Venta</a>
         </li> 
         <li class="nav-item">
            <a class="nav-link" href="javascript:buscar(4,1,0,0);">
                Reportes</a>
          </li>   
      </div>
    </nav> 

        <!-- Contenido Principal -->
        <div id="contenido" class="contenido">
            <!-- Aquí se cargará el contenido dinámicamente -->

            <br>
            <div id="contenido1">
                <!-- Aquí se cargará el contenido dinámicamente -->
            </div>
            <div id="contenedor-formulario"></div>

        </div>
        
        
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   
    <script src="funcion_ajax.js"></script>

</body>
</html>
