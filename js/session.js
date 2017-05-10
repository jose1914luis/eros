$(function () {

    $('#alt_correo').hide();
    $('#contra').keypress(function (e) {
        if (e.which == 13) {
            iniciarSession();
        }
    });

});

var mostrar = function () {
    if ($('#contra').attr('type') == 'password') {
        $('#contra').attr('type', 'text');
    } else {
        $('#contra').attr('type', 'password');
    }
};

var iniciarSession = function () {

    if (validarDatos()) {

        $.post("/bd/entrar.php",
                {
                    usuario: $('#usuario').val(),
                    contra: $('#contra').val()
                }).done(function (data) {
            console.log(data);
            if (data == 1) {
                window.location.href = "panel";
            } else {
                alert('Datos incorrectos. Imposible iniciar sesion');
            }
        }).fail(function () {
            alert('Error de comunicación');
        });
    }
};

var validarDatos = function () {
    // validacion de correo electr�nico:
    patron = /^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
    if ($('#usuario').val().search(patron) < 0) {
        alert("'Correo Electr\u00F3nico' no posee caracteres v\u00E1lidos");
//        document.frmAdminUser.txtEmail.focus();
        return false;
    }


    // validacion de contrase�as: longitud de la contrase�a
    if ($('#contra').val().length < 5) {
        alert("La Contrase\u00F1a no debe ser inferior a 6 caracteres");
//        document.frmAdminUser.txtPassword.focus();
        return false;
    }

    return true;

};