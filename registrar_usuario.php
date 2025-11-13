<?php
// 🔹 Conexión directa (por compatibilidad)
$conexion = new mysqli("localhost", "root", "", "novamarket");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// 🔹 Código original con include y validaciones
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre = trim($_POST["nombre"]);
  $correo = trim($_POST["correo"]);
  $clave = trim($_POST["clave"]);
  $confirmar = trim($_POST["confirmar"]);

  if ($clave !== $confirmar) {
    echo "<script>alert('Las contraseñas no coinciden'); window.history.back();</script>";
    exit;
  }

  // Encriptar la contraseña
  $clave_hash = password_hash($clave, PASSWORD_DEFAULT);

  // Verificar si el correo ya está registrado
  $verificar = $conexion->prepare("SELECT id FROM usuarios WHERE correo = ?");
  $verificar->bind_param("s", $correo);
  $verificar->execute();
  $verificar->store_result();

  if ($verificar->num_rows > 0) {
    echo "<script>alert('El correo ya está registrado'); window.history.back();</script>";
    exit;
  }

  // Insertar nuevo usuario
  $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, correo, password) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $nombre, $correo, $clave_hash);

  if ($stmt->execute()) {
    echo "<script>alert('Registro exitoso. Ahora puedes iniciar sesión'); window.location='login.html';</script>";
  } else {
    echo "<script>alert('Error al registrar usuario'); window.history.back();</script>";
  }

  $stmt->close();
  $conexion->close();
}
?>

