<?php
include 'modelo.php';

session_start(); // Inicia la sesión

header('Content-Type: application/json');

// Instancia de la clase OperacionesBd
$obj = new OperacionesBd();
$conexion = $obj->conexion();

// Obtener datos del formulario
$correo = $_POST['username'];
$clave = $_POST['password'];

// Consulta para verificar usuario y contraseña
$sql = "SELECT * FROM usuarios WHERE nombre = '$correo' AND clave = '$clave'";
$resultado = mysqli_query($conexion, $sql);

if (mysqli_num_rows($resultado) > 0) {
    // Inicio de sesión exitoso
    $usuario = mysqli_fetch_assoc($resultado); // Obtener los datos del usuario
    // Guardar datos del usuario en la sesión
    $_SESSION['usuario'] = [
        'nombre' => $usuario['nombre'],
        'apellido_p' => $usuario['apellido_p'],
        'apellido_m' => $usuario['apellido_m']
    ];
    
    echo json_encode([
        'success' => true, 
        'message' => 'Inicio de sesión correcto',
        'nombre' => $usuario['nombre'], 
        'apellido_p' => $usuario['apellido_p'],
        'apellido_m' => $usuario['apellido_m']
    ]);
} else {
    // Inicio de sesión fallido
    echo json_encode(['success' => false, 'message' => 'Usuario o contraseña incorrectos']);
}
?>
