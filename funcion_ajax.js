//La funcion ajax valida que la version del navegador soporte la funcion
function ajax(){
    var xmlhttp=false;
    try {
            xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
            try {
               xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (E) {
                    xmlhttp = false;
            }
    }
    if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
            xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

function buscar(opcion,div,id,op){
contenedor=Seleccionadiv(div);
objetoajax=ajax();
objetoajax.open("GET", "Lista_Formularios.php?opcion="+ opcion + "&id=" +id + "&op=" + op);
objetoajax.onreadystatechange = function() {
     if (objetoajax.readyState ==4 && objetoajax.status==200) {
    contenedor.innerHTML = objetoajax.responseText; 
}
}
objetoajax.send(null)
}

function Seleccionadiv(div){
    switch (div) {            
            case 1:
                    contenedor=document.getElementById('contenido1');                    
                    break;             
            
            case 2:
                contenedor=document.getElementById('submenu');                    
                break;   
                
                case 3:
                    contenedor=document.getElementById('pagoEfectivo');                    
                    break;   
        }
            return contenedor;            
}



 //FUNCION PARA GUARDAR
function guardar(opcion,div,id,op){
    contenedor=Seleccionadiv(div);
    let datos;
switch(opcion){
    
case 1:
datos="nombre="+document.getElementById('nombre').value
    +"&apellido_p="+document.getElementById('apellido_p').value
    +"&apellido_m="+document.getElementById('apellido_m').value
    +"&clave="+document.getElementById('clave').value        
    +"&telefono="+document.getElementById('telefono').value
    +"&correo="+document.getElementById('correo').value;        
    break;

case 2:
    datos="nombre="+document.getElementById('nombre').value
        +"&cod_barra="+document.getElementById('cod_barra').value
        +"&cantidad="+document.getElementById('cantidad').value
        +"&proveedor="+document.getElementById('proveedor').value        
        +"&especificaciones="+document.getElementById('especificaciones').value
        +"&fecha_caducidad="+document.getElementById('fecha_caducidad').value
        +"&costo_compras="+document.getElementById('costo_compras').value
        +"&costo_ventas="+document.getElementById('costo_ventas').value;        
        break;
        

}
let objetoajax = ajax();
objetoajax.open("POST", "Lista_Formularios.php?opcion=" + opcion + "&id=" + id + "&op=" + op);
objetoajax.onreadystatechange=function() {
 if (objetoajax.readyState==4 && objetoajax.status==200) {

contenedor.innerHTML = objetoajax.responseText   
}
};   
   objetoajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
   objetoajax.send(datos);   
}



    const toggle = document.querySelector(".toggle")
const menuDashboard = document.querySelector(".menu-dashboard")
const iconoMenu = toggle.querySelector("i")
const enlacesMenu = document.querySelectorAll(".enlace")

toggle.addEventListener("click", () => {
    menuDashboard.classList.toggle("open")

    if(iconoMenu.classList.contains("bx-menu")){
        iconoMenu.classList.replace("bx-menu", "bx-x")
    }else {
        iconoMenu.classList.replace("bx-x", "bx-menu")
    }
})

enlacesMenu.forEach(enlace => {
    enlace.addEventListener("click", () => {
        menuDashboard.classList.add("open")
        iconoMenu.classList.replace("bx-menu", "bx-x")
    })
})

// ajax.js
function cargarReportesBotones() {
    fetch('prueba.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'formulario=pruebas'
    })
    .then(response => response.text())
    .then(html => {
        document.getElementById('contenido1').innerHTML = html;
    })
    .catch(error => console.error('Error al cargar el formulario:', error));
}


function cargarFormularioVentas() {
    fetch('venta.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'formulario=ventas'
    })
    .then(response => response.text())
    .then(html => {
        document.getElementById('contenido1').innerHTML = html;
    })
    .catch(error => console.error('Error al cargar el formulario:', error));
}


function cargarContenido(url, contenedorId) {
    const contenedor = document.getElementById(contenedorId);
    const xhr = ajax();
    
    xhr.open("GET", url, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
           // contenedor.innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}

function obtenerProductosAjax() {
    cargarContenido("venta.php?action=obtenerProductos", "producto");
}

function agregarProducto() {
    // Accede al valor del producto y cantidad seleccionados
    const producto = document.getElementById("producto").value;
    const cantidad = document.getElementById("cantidad").value;

    if (!producto || cantidad <= 0) {
        alert("Seleccione un producto válido y una cantidad.");
        return;
    }

    // Aquí puedes agregar la lógica para agregar el producto al DOM
    const productoData = productosDisponibles.find(p => p.nombre === producto);
    if (productoData) {
        const total = productoData.costo_ventas * cantidad;
        productos.push({
            nombre: productoData.nombre,
            cod_barra: productoData.cod_barra,
            precio: productoData.costo_ventas,
            cantidad: cantidad,
            total: total
        });
        actualizarTabla();
        actualizarTotal();
    }
}

function actualizarTabla() {
    const tabla = document.getElementById("tabla-productos");
    tabla.innerHTML = productos.map((prod, index) => `
        <tr>
            <td>${prod.nombre}</td>
            <td>${prod.cod_barra}</td>
            <td>${prod.precio}</td>
            <td>${prod.cantidad}</td>
            <td>${prod.total}</td>
            <td><button class="btn btn-link" onclick="cancelarProducto(${index})">Cancelar</button></td>
        </tr>`).join('');
}

function cancelarProducto(index) {
    productos.splice(index, 1);
    actualizarTabla();
    actualizarTotal();
}

function actualizarTotal() {
    const total = productos.reduce((acc, prod) => acc + parseFloat(prod.total), 0);
    document.getElementById("total").value = total.toFixed(2);
}

document.addEventListener("DOMContentLoaded", obtenerProductosAjax);

function agregarProducto() {
    // Obtener el producto seleccionado y la cantidad
    const productoSelect = document.getElementById("producto");
    const cantidadInput = document.getElementById("cantidad");
    const tablaProductos = document.getElementById("tabla-productos");

    const productoSeleccionado = productoSelect.options[productoSelect.selectedIndex];
    const nombreProducto = productoSeleccionado.text;
    const codigoProducto = productoSeleccionado.value;
    const precioProducto = parseFloat(productoSeleccionado.dataset.precio);
    const cantidadProducto = parseInt(cantidadInput.value);

    // Validar que se haya seleccionado un producto y que la cantidad sea válida
    if (codigoProducto === "" || isNaN(cantidadProducto) || cantidadProducto <= 0) {
        alert("Por favor, selecciona un producto y especifica una cantidad válida.");
        return;
    }

    // Calcular el total para este producto
    const totalProducto = precioProducto * cantidadProducto;

    // Crear una nueva fila en la tabla de productos
    const nuevaFila = tablaProductos.insertRow();
    
    // Insertar las celdas en la nueva fila
    nuevaFila.insertCell(0).innerText = nombreProducto;
    nuevaFila.insertCell(1).innerText = codigoProducto;
    nuevaFila.insertCell(2).innerText = `$${precioProducto.toFixed(2)}`;
    nuevaFila.insertCell(3).innerText = cantidadProducto;
    nuevaFila.insertCell(4).innerText = `$${totalProducto.toFixed(2)}`;
    
    // Agregar un botón para eliminar la fila (opcional)
    const btnEliminar = document.createElement("button");
    btnEliminar.innerText = "Eliminar";
    btnEliminar.className = "btn btn-danger btn-sm";
    btnEliminar.onclick = function() {
        tablaProductos.deleteRow(nuevaFila.rowIndex - 1); // Eliminar la fila correspondiente
        calcularTotal(); // Recalcular el total después de eliminar
    };
    nuevaFila.insertCell(5).appendChild(btnEliminar);

    // Limpiar el input de cantidad
    cantidadInput.value = "";

    // Recalcular el total de la venta
    calcularTotal();
}

function calcularTotal() {
    const tablaProductos = document.getElementById("tabla-productos");
    let total = 0;

    // Recorrer las filas de la tabla para calcular el total
    for (let i = 0; i < tablaProductos.rows.length; i++) {
        const fila = tablaProductos.rows[i];
        const totalCelda = fila.cells[4].innerText.replace('$', '').replace(',', '');
        total += parseFloat(totalCelda);
    }

    // Actualizar el total en el formulario
    document.getElementById("total").value = `$${total.toFixed(2)}`;
}

function cancelarTodo() {
    console.log('Cancelando todo...'); // Para depurar
    document.getElementById('tabla-productos').innerHTML = '';
    document.getElementById('total').value = '';
}

function showSubmenu(id) {
    // Ocultar todos los submenús
    document.querySelectorAll('.submenu').forEach(submenu => {
        submenu.style.display = 'none';
    });
    // Mostrar el submenú seleccionado
    document.getElementById(id).style.display = 'block';
}



function mostrarFormularioPago() {
    calcularTotal(); // Asegurarte de que el total esté actualizado

    const metodoPago = document.getElementById("pago").value;
    const pagoContainer = document.getElementById("pagoContainer");

    // Extraer el total calculado desde el input total
    const totalVenta = document.getElementById("total").value.replace('$', ''); // Remueve el símbolo de $

    if (metodoPago === "efectivo") {
        pagoContainer.innerHTML = `
            <div class="row mb-3">
                <div class="col">
                    <label>Total:</label>
                    <input type="text" id="totalEfectivo" class="form-control" value="${totalVenta}" readonly>
                </div>
                <div class="col">
                    <label>Pago con:</label>
                    <input type="number" id="pagoCon" class="form-control" oninput="calcularCambios()">
                </div>
                <div class="col">
                    <label>Devolver:</label>
                    <input type="text" id="devolver" class="form-control" readonly>
                </div>
            </div>
            
                <button type="submit" class="btn btn-primary" onclick="guardarVenta()">Realizar Pago</button>
        `;
    } else if (metodoPago === "tarjeta") {
        pagoContainer.innerHTML = `
            <form action="pago_tarjeta.php" method="post">
            <div class="tarjeta-iconos">
                        <img src="visa-icon.png" alt="Visa">
                        <img src="mastercard-icon.png" alt="Mastercard">
                        <img src="amex-icon.png" alt="American Express">
                    </div>
                <div class="row mb-3">
                    <div class="col">
                        <label>Nombre en la tarjeta:</label>
                        <input type="text" name="nombre_tarjeta" class="form-control" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label>Número de tarjeta:</label>
                        <input type="text" name="numero_tarjeta" class="form-control" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label>Código de seguridad:</label>
                        <input type="text" name="codigo_seguridad" class="form-control" required>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary" >Realizar Pago</button>
            </form>
        `;
    } else {
        pagoContainer.innerHTML = ""; // Limpia el contenedor si no se selecciona nada
    }
}


function calcularCambios() {
    const total = parseFloat(document.getElementById("totalEfectivo").value);
    const pagoCon = parseFloat(document.getElementById("pagoCon").value);
    const devolver = document.getElementById("devolver");

    if (!isNaN(total) && !isNaN(pagoCon)) {
        devolver.value = (pagoCon - total).toFixed(2);
    } else {
        devolver.value = "";
    }
}


function showMetodoPago() {
    var metodoPago = document.getElementById("metodo_pago").value;
    document.getElementById("subEfectivo").style.display = metodoPago === "efectivo" ? "block" : "none";
    document.getElementById("subTarjeta").style.display = metodoPago === "tarjeta" ? "block" : "none";
    document.getElementById("subTransferencia").style.display = metodoPago === "transferencia" ? "block" : "none";

     // Obtener el valor de 'campo1'
     const valorCampo1 = document.getElementById("total").value;
     
     // Asignar el valor de 'campo1' a 'campo2'
     document.getElementById("total2").value = valorCampo1;
     document.getElementById("total3").value = valorCampo1;
     document.getElementById("total4").value = valorCampo1;
    // Obtener el total y asignarlo al campo de efectivo
    var totalVenta = document.getElementById('total').value;
    document.getElementById('total').value = totalVenta;
}

function calcularCambio() {
    const total = parseFloat(document.getElementById('total').value.replace('$', ''));
    const montoPagado = parseFloat(document.getElementById('montoPagado').value);
    const cambioElement = document.getElementById('cambio');
    const Pagar = document.getElementById('Pagar');

    if (isNaN(total) || isNaN(montoPagado)) {
        // Si los valores no son válidos, limpia el campo de cambio y deshabilita el botón
        cambioElement.value = "";
        Pagar.disabled = true;
        return;
    }

    const cambio = montoPagado - total;

    if (cambio < 0) {
        // Si el pago es insuficiente, muestra advertencia y deshabilita botón de pago
        cambioElement.value = "Pago insuficiente";
        cambioElement.style.color = "red"; // Color rojo para destacar el mensaje
        Pagar.disabled = true; // Deshabilita el botón de pago
    } else {
        // Si el pago es suficiente, muestra el cambio y habilita el botón de pago
        cambioElement.value = cambio.toFixed(2);
        cambioElement.style.color = "black"; // Restaura el color del texto
        Pagar.disabled = false; // Habilita el botón de pago
    }
}

// Llama a calcularCambio cada vez que el usuario cambia el valor en los campos
document.getElementById('montoPagado').addEventListener('input', calcularCambio);
document.getElementById('total').addEventListener('input', calcularCambio);


async function imprimirTicket() {
    const { jsPDF } = window.jspdf;

    const empleado = document.getElementById('empleado').value;
    const fecha = document.getElementById('fecha').value;
    const cliente = document.getElementById('cliente').value;
    const metodo_pago = document.getElementById('metodo_pago').value;
    const productos = Array.from(document.querySelectorAll('#tabla-productos tr')).map(row => ({
        nombre: row.cells[0].innerText,
        codigo: row.cells[1].innerText,
        precio: row.cells[2].innerText,
        cantidad: row.cells[3].innerText,
        total: row.cells[4].innerText
    }));
    const total = document.getElementById('total').value;

    const doc = new jsPDF();
    


        // Agregar el título y el contenido del ticket
        doc.setFontSize(18);
        doc.text("Tienda \"El mercadito\"", 70, 20);
        
        doc.setFontSize(12);
        doc.text(`Empleado: ${empleado}`, 10, 50);
        doc.text(`Fecha: ${fecha}`, 10, 60);
        doc.text(`Cliente: ${cliente}`, 10, 70);
        doc.text(`Metodo pago: ${metodo_pago}`, 10, 40);
        doc.text("====================================================================", 10, 95);

        // Cabecera de la tabla
        doc.text("Cant.", 10, 90);
        doc.text("Descripción", 30, 90);
        doc.text("Cod Barra", 90, 90);
        doc.text("Precio", 130, 90);
        doc.text("Importe", 160, 90);

        let y = 100; // posición vertical inicial

        productos.forEach(producto => {
            doc.text(producto.cantidad, 10, y);
            doc.text(producto.nombre, 30, y);
            doc.text(producto.codigo, 90, y);
            doc.text(producto.precio, 130, y);
            doc.text(producto.total, 160, y);

            y += 10; // incrementa la posición vertical
        });

        // Total
        doc.text(`Total: ${total}`, 10, y + 10);
        doc.text(`Número de artículos: ${productos.length}`, 10, y + 20);
        doc.text(`Gracias por su compra!`, 10, y + 30);
        doc.text(`Vuelva PRONTO!`, 10, y + 40);
        // Descargar el PDF
        doc.save('ticket_venta.pdf');
         // Recargar la página después de imprimir el ticket
         window.location.reload();
    ;
    
}






window.onload = function() {
    verificarSenal();
};

function verificarSenal() {
    const estadoSenal = document.getElementById('estadoSenal');
    const btnPagar = document.getElementById('btnPagar');
    const ticket = document.getElementById('ticket');
    
    
    const haySenal = Math.random() < 0.5;  // 50% de probabilidad de que haya señal
    
    
    if (haySenal) {
        estadoSenal.textContent = 'Con señal: Puedes realizar el pago';
        estadoSenal.classList.remove('senial-mal');
        estadoSenal.classList.add('senial-ok');
        btnPagar.disabled = false;
        ticket.disabled = false;
    } else {
        estadoSenal.textContent = 'Sin señal: No puedes realizar el pago en este momento';
        estadoSenal.classList.remove('senial-ok');
        estadoSenal.classList.add('senial-mal');
        btnPagar.disabled = true;
        ticket.disabled = true;
    }
}

function reconocerBanco() {
    const numeroTarjeta = document.getElementById('numeroTarjeta').value;
    const bancoNombre = document.getElementById('bancoNombre');
    const total = parseFloat(document.getElementById("total").value) || 0;

    const primerosCuatro = numeroTarjeta.substring(0, 4);
    let banco = "Otro";
    let iva = 15.08; // IVA predeterminado para "Otro"

    // Determinar el banco y el IVA basado en los primeros 4 dígitos
    switch (primerosCuatro) {
        case '1000':
            banco = 'Banorte';
            iva = 2.08;
            break;
        case '1100':
            banco = 'BBVA';
            iva = 3.60;
            break;
        case '1110':
            banco = 'Banamex';
            iva = 3.10;
            break;
        case '1111':
            banco = 'Banco Azteca';
            iva = 3.11;
            break;
        case '1112':
            banco = 'Santander';
            iva = 2.12;
            break;
        case '1122':
            banco = 'American Express';
            iva = 2.90;
            break;
        default:
            banco = 'Otro';
            iva = 15.08;
            break;
    }

    // Mostrar el banco y el IVA correspondiente
    bancoNombre.textContent = `Banco: ${banco} | IVA: ${iva}%`;   
}


function calcularCambioConIVA() {
    const total = parseFloat(document.getElementById('total').value.replace('$', '')); // Total sin IVA
    const iva = parseFloat(document.getElementById('ivaSep').value); // IVA correspondiente (puede ser calculado previamente)
    //const montoPagado = parseFloat(document.getElementById('montoPagado').value); // Monto pagado por el cliente

    // Calcular el IVA en valor monetario
    const ivaCalculado = total * (iva / 100);
    
    // Calcular el total con IVA
    const TotalIVA = total + ivaCalculado;
    
    // Calcular el cambio

    // Mostrar el total con IVA y el cambio
    document.getElementById('TotalIVA').value = TotalIVA.toFixed(2); // Mostrar el total con IVA
}


function guardarVenta() {
    const empleado = document.getElementById('empleado').value;
    const fecha = document.getElementById('fecha').value;
    const cliente = document.getElementById('cliente').value;
    const total = document.getElementById('total').value;
    
    // Recoger los datos de los productos de la tabla
    const productos = [];
    document.querySelectorAll('#tabla-productos tr').forEach(row => {
        const producto = {
            nombre: row.cells[0].innerText,
            codigo: row.cells[1].innerText,  // Obtener el código de barra
            cantidad: row.cells[3].innerText, // Obtener la cantidad
            precio: row.cells[2].innerText,   // Obtener el precio
            total: row.cells[4].innerText    // Obtener el total
        };
        productos.push(producto);
    });

    // Enviar los datos al servidor usando fetch
    fetch('venta.php?action=guardarVenta', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            empleado: empleado,
            fecha: fecha,
            cliente: cliente,
            productos: productos,  // Enviar los productos como un array
            total: total
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            alert(data.message);
            imprimirTicket();
            // Opcional: Limpiar el formulario o redirigir
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}

/*
function verificarTransferencia() {
    const total = parseFloat(document.getElementById('total4').value.replace('$', ''));
    const montoTransferencia = parseFloat(document.getElementById('montoTransferencia').value);
    const numeroCuenta = document.getElementById('numeroCuenta').value;
    const pinTransferencia = document.getElementById('pinTransferencia').value;
    const mensajeTransferencia = document.getElementById('mensajeTransferencia');
    const btnTransferir = document.getElementById('btnTransferir');

    // Verificar si todos los campos están llenos
    if (!montoTransferencia || !numeroCuenta || !pinTransferencia) {
        mensajeTransferencia.textContent = "Por favor, complete todos los campos.";
        mensajeTransferencia.style.color = "red";
        btnTransferir.disabled = true;
        return;
    }

    // Verificar si el monto es suficiente
    const diferencia = montoTransferencia - total;
    if (diferencia < 0) {
        mensajeTransferencia.textContent = "Monto insuficiente para realizar la transferencia.";
        mensajeTransferencia.style.color = "red";
        btnTransferir.disabled = true;
    } else {
        mensajeTransferencia.textContent = "Monto suficiente para realizar la transferencia.";
        mensajeTransferencia.style.color = "green";
        btnTransferir.disabled = false;
    }

    // Verificar el banco
    reconocerBancoTransferencia(numeroCuenta);

    // Validar el PIN
    if (pinTransferencia.length !== 4) {
        mensajeTransferencia.textContent = "El PIN debe ser de 4 dígitos.";
        mensajeTransferencia.style.color = "red";
        btnTransferir.disabled = true;
    }
}

function reconocerBancoTransferencia(numeroCuenta) {
    const bancoNom = document.getElementById('bancoNom');
    if (numeroCuenta.length >= 4) {
        const primerosCuatro = numeroCuenta.substring(0, 4);
        let banco = "Otro";

        // Determinar el banco basado en los primeros 4 dígitos
        switch (primerosCuatro) {
            case '1000':
                banco = 'Banorte';
                break;
            case '1100':
                banco = 'BBVA';
                break;
            case '1110':
                banco = 'Banamex';
                break;
            case '1111':
                banco = 'Banco Azteca';
                break;
            case '1112':
                banco = 'Santander';
                break;
            case '1122':
                banco = 'American Express';
                break;
            default:
                banco = 'Otro';
                break;
        }

        // Mostrar el banco correspondiente
        bancoNom.textContent = `Banco: ${banco}`;
    } else {
        bancoNom.textContent = '';  // Clear the bank name if input is invalid
    }
}

document.getElementById('montoTransferencia').addEventListener('input', verificarTransferencia);
document.getElementById('numeroCuenta').addEventListener('input', verificarTransferencia);
document.getElementById('pinTransferencia').addEventListener('input', verificarTransferencia);
*/