<?php
// 🔹 Conexión directa (por compatibilidad)
$conexion = new mysqli("localhost", "root", "", "novamarket");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// 🔹 Código original con include y validaciones
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $correo = trim($_POST["correo"]);
  $clave = trim($_POST["clave"]);

  $stmt = $conexion->prepare("SELECT id, nombre, password FROM usuarios WHERE correo = ?");
  $stmt->bind_param("s", $correo);
  $stmt->execute();
  $resultado = $stmt->get_result();

  if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();

    if (password_verify($clave, $usuario["password"])) {
      session_start();
      $_SESSION["usuario_id"] = $usuario["id"];
      $_SESSION["usuario_nombre"] = $usuario["nombre"];

      echo "<script>alert('Bienvenido, " . $usuario['nombre'] . "'); window.location='inicio.html';</script>";
    } else {
      echo "<script>alert('Contraseña incorrecta'); window.history.back();</script>";
    }
  } else {
    echo "<script>alert('El correo no está registrado'); window.history.back();</script>";
  }

  $stmt->close();
  $conexion->close();
}
?>

