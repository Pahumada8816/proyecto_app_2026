<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);
    $clave = password_hash(trim($_POST['clave']), PASSWORD_DEFAULT);

    // Verificar si el correo ya existe
    $verificar = $conexion->prepare("SELECT * FROM usuarios WHERE correo = ?");
    $verificar->bind_param("s", $correo);
    $verificar->execute();
    $resultado = $verificar->get_result();

    if ($resultado->num_rows > 0) {
        echo "<script>alert('Este correo ya está registrado.'); window.location='registro.html';</script>";
    } else {
        $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, correo, clave) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nombre, $correo, $clave);
        
        if ($stmt->execute()) {
            echo "<script>alert('Registro exitoso. Ahora puedes iniciar sesión.'); window.location='login.html';</script>";
        } else {
            echo "<script>alert('Error al registrar. Inténtalo nuevamente.'); window.location='registro.html';</script>";
        }

        $stmt->close();
    }

    $verificar->close();
    $conexion->close();
}
?>
