<?php
include "conexion.php";

$id = $_GET['id'] ?? '';

if (empty($id) || !is_numeric($id)) {
    die("ID no válido");
}

// Obtener datos actuales
$resultado = mysqli_query($conn, "SELECT * FROM ventas WHERE id = $id");
$venta = mysqli_fetch_assoc($resultado);

if (!$venta) {
    die("Venta no encontrada");
}

// Si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente  = $_POST['cliente'];
    $producto = $_POST['producto'];
    $cantidad = $_POST['cantidad'];
    $precio   = $_POST['precio'];
    $total    = $cantidad * $precio;

    $sql = "UPDATE ventas SET 
                cliente='$cliente',
                producto='$producto',
                cantidad='$cantidad',
                precio='$precio',
                total='$total'
            WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Venta actualizada correctamente');
                window.location='listar.php';
              </script>";
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Venta</title>
<link rel="stylesheet" href="estilos.css">
</head>
<body>

<div class="contenedor">
    <h1>Editar Venta</h1>

    <form method="POST">
        <label>Cliente:</label>
        <input type="text" name="cliente" value="<?= $venta['cliente'] ?>">

        <label>Producto:</label>
        <input type="text" name="producto" value="<?= $venta['producto'] ?>">

        <label>Cantidad:</label>
        <input type="number" name="cantidad" value="<?= $venta['cantidad'] ?>">

        <label>Precio:</label>
        <input type="number" step="0.01" name="precio" value="<?= $venta['precio'] ?>">

        <button type="submit">Actualizar</button>
        <a href="listar.php">Cancelar</a>
    </form>
</div>

</body>
</html>

<?php mysqli_close($conn); ?>