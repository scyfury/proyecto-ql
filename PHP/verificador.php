<?php
// Incluir archivo de conexión PHP
include 'conexion.php';

$correo_electronico = $_POST['correo_electronico'];
$nombre_usuario = $_POST['nombre_usuario'];
$contrasena = $_POST['contrasena']; // Asegúrate de tener un campo de contraseña en tu formulario

// Prepara la consulta SQL para verificar si el nombre de usuario ya existe
$consulta_usuario = $conn->prepare("SELECT * FROM usuario WHERE nombre_usuario = ?");
$consulta_usuario->bind_param("s", $nombre_usuario);
$consulta_usuario->execute();
$resultado_usuario = $consulta_usuario->get_result();

if ($resultado_usuario->num_rows > 0) {
    echo 'usuario existente';
} else {
    // Prepara la consulta SQL para verificar si el correo electrónico ya existe
    $consulta_correo = $conn->prepare("SELECT * FROM usuario WHERE correo_electronico = ?");
    $consulta_correo->bind_param("s", $correo_electronico);
    $consulta_correo->execute();
    $resultado_correo = $consulta_correo->get_result();

    if ($resultado_correo->num_rows > 0) {
        echo 'correo existente';
    } else {
        // Prepara la consulta SQL para insertar los datos del usuario en la base de datos
        $consulta_insertar = $conn->prepare("INSERT INTO usuario (nombre_usuario, correo_electronico, contrasena) VALUES (?, ?, ?)");
        $consulta_insertar->bind_param("sss", $nombre_usuario, $correo_electronico, $contrasena);
        $consulta_insertar->execute();

        echo 'usuario y correo disponibles';
    }
}

$conn->close();
?>