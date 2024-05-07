$(document).ready(function(){
    $('#btn_registrarse').click(function(event){
        event.preventDefault(); // Evita que el formulario se envíe de inmediato
 
        // Obtén los valores de los campos del formulario
        var correo = $('#floatingInput').val();
        var usuario = $('#floatingUser').val();
        var contrasena = $('#floatingPassword').val();
 
        // Verifica que todos los campos estén llenos
        if (correo === '' || usuario === '' || contrasena === '') {
            Swal.fire({
                title: "Error!",
                text: "Por favor, rellena todos los campos.",
                icon: "error"
            });
        } else {
            // Verifica que el correo electrónico sea de Gmail, Hotmail o Yahoo
            var regexCorreo = /^[\w-]+(\.[\w-]+)*@((gmail\.com)|(hotmail\.com)|(yahoo\.com))$/;
            if (!regexCorreo.test(correo)) {
                Swal.fire({
                    title: "Error!",
                    text: "Por favor, introduce un correo electrónico de Gmail, Hotmail o Yahoo.",
                    icon: "error"
                });
            } else {
                // Verifica que el nombre de usuario no contenga caracteres especiales
                var regexUsuario = /^[a-zA-Z0-9]+$/;
                if (!regexUsuario.test(usuario)) {
                    Swal.fire({
                        title: "Error!",
                        text: "El nombre de usuario no debe contener caracteres especiales.",
                        icon: "error"
                    });
                } else {
                    // Realiza una solicitud AJAX al servidor para verificar si el usuario o correo electrónico ya existen en la base de datos
                    $.ajax({
                        url: '../PHP/verificador.php',
                        type: 'post',
                        data: {
                            'correo_electronico': correo,
                            'nombre_usuario': usuario,
                            'contrasena': contrasena
                        },
                        success: function(response) {
                            if (response === 'usuario existente') {
                                Swal.fire({
                                    title: "Error!",
                                    text: "El nombre de usuario no está disponible.",
                                    icon: "error"
                                });
                            } else if (response === 'correo existente') {
                                Swal.fire({
                                    title: "Error!",
                                    text: "El correo electrónico no está disponible.",
                                    icon: "error"
                                });
                            } else {
                                // Aquí iría el código para registrar al usuario en la base de datos
                                $.ajax({
                                    url: '../PHP/verificador.php',
                                    type: 'post',
                                    data: {
                                        'correo_electronico': correo,
                                        'nombre_usuario': usuario,
                                        'contrasena': contrasena
                                    },
                                    success: function(response) {
                                        Swal.fire({
                                            title: "Registrado exitosamente!",
                                            text: "Haz click en el boton inicio!",
                                            icon: "success"
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.location.href = "../indexreal.html";
                                            }
                                        });
                                    }
                                });
                            }
                        }
                    });
                }
            }
        }
    });
});