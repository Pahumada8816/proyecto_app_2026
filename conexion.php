<?php
$host = "localhost";
$usuario = "root"; // Usuario por defecto de XAMPP
$clave = "";       // Por defecto, sin contraseña
$bd = "proyecto_app_2026";

$conexion = new mysqli($host, $usuario, $clave, $bd);

if ($conexion->connect_error) {
  die("Error de conexión: " . $conexion->connect_error);
}
?>
