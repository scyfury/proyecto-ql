<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se está utilizando el método POST

    // Obtener el correo electrónico del formulario
    $correo_electronico = $_POST["correovalidar"];

    // Verificar si el campo está vacío
    if (empty($correo_electronico)) {
        echo "Todos los campos son obligatorios";
    } else {
        // Consultar si el correo existe en la base de datos
        $sql_email = "SELECT * FROM usuario WHERE correo_electronico = ?";
        $stmt_email = $conn->prepare($sql_email);
        $stmt_email->bind_param("s", $correo_electronico);
        $stmt_email->execute();
        $result_email = $stmt_email->get_result();

        // Verificar si se encontró algún resultado
        if ($result_email->num_rows > 0) {
            // Correo electrónico encontrado
            // Puedes realizar cualquier acción necesaria aquí
        } else {
            // Correo electrónico no encontrado
            echo "Correo electrónico no registrado";
        }
    }
} else {
    // Si no se utiliza el método POST, mostrar un mensaje de error
    echo "Acceso no permitido";
}
