<?php
header('Content-Type: application/json'); // Asegura que la respuesta sea JSON

require_once 'modelo.php';
$obj = new OperacionesBd();

$opcion = $_GET['opcion'];

switch ($opcion) {

    case 'guardar':
        $input = json_decode(file_get_contents('php://input'), true);
        guardarEntidad($input['tipo'], $input['datos']);
        break;

    default:
        echo json_encode(array('status' => 0, 'error' => 'Opción no válida'));
        break;
}

function guardarEntidad($tipo, $datos)
{
    global $obj;
    $conn = $obj->conexion();

    $entidadesValidas = ['cuartos'];
    if (!in_array($tipo, $entidadesValidas)) {
        $obj->respuesta(false); // Enviar mensaje de error por tipo inválido
        return;
    }

    $sql = "";
    if ($tipo === 'cuartos') {
        // SQL para insertar una nueva sala
        $sql = "INSERT INTO ventas (empleado, cliente, fecha, total,metodo_pago) 
                VALUES ('{$datos['empleado']}', '{$datos['cliente']}', '{$datos['fecha']}', '{$datos['total,']}', '{$datos['metodo_pago,']}')";
                
        $sql = "INSERT INTO venta_detalle (idVenta, producto, cod_barra, precio, cantidad, total_producto) 
                VALUES ('{$datos['idVenta']}', '{$datos['producto']}', 
                        '{$datos['cod_barra']}', '{$datos['precio']}','{$datos['cantidad']}','{$datos['total_producto']}')";
    }
    

    $obj->guardardatos($sql); // Llamar al método global para guardar los datos

}
