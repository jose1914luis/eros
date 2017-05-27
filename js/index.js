function eliminarAnuncio(id) {

    if (confirm('Estas seguro que deseas eliminar este anuncio?')) {

        $.post("/bd/modificar.php",
                {
                    id_anuncio: id, operacion: 'delete'
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
function promocion(id, promo) {
    
    $.post("/bd/modificar.php",
            {
                 id_anuncio: id, 'promo': promo, 'operacion': 'promocion'
            }).done(function (data) {
                console.log(data);
        if (data != 1) {
            alert('El anuncio no fue promobido');
        }
    }).fail(function () {
        alert('Error de comunicación');
    });
}

var mostrar_d = true;
var mostrar_dep = function () {
    if (mostrar_d) {
        for (var i = 0; i < 33; i++) {
            $('#deph_' + i).attr("class", "show");
        }
        $('#txt_dep').html("Ver menos...<span class= ' conteo glyphicon glyphicon-triangle-top'></span>");
        mostrar_d = false;
    } else {
        for (var i = 11; i < 33; i++) {
            $('#deph_' + i).attr("class", "hidden");
        }
        $('#txt_dep').html("Ver mas... <span class= ' conteo glyphicon glyphicon-triangle-bottom'></span>");
        mostrar_d = true;
    }

};


var mostrar_m = true;
var mostrar_mun = function () {
    if (mostrar_m) {
        for (var i = 0; i < mostrar_m_num; i++) {
            $('#munh_' + i).attr("class", "show");
        }
        $('#txt_mun').html("Ver menos...<span class= ' conteo glyphicon glyphicon-triangle-top'></span>");
        mostrar_m = false;
    } else {
        for (var i = 11; i < mostrar_m_num; i++) {
            $('#munh_' + i).attr("class", "hidden");
        }
        $('#txt_mun').html("Ver mas... <span class= ' conteo glyphicon glyphicon-triangle-bottom'></span>");
        mostrar_m = true;
    }

};