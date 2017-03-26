function eliminarAnuncio(id) {

    if (confirm('Estas seguro que deseas eliminar este anuncio?')) {

        $.post("./bd/modificar.php",
                {
                    id_anuncio: id
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

function republicar(id){
    alert('Funcion no disponible');
}

function promocionar(id){
    alert('Funcion no disponible');
}

