<?php
// Incluir archivo de conexión PHP
include 'conexion.php';

$correo_electronico = $_POST['correo_electronico'];

// Prepara la consulta SQL para verificar si el correo electrónico ya existe
$consulta_correo = $conn->prepare("SELECT * FROM usuario WHERE correo_electronico = ?");
$consulta_correo->bind_param("s", $correo_electronico);
$consulta_correo->execute();
$resultado_correo = $consulta_correo->get_result();

if ($resultado_correo->num_rows > 0) {
    echo 'correo existente';
} else {
    echo 'correo inexistente';
}

$conn->close();
?>