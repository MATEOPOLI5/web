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
    <title>Reporte de Usuarios</title>
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

<h1>Reporte de Usuarios</h1>
<table>
    <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th>Teléfono</th>
        <th>Correo</th>
    </tr>
    <?php
    global $modelo;
    $sql = "SELECT * FROM usuarios";
    $datos = $modelo->mostrardatos($sql);
    foreach ($datos as $columna) {
    ?>
    <tr>
        <td><?php echo $columna['idUsuario']; ?></td>
        <td><?php echo $columna['nombre']; ?></td>
        <td><?php echo $columna['apellido_p']; ?></td>
        <td><?php echo $columna['apellido_m']; ?></td>
        <td><?php echo $columna['telefono']; ?></td>
        <td><?php echo $columna['correo']; ?></td>
    </tr>
    <?php } ?>
</table>
</body>
</html>
