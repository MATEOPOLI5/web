
<?php

include("modelo.php");
$modelo = new OperacionesBd;

header('Content-Type: application/json');
session_start();

// Mostrar el formulario de ventas en HTML
function mostrarFormularioVentas() {
    global $modelo;
    
    if (!isset($_SESSION['usuario'])) {
        header('Location: login.php');
        exit();
    }

    $nombre = $_SESSION['usuario']['nombre'];
    $apellido_p = $_SESSION['usuario']['apellido_p'];
    $apellido_m = $_SESSION['usuario']['apellido_m'];

    $productos = $modelo->mostrardatos("SELECT nombre, cod_barra, costo_ventas FROM productos");

    echo '

    <form id="productoForm" class="form-container" action="" method="post">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/venta.css">
        <link rel="stylesheet" href="css/pagos.css">
            <link rel="stylesheet" href="css/sweetalert2.min.css">
        <script src="funcion_ajax.js"></script> <!-- Archivo de funciones AJAX -->

        <body class="container mt-5">
           <!-- <h1 class="text-center">Mercadito</h1> -->
            
            
            <div class="row mb-3">
                <div class="col">
                    <label for="empleado">Empleado:</label>
                    <input type="text" id="empleado" class="form-control" value="' . htmlspecialchars($nombre . ' ' . $apellido_p . ' ' . $apellido_m) . '" readonly>
                </div>
                <div class="col">
                    <label for="fecha">Fecha:</label>
                    <input type="date" id="fecha" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="cliente">Cliente:</label>
                    <input type="text" id="cliente" class="form-control" placeholder="Agregar el nombre del cliente">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="producto">Producto:</label>
                    <select id="producto" class="form-select">
                        <option value="">Seleccionar producto</option>';
    
    foreach ($productos as $producto) {
        echo '<option value="' . htmlspecialchars($producto['cod_barra']) . '" data-precio="' . htmlspecialchars($producto['costo_ventas']) . '">' . htmlspecialchars($producto['nombre']) . '</option>';
    }

    echo '      </select>
                </div>
                <div class="col">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" id="cantidad" class="form-control" placeholder="Cantidad del producto a vender">
                </div>
                <div class="col d-flex align-items-end">
                    <button type="button" class="btn btn-custom" onclick="agregarProducto()">Agregar producto</button>
                </div>
            </div>
            <table class="table table-bordered">
                <thead class="table-header">
                    <tr>
                        <th>Productos</th>
                        <th>Código</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Opción</th>
                    </tr>
                </thead>
                <tbody id="tabla-productos">
                    <!-- Los productos se agregarán aquí -->
                </tbody>
            </table>
            <div class="row mb-3">
                <div class="col d-flex justify-content-start">
                    <button type="button" class="btn btn-primary" onclick="cancelarTodo()">Cancelar todo</button>
                </div>
                <div class="col d-flex justify-content-end">
                    <label for="total">Total a pagar:</label>
                    <input type="text" id="total" class="form-control ms-2" placeholder="Total" readonly>
                </div>
            </div>
            
           <div class="row">
    <div class="col">
        <label for="pago">Pagar con:</label>
        <select id="metodo_pago" class="form-select" onchange="showMetodoPago()">
    <option value="">Seleccione método de pago</option>
    <option value="tarjeta">Tarjeta</option>
    <option value="efectivo">Efectivo</option>
</select>

    </div>
</div>
<!-- Contenedor para el formulario de pago -->
<div id="pagoContainer" class="mt-3"></div>

<div id="pagoContainer" class="mt-3">
    <div id="subEfectivo" style="display: none;">
        <h2>Pago en Efectivo</h2>
        <div class="row mb-3">
            
            <div class="col">
                <label>Pago con:</label>
                <input type="number" id="montoPagado" class="form-control" oninput="calcularCambio()">
            </div>
            <div class="col">
                <label>Devolver:</label>
                <input type="text" id="cambio" class="form-control" readonly>
            </div>
        </div>
        <button type="button" class="btn btn-success"  id="Pagar" onclick="guardarVenta()" disabled>Realizar Pago</button>

    </div>

    <div id="subTarjeta" style="display: none;">
        <h2>Pago con Tarjeta</h2>
        
      <div>

        <p id="estadoSenal" class="senial-mal">Sin señal: No puedes realizar el pago en este momento</p>
        <button type="submit" class="btn btn-primary" onclick="verificarSenal()">Verificar señal</button>
    </div>
        
        <form action="pago_tarjeta.php" method="post">
            
            <div class="row mb-3">
                <div class="col">
                    <label>Número de tarjeta:</label>
                    <input type="text" name="numero_tarjeta" class="form-control" id="numeroTarjeta" required oninput="reconocerBanco()">
                    <span id="bancoNombre" style="font-weight: bold; color: #4569d6;"></span>
                </div>
           
                <div class="col">
                    <label>Código de seguridad:</label>
                    <input type="text" name="codigo_seguridad" class="form-control" required>
                </div>
            </div>


            <div class="row mb-3">

            <div class="col">
                <label for="ivaSep">IVA:</label>
                <input type="text" id="ivaSep" class="form-control" oninput="calcularCambioConIVA()" >
            </div>
             
                  <div class="col">
                <label for="TotalIVA">Total + IVA:</label>
                <input type="text" id="TotalIVA" class="form-control" >
            </div>      
        </div>
        <button type="button" class="btn btn-success" id="btnPagar" onclick="guardarVenta()" disabled >Realizar Pago</button>
    </form>
</div>



        </body>
    </form> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
       <script src="js/sweetalert2.all.min.js"></script>
  
    ';
}

// Verificar la acción solicitada
if (isset($_GET['action']) && $_GET['action'] === 'guardarVenta') {
    guardarVenta();
} else {
    mostrarFormularioVentas();
}

function guardarVenta() {
    // Obtener los datos de la venta desde el JSON
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['empleado'], $data['fecha'], $data['cliente'], $data['productos'], $data['total'])) {
        // Crear un objeto de venta con los datos recibidos
        $venta = [
            'empleado' => $data['empleado'],
            'fecha' => $data['fecha'],
            'cliente' => $data['cliente'],
            'productos' => $data['productos'],
            'total' => $data['total']
        ];

        // Leer las ventas existentes desde el archivo (si existe)
        $ventas = [];
        if (file_exists('ventas.json')) {
            $ventas = json_decode(file_get_contents('ventas.json'), true);
        }

        // Agregar la nueva venta a la lista de ventas
        $ventas[] = $venta;

        // Guardar las ventas actualizadas en el archivo JSON
        file_put_contents('ventas.json', json_encode($ventas, JSON_PRETTY_PRINT));

        echo json_encode(["status" => "success", "message" => "El pago fue exitoso, Venta guardada."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Datos incompletos."]);
    }
    
}


?>

