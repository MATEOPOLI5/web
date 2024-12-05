<?php
include("modelo.php");
$modelo = new OperacionesBd;

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=archivo.xls");

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Productos</title>
</head>
<body>
<style>
    body {
        font-family: Arial, sans-serif;
    }
    h1 {
        text-align: center;
        color: #4CAF50;
        font-size: 24px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
    th, td {
        padding: 12px;
        text-align: left;
        border: 1px solid #ddd;
    }
    th {
        background-color: #4CAF50;
        color: white;
        font-weight: bold;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    tr:hover {
        background-color: #f1f1f1;
    }
</style>

<h1>Reporte de Productos</h1>
<table>
    <tr>
        <th>#</th>
        <th>Producto</th>
        <th>Código de Barra</th>
        <th>Cantidad</th>
        <th>Proveedor</th>
        <th>Especificaciones</th>
        <th>Fecha de Caducidad</th>
        <th>Costo compras</th>
        <th>Costo en Venta</th>
        
    </tr>
    <?php
    global $modelo;
    $sql = "SELECT * FROM productos";
    $datos = $modelo->mostrardatos($sql);
    foreach ($datos as $columna) {
    ?>
    <tr>
        <td><?php echo $columna['idProductos']; ?></td>
        <td><?php echo $columna['nombre']; ?></td>
        <td><?php echo $columna['cod_barra']; ?></td>
        <td><?php echo $columna['cantidad']; ?></td>
        <td><?php echo $columna['proveedor']; ?></td>
        <td><?php echo $columna['especificaciones']; ?></td>
        <td><?php echo $columna['fecha_caducidad']; ?></td>
        <td><?php echo $columna['costo_compras']; ?></td>
        <td><?php echo $columna['costo_ventas']; ?></td>
    </tr>
    <?php } ?>
</table>
</body>
</html>
