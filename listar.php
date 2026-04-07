<?php
include "conexion.php";

// Obtener todas las ventas
$sql = "SELECT * FROM ventas ORDER BY id DESC";
$resultado = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Ventas</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        table { width: 90%; margin: 30px auto; border-collapse: collapse; font-family: sans-serif; }
        th, td { border: 1px solid #ddd; padding: 10px 12px; text-align: center; }
        th { background-color: #3498db; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        tr:hover { background-color: #ddd; }
        h1 { text-align: center; font-family: sans-serif; margin-top: 30px; }
    </style>
</head>
<body>
    <h1>Lista de Ventas Registradas</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php if(mysqli_num_rows($resultado) > 0): ?>
                <?php while($venta = mysqli_fetch_assoc($resultado)): ?>
                    <tr>
                        <td><?= $venta['id'] ?></td>
                        <td><?= htmlspecialchars($venta['cliente']) ?></td>
                        <td><?= htmlspecialchars($venta['producto']) ?></td>
                        <td><?= $venta['cantidad'] ?></td>
                        <td>S/ <?= number_format($venta['precio'], 2) ?></td>
                        <td>S/ <?= number_format($venta['total'], 2) ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No hay ventas registradas.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

<?php mysqli_close($conn); ?>