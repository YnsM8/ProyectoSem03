<?php
include "conexion.php";

// Recibir datos del formulario
$cliente  = $_POST['nombre'];
$producto = $_POST['producto'];
$cantidad = $_POST['cantidad'];
$precio   = $_POST['precioU'];
$total    = $cantidad * $precio;

// Validaciones
if (empty($cliente) || empty($producto)) {
    die("Error: Cliente y producto son obligatorios.");
}
if ($cantidad <= 0) {
    die("Error: La cantidad debe ser mayor a 0.");
}
if ($precio <= 0) {
    die("Error: El precio debe ser mayor a 0.");
}

// Guardar en la base de datos
$sql = "INSERT INTO ventas (cliente, producto, cantidad, precio, total)
        VALUES ('$cliente', '$producto', '$cantidad', '$precio', '$total')";

if (mysqli_query($conn, $sql)) {
    echo "Venta registrada correctamente.";
} else {
    echo "Error al guardar: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
