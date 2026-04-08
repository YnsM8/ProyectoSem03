<?php
// Conexión a la base de datos
include "conexion.php"; // Tu archivo conexion.php funciona con $conn

// Consulta para obtener todas las ventas
$sql = "SELECT * FROM ventas ORDER BY id DESC";
$resultado = mysqli_query($conn, $sql);

if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Lista de Ventas</title>
<link rel="stylesheet" href="estilos.css">
<style>
    table {
        width: 90%;
        margin: 30px auto;
        border-collapse: collapse;
        font-family: sans-serif;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 10px 12px;
        text-align: center;
    }
    th {
        background-color: #3498db;
        color: white;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    tr:hover {
        background-color: #ddd;
    }
    h1 {
        text-align: center;
        margin-top: 30px;
    }
    .btn-eliminar {
        padding: 5px 10px;
        background: #c0392b;
        color: white;
        border-radius: 5px;
        text-decoration: none;
    }
    .btn-eliminar:hover {
        background: #a93226;
    }
    .btn-editar {
    background: #1e8449; /* verde oscuro */
    color: white;
    border: none;
    padding: 10px 24px;
    border-radius: 6px;
    font-size: 14px;
    font-family: sans-serif;
    text-decoration: none;
    display: inline-block;
}

.btn-editar:hover {
    background: #196f3d;
}
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
            <th>Acciones</th> <!-- Columna para botones -->
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
                    <td>
                        
                        <a href="editar.php?id=<?= $venta['id'] ?>" class="btn-editar">Editar</a>    
                    
                    <!-- Botón eliminar -->
                        <a href="eliminar.php?id=<?= $venta['id'] ?>" 
                           onclick="return confirm('¿Seguro que quieres eliminar esta venta?');" 
                           class="btn-eliminar">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">No hay ventas registradas.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php mysqli_close($conn); ?>
</body>
</html>