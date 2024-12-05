<?php
include("modelo.php");
$modelo= new OperacionesBd;

$opcion=$_GET['opcion'];
$op=$_GET['op'];

header('Content-Type: application/json');

switch($opcion){

    case 1 :     
      operaciones_usuario($op);
    break;
    case 2 :
      operaciones_Producto($op);
    break;
    case 3 :
      PagoEfectivo();
      break;
      case 4 :
        Reportes();
        break;
    
}

function operaciones_usuario($op){
//mostrar  formulario
switch($op){  
case 1:
  FomrAlumno($op);//formulario

  break;
  case 2:
    FomrAlumno($op);
    break;
    case 3:
 global $modelo;
 $sql = Inser_Mod_Elim_Alum($op);
 $modelo->actualizadatos($sql);
 echo '<div class="alert alert-primary" 
 role="alert">Se ha registrado corretamente</div>';
 break;
      case 4:
        //actualizarr
        global $modelo;
        $sql = Inser_Mod_Elim_Alum($op);
        $modelo->actualizadatos($sql);
        echo '<div class="alert alert-primary" role="alert"> 
        Dato actualizado correctamente </div>';
        break;
        case 5:
          global $modelo;
            $modelo->actualizadatos(Inser_Mod_Elim_Alum($op));
            mostrar_alumnos();
            break;
          break;        
        case 6:
          mostrar_alumnos();
          break;
           }
}


function Inser_Mod_Elim_Alum($oper){
  $sql = "";
  if ($oper != 5) {
    $nombre=$_POST['nombre'];
    $apellido_p=$_POST['apellido_p'];
    $apellido_m=$_POST['apellido_m'];
    $clave=$_POST['clave'];
    $telefono=$_POST['telefono'];
    $correo=$_POST['correo'];
}
switch ($oper) {
    case 3:
        $sql ="INSERT INTO usuarios(nombre,apellido_p,
        apellido_m,clave,telefono,correo)
        VALUES('$nombre','$apellido_p','$apellido_m',
        '$clave','$telefono','$correo')";
        break;
    case 4:
        $idUsuario = $_GET['id'];
          $sql = "UPDATE usuarios SET nombre='$nombre',
          apellido_p='$apellido_p',apellido_m='$apellido_m',
          clave='$clave',telefono='$telefono',
          correo='$correo' WHERE idUsuario='$idUsuario'";
        break;
    case 5:
        $idUsuario = $_GET['id'];
        $sql = "DELETE FROM usuarios WHERE idUsuario = '$idUsuario'";
        break;
}
return $sql;
}



function FomrAlumno($oper){
  global $modelo;
  $datos=array("", "", "", "", "", "");
  if ($oper == 2) {    
     $sql="SELECT * FROM usuarios WHERE idUsuario=" . $_GET
     ['id'];
     $mostrar = $modelo->mostrardatos($sql);
     foreach ($mostrar as $resultado) {
         $datos[0] = $resultado['nombre'];
         $datos[1] = $resultado['apellido_p'];
         $datos[2] = $resultado['apellido_m'];
         $datos[3] = $resultado['clave'];
         $datos[4] = $resultado['telefono'];
         $datos[5] = $resultado['correo'];
}
}
echo'
  <form id="productoForm" class="form-container" action="" method="post">
                          <h3>Registro </h3> 
  <div class="form-group">
        <label for="nombre">Nombre del Usuario:</label>
        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre del Usuario" value="' . $datos[0] . '" required>
    </div>
    <div class="form-group">
        <label for="apellido_p">Apellido Paterno:</label>
        <input type="text" id="apellido_p" name="apellido_p" class="form-control" placeholder="Apellido Paterno" value="' . $datos[1] . '" required>
    </div>
    <div class="form-group">
        <label for="apellido_m">Apellido Materno:</label>
        <input type="text" id="apellido_m" name="apellido_m" class="form-control" placeholder="Apellido Materno" value="' . $datos[2] . '" required>
    </div>
    <div class="form-group">
        <label for="clave">Clave:</label>
        <input type="text" id="clave" name="clave" class="form-control" placeholder="Clave" value="' . $datos[3] . '" required>
    </div>
    <div class="form-group">
        <label for="telefono">Telefono:</label>
        <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Telefono" rows="3" value="' . $datos[4] . '" >
    </div>
    <div class="form-group">
        <label for="correo">Correo:</label>
        <input type="text" id="correo" name="correo" class="form-control" placeholder="Correo" value="' . $datos[5] . '" required>
    </div>    
     <div class="container-fluid d-flex justify-content-end gap-2">';
    if ($oper == 2) echo '<button class="btn btn-success" onclick="javascript:guardar(1,1,' . $_GET['id'] . ',4); return false;">Modificar</button>';
    else echo '<button class="btn btn-success" onclick="javascript:guardar(1,1,0,3); return false;">Guardar</button>';
    echo '<button class="btn btn-danger">Cancelar</button>
            </div>
    </form>   </div>
</body> '; 

}



function mostrar_alumnos()
{
    print'
    
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  
</head>

<body>
  <div class="color">
    <main>
          <div class="container">
            <div id="vistaProductos" class="mt-4">
              <h3>Lista de Usuarios</h3>
              <div class="table-responsive">
                <div class="cont">
                  <table id="tablaHistorial" class="table">
                    <thead>
                      <tr>
                     <th>#</th>
                     <th>Nombre</th>
                     <th>Apellido P</th>
                     <th>Apellido M</th>
                     <th>Clave</th>
                     <th>Telefono</th>
                     <th>Correo</th>
                    
                     <th>Opciones</th>

                      </tr>
                    </thead>
                    <tbody id="tablaHistorial">';                    
        global  $modelo;         
        $sql="SELECT*FROM usuarios ";     
        $datos=$modelo->mostrardatos($sql);     
         foreach ($datos as $columna) {    
           print '<tr>
        <td>'.$columna['idUsuario'].'</td>
        <td>'.$columna['nombre'].'</td>
        <td>'. $columna['apellido_p'].'</td>
        <td>'.$columna['apellido_m'].'</td>
        <td>'.$columna['clave'].'</td>
        <td>'. $columna['telefono'].'</td>
        <td>'.$columna['correo'].'</td>
        <td>
            <a href="javascript:buscar(1,1,' . $columna['idUsuario'] . ',2)">
            <img style="width:20px;"  src="update.png">
            </a>
      
            <a href="javascript:buscar(1,1,' . $columna['idUsuario'] . ',5)"> 
            <img style="width:30px;" src="delte.png">
            </a>
        </td>
                            </tr>     ';}                 
                   
                    print ' </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
    ';
}



function operaciones_Producto($op){
  //mostrar  formulario
  switch($op){  
  case 1:
    FomrProducto($op);//formulario
  
    break;
    case 2:
      FomrProducto($op);
      break;
      case 3:
   global $modelo;
   $sql = Inser_Mod_Elim_Produc($op);
   $modelo->actualizadatos($sql);
   echo '<div class="alert alert-primary" 
   role="alert">Se ha registrado corretamente</div>';
   break;
        case 4:
          //actualizarr
          global $modelo;
          $sql = Inser_Mod_Elim_Produc($op);
          $modelo->actualizadatos($sql);
          echo '<div class="alert alert-primary" role="alert"> 
          Dato actualizado correctamente </div>';
          break;
          case 5:
            global $modelo;
              $modelo->actualizadatos(Inser_Mod_Elim_Produc($op));
              mostrar_Producto();
              break;
            break;        
          case 6:
            mostrar_Producto();
            break;
             }
  }
  
  
  function Inser_Mod_Elim_Produc($oper){
    $sql = "";
    if ($oper != 5) {
      $nombre=$_POST['nombre'];
      $cod_barra=$_POST['cod_barra'];
      $cantidad=$_POST['cantidad'];
      $proveedor=$_POST['proveedor'];
      $especificaciones=$_POST['especificaciones'];
      $fecha_caducidad=$_POST['fecha_caducidad'];
      $costo_compras=$_POST['costo_compras'];
      $costo_ventas=$_POST['costo_ventas'];
  }
  switch ($oper) {
      case 3:
          $sql ="INSERT INTO productos(nombre,cod_barra,
          cantidad,proveedor,especificaciones,fecha_caducidad,costo_compras,costo_ventas)
          VALUES ('$nombre','$cod_barra','$cantidad',
          '$proveedor','$especificaciones','$fecha_caducidad','$costo_compras','$costo_ventas')";
          break;
      case 4:
          $idProductos = $_GET['id'];
            $sql = "UPDATE productos SET nombre='$nombre',
            cod_barra='$cod_barra',cantidad='$cantidad',
            proveedor='$proveedor',especificaciones='$especificaciones',
            fecha_caducidad='$fecha_caducidad',costo_compras='$costo_compras',
            costo_ventas='$costo_ventas' WHERE idProductos='$idProductos'";
          break;
      case 5:
          $idProductos = $_GET['id'];
          $sql = "DELETE FROM productos WHERE idProductos = '$idProductos'";
          break;
  }
  return $sql;
  }
  
  
  
  function FomrProducto($oper){
    global $modelo;
    $datos=array("", "", "", "", "", "","","");
    if ($oper == 2) {    
       $sql="SELECT * FROM productos WHERE idProductos=" . $_GET
       ['id'];
       $mostrar = $modelo->mostrardatos($sql);
       foreach ($mostrar as $resultado) {
           $datos[0] = $resultado['nombre'];
           $datos[1] = $resultado['cod_barra'];
           $datos[2] = $resultado['cantidad'];
           $datos[3] = $resultado['proveedor'];
           $datos[4] = $resultado['especificaciones'];
           $datos[5] = $resultado['fecha_caducidad'];           
           $datos[6] = $resultado['costo_compras'];
           $datos[7] = $resultado['costo_ventas'];
  }
  }
  
  echo'

      <form id="productoForm" class="form-container" action="" method="post">
                        <h3>Registro de Productos</h3>
    <div class="form-group">
        <label for="nombre">Nombre del Producto</label>
        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre del producto" value="' . $datos[0] . '" required>
    </div>

    <div class="form-group">
        <label for="cod_barra">Código de Barras</label>
        <input type="text" id="cod_barra" name="cod_barra" class="form-control" placeholder="Código de barras" value="' . $datos[1] . '" required>
    </div>
    <div class="form-group">
        <label for="cantidad">Cantidad</label>
        <input type="number" id="cantidad" name="cantidad" class="form-control" placeholder="Cantidad disponible" value="' . $datos[2] . '" required>
    </div>
    <div class="form-group">
        <label for="proveedor">Proveedor</label>
        <input type="text" id="proveedor" name="proveedor" class="form-control" placeholder="Nombre del proveedor" value="' . $datos[3] . '" required>
    </div>

    <div class="form-group">
        <label for="especificaciones">Especificaciones</label>
        <input id="especificaciones" name="especificaciones" class="form-control" rows="3" placeholder="Especificaciones del producto" value="' . $datos[4] . '">
    </div>

    <div class="form-group">
        <label for="fecha_caducidad">Fecha de Caducidad</label>
        <input type="date" id="fecha_caducidad" name="fecha_caducidad" class="form-control" value="' . $datos[5] . '" required>
    </div>

    <div class="form-group">
        <label for="costo_compras">Costo de Compras</label>
        <input type="number" id="costo_compras" name="costo_compras" class="form-control" placeholder="Costo de compra" step="0.01" value="' . $datos[6] . '" required>
    </div>

    <div class="form-group">
        <label for="costo_ventas">Costo de Ventas</label>
        <input type="number" id="costo_ventas" name="costo_ventas" class="form-control" placeholder="Costo de venta" step="0.01" value="' . $datos[7] . '" required>
    </div>
      
       <div class="container-fluid d-flex justify-content-end gap-2">';
      if ($oper == 2) echo '<button class="btn btn-success" onclick="javascript:guardar(2,1,' . $_GET['id'] . ',4); return false;">Modificar</button>';
      else echo '<button class="btn btn-success" onclick="javascript:guardar(2,1,0,3); return false;">Guardar</button>';
      echo '<button class="btn btn-danger">Cancelar</button>
              </div>
      </form> '; 
  
  }
  
  
  
  function mostrar_Producto()
  {
      print'
      
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/TablaStyles.css">
  </head>
  
  <body>
    <div class="color">
      <main>
            <div class="container">
              <div id="vistaProductos" class="mt-4">
                <h3>Lista de Productos</h3>
                <div class="table-responsive">
                  <div class="cont">
                    <table id="tablaHistorial" class="table">
                      <thead>
                        <tr>
                       <th>#</th>
                       <th>Nombre</th>
                       <th>Cod. Barra</th>
                       <th>Cantidad</th>
                       <th>Proveedor</th>
                       <th>Especificaciones</th>
                       <th>Caducidad</th>                       
                       <th>Costo Compra</th>
                       <th>Costo venta</th>                      
                       <th>Opciones</th>
  
                        </tr>
                      </thead>
                      <tbody id="tablaHistorial">';                    
          global  $modelo;         
          $sql="SELECT*FROM productos ";     
          $datos=$modelo->mostrardatos($sql);     
           foreach ($datos as $columna) {    
             print '<tr>
          <td>'.$columna['idProductos'].'</td>
          <td>'.$columna['nombre'].'</td>
          <td>'. $columna['cod_barra'].'</td>
          <td>'.$columna['cantidad'].'</td>
          <td>'.$columna['proveedor'].'</td>
          <td>'. $columna['especificaciones'].'</td>
          <td>'.$columna['fecha_caducidad'].'</td>          
          <td>'. $columna['costo_compras'].'</td>
          <td>'.$columna['costo_ventas'].'</td>
          <td>
              <a href="javascript:buscar(2,1,' . $columna['idProductos'] . ',2)">
              <img style="width:20px;"  src="update.png">
              </a>
          
              <a href="javascript:buscar(2,1,' . $columna['idProductos'] . ',5)"> 
              <img style="width:30px;" src="delte.png">
              </a>
          </td>
                              </tr>     ';}                 
                     
                      print ' </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </main>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      
      <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
  </body>
  </html>
      ';
  }
  


function PagoEfectivo(){
print'
  <div class="row" id="formPagoEfectivo" style="display: none;">
  <div class="col mb-3">
      <label for="totalAPagar">Total a pagar:</label>
      <input type="text" id="totalAPagar" class="form-control" placeholder="Total" readonly>
  </div>
  <div class="col mb-3">
      <label for="pagoCon">Pago con:</label>
      <input type="text" id="pagoCon" class="form-control" placeholder="Monto entregado">
  </div>
  <div class="col mb-3">
      <label for="cambio">Cambio:</label>
      <input type="text" id="cambio" class="form-control" placeholder="Cambio a devolver" readonly>
  </div>
</div>';
}

function Reportes(){
  echo '
  <link rel="stylesheet" href="css/bot.css">
  <div class="button-container">
    <h1 class="reporte-titulo">REPORTE</h1>
     <a href="./productos.php" class="comic-button">Productos </a>
     <a href="./excel.php" class="comic-button">Usuarios </a>
     <a href="./reporte.php" class="comic-button">Ventas de Productos </a> <!-- Enlace actualizado para ventas -->
  </div>
  <br>
';
}


function generarReporteVentas() {
  // Aquí pondrías el código para mostrar las ventas, ya sea en formato HTML o leer desde un archivo CSV/JSON
  echo "<h2>Reporte de Ventas</h2>";
  // Ejemplo de mostrar una tabla con las ventas
  if (file_exists('ventas.json')) {
      $ventas = json_decode(file_get_contents('ventas.json'), true);
      echo '<table border="1">
            <tr><th>Empleado</th><th>Fecha</th><th>Cliente</th><th>Productos</th><th>Total</th></tr>';
      foreach ($ventas as $venta) {
          echo '<tr>';
          echo '<td>' . htmlspecialchars($venta['empleado']) . '</td>';
          echo '<td>' . htmlspecialchars($venta['fecha']) . '</td>';
          echo '<td>' . htmlspecialchars($venta['cliente']) . '</td>';
          echo '<td>' . implode(', ', array_map(function ($prod) { return $prod['codigo'] . ' (x' . $prod['cantidad'] . ')'; }, $venta['productos'])) . '</td>';
          echo '<td>' . htmlspecialchars($venta['total']) . '</td>';
          echo '</tr>';
      }
      echo '</table>';
  } else {
      echo 'No se han registrado ventas aún.';
  }
}

?>

