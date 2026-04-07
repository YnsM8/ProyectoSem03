<?php
$host     = "localhost";
$usuario  = "root";
$password = "";
$base     = "ventas_db";

$conn = mysqli_connect($host, $usuario, $password, $base);

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>