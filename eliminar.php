<?php
/** 
 * 
 * PARA BORRAR UN REGISTRO SE INGRESA A LA URL: http://localhost/Caso01/eliminar.php?id=id_del_registro
 * 
*/
include "conexion.php";
 
$id = $_GET['id'] ?? '';
 
// Validación del id
if (empty($id) || !is_numeric($id)) {
    die("Error: ID no válido.");
}
 
// Si el usuario confirmó la eliminación
if (isset($_POST['confirmar'])) {
    $sql = "DELETE FROM ventas WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Venta eliminada correctamente.');
                window.location.href = 'listar.php';
              </script>";
        exit;
    } else {
        $error = "Error al eliminar: " . mysqli_error($conn);
    }
}
 
// Buscar el registro para mostrarlo en la pantalla de confirmación
$resultado = mysqli_query($conn, "SELECT * FROM ventas WHERE id = $id");
$venta = mysqli_fetch_assoc($resultado);
 
if (!$venta) {
    die("Error: La venta no existe.");
}
?>
 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Venta</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        .confirmar-box {
            max-width: 420px;
            margin: 60px auto;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            font-family: sans-serif;
        }
        .confirmar-box h2 {
            color: #c0392b;
            margin-bottom: 10px;
        }
        .confirmar-box p {
            color: #555;
            margin-bottom: 20px;
        }
        .datos {
            background: #f9f9f9;
            border-radius: 8px;
            padding: 15px;
            text-align: left;
            margin-bottom: 25px;
            font-size: 14px;
            color: #333;
            line-height: 2;
        }
        .botones {
            display: flex;
            gap: 12px;
            justify-content: center;
        }
        .btn-eliminar {
            background: #c0392b;
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }
        .btn-cancelar {
            background: #eee;
            color: #333;
            border: none;
            padding: 10px 24px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
        }
        .btn-eliminar:hover { background: #a93226; }
        .btn-cancelar:hover { background: #ddd; }
        .error { color: #c0392b; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="confirmar-box">
        <h2>&#9888; Confirmar eliminación</h2>
        <p>¿Estás seguro de que deseas eliminar esta venta?</p>
 
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
 
        <div class="datos">
            <strong>ID:</strong> <?= $venta['id'] ?><br>
            <strong>Cliente:</strong> <?= $venta['cliente'] ?><br>
            <strong>Producto:</strong> <?= $venta['producto'] ?><br>
            <strong>Cantidad:</strong> <?= $venta['cantidad'] ?><br>
            <strong>Precio:</strong> S/ <?= number_format($venta['precio'], 2) ?><br>
            <strong>Total:</strong> S/ <?= number_format($venta['total'], 2) ?>
        </div>
 
        <form method="POST" action="eliminar.php?id=<?= $id ?>">
            <div class="botones">
                <button type="submit" name="confirmar" class="btn-eliminar">Sí, eliminar</button>
                <a href="listar.php" class="btn-cancelar">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
<?php mysqli_close($conn); ?>