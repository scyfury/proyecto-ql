<?php
// Incluir archivo de conexión PHP
include 'conexion.php';

// Iniciar la sesión
session_start();

// Verifica si se han enviado datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];

    // Validar que los campos no estén vacíos
    if (empty($usuario) || empty($contrasena)) {
        echo "Todos los campos son obligatorios.";
    } else {
        // Escapa los datos enviados desde el formulario para prevenir inyecciones SQL
        $usuario = $conn->real_escape_string($usuario);

        // Consulta SQL para verificar si el usuario existe
        $consulta = "SELECT * FROM usuario WHERE nombre_usuario = '$usuario'";
        $resultado = $conn->query($consulta);

        if ($resultado->num_rows > 0) {
            // El usuario existe en la base de datos
            $fila = $resultado->fetch_assoc();
            
            // Verifica si la contraseña coincide
            if ($fila['contrasena'] === $contrasena) {
                // La contraseña coincide, el usuario puede iniciar sesión
                // Almacena el nombre de usuario en la sesión
                $_SESSION['usuario'] = $usuario;
                
                // Obtener el nombre de usuario de la sesión
                $nombreUsuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : "";

                // Definir el contenido JavaScript
                $contenidoJS = "var usuariojs = '$nombreUsuario';";

                // Escribir el contenido en el archivo dato.js
                file_put_contents('../JS/dato.js', $contenidoJS);
                // Redirige al usuario a sesion.html
                header("Location: ../HTML/sesion.html");
                exit(); // Asegura que el script se detenga después de la redirección
            } else {
                // La contraseña no coincide
                echo "Contraseña incorrecta.";
            }
        } else {
            // El usuario no existe en la base de datos
            echo "El usuario no existe.";
        }        
    }

}

$conn->close();
?>
