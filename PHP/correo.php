<?php

require 'vendor/autoload.php';

$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->isSMTP();
$mail->Host = 'sandbox.smtp.mailtrap.io'; // Cambia esto al servidor SMTP que estés usando
$mail->SMTPAuth = true;
$mail->Username = '04d48c3fd012a6'; // Tu dirección de correo
$mail->Password = '9ad2ddf90b0ced'; // Tu contraseña
$mail->SMTPSecure = 'tls';
$mail->Port = 2525;

// Configura el remitente y el destinatario
$mail->setFrom('infseaonline@gmail.com', 'infseaOnline');
$mail->addAddress($correo_electronico, '');

// Configura el asunto y el cuerpo del correo
$mail->Subject = "Reestablecer cuenta";
$mail->Body = "¡Tu cuenta ha sido reestablecida con éxito!";

// Envía el correo
if ($mail->send()) {
    echo 'Correo enviado correctamente.';
} else {
    echo 'Error al enviar el correo: ' . $mail->ErrorInfo;
}
