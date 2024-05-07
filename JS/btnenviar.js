$(document).ready(function(){
    $('#btn_enviar').click(function(event){
        event.preventDefault(); // Evita que el formulario se envíe de inmediato

        // Recoge el valor del campo de correo electrónico justo antes de enviar la solicitud AJAX
        var correo = $('#floatingInput').val();

        // Verifica que todos los campos estén llenos
        if (correo === '') {
            Swal.fire({
                title: "Error!",
                text: "Por favor, rellena todos los campos.",
                icon: "error"
            });
        } else {
            // Realiza una solicitud AJAX al servidor para verificar si el correo electrónico ya existe en la base de datos
            $.ajax({
                url: '../PHP/validacorreo.php',
                type: 'post',
                data: {
                    'correo_electronico': correo,
                },
                success: function(response) {
                    if (response.trim() === 'correo existente') {
                        Swal.fire({
                            title: "Correo enviado!!",
                            text: "Contraseña restablecida con exito!.",
                            icon: "success"
                        });
                    } else if (response.trim() === 'correo inexistente') {
                        Swal.fire({
                            title: "Error!",
                            text: "El correo electrónico no está registrado.",
                            icon: "error"
                        });
                    }
                }
            });
        }
    });
});