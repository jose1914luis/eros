function eliminarAnuncio(id) {

    if (confirm('Estas seguro que deseas eliminar este anuncio?')) {

        $.post("./bd/modificar.php",
                {
                    id_anuncio: id, 'operacion': 'delete'
                }).done(function (data) {
            if (data == 1) {
                location.reload();
            } else {
                alert('El anuncio no fue borrado');
            }
        }).fail(function () {
            alert('Error de comunicación');
        });
    }
}

function republicar(id) {
    $.post("./bd/modificar.php",
            {
                id_anuncio: id, 'operacion': 'republicar'
            }).done(function (data) {
        if (data == 1) {
            alert('El anuncio fue republicado');
        } else {
            alert('El anuncio no fue republicado');
        }
    }).fail(function () {
        alert('Error de comunicación');
    });
}

function promocionar(id) {
    alert('Funcion no disponible');
}

