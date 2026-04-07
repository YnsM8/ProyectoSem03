const btnCalcular  = document.querySelectorAll('button[type="submit"]')[0];
const btnRegistrar = document.querySelectorAll('button[type="submit"]')[1];

const nombre   = document.getElementById('nombre');
const producto = document.getElementById('producto');
const cantidad = document.getElementById('cantidad');
const precioU  = document.getElementById('precioU');
const total    = document.getElementById('total');

// Validación
function validar() {
    if (!nombre.value.trim()) {
        alert('Ingrese el nombre del cliente.');
        return false;
    }
    if (!producto.value.trim()) {
        alert('Ingrese el nombre del producto.');
        return false;
    }
    if (!cantidad.value || Number(cantidad.value) <= 0) {
        alert('Ingrese una cantidad válida mayor a 0.');
        return false;
    }
    if (!precioU.value || Number(precioU.value) <= 0) {
        alert('Ingrese un precio unitario válido mayor a 0.');
        return false;
    }
    return true;
}

// Botón Calcular Total
btnCalcular.addEventListener('click', function(e) {
    e.preventDefault();
    if (!validar()) return;
    total.value = (Number(cantidad.value) * Number(precioU.value)).toFixed(2);
});

// Botón Registrar Venta
btnRegistrar.addEventListener('click', function(e) {
    e.preventDefault();
    if (!validar()) return;

    // Calcular total antes de enviar
    total.value = (Number(cantidad.value) * Number(precioU.value)).toFixed(2);

    // Enviar datos al servidor con fetch
    const datos = new FormData();
    datos.append('nombre',   nombre.value);
    datos.append('producto', producto.value);
    datos.append('cantidad', cantidad.value);
    datos.append('precioU',  precioU.value);

    fetch('guardar_venta.php', { method: 'POST', body: datos })
        .then(res => res.text())
        .then(respuesta => alert(respuesta))
        .catch(error => alert('Error al conectar con el servidor.'));
});