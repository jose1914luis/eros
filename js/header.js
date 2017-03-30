$(function () {

    if ($('#dep2').val() == '0') {

        $('#mun2').hide();
    }

    $("#form_buscar").on('submit', (function (e) {

        e.preventDefault();
    }));

    $("#txt_buscar").keyup(function (event) {
        if (event.keyCode == 13) {

            construirURL();
        }
    });

    $("#btn_buscar").on('click', function () {

        construirURL();
    });

    String.prototype.replaceAt = function (index, character) {
        return this.substr(0, index) + character + this.substr(index, character.length);
    };

    var construirURL = function () {
        var cate = ($('#categoria2').val() != 0) ? ('/' + $('#categoria2').val() + '/') : '';
        var depar = ($('#dep2').val() != 0) ? ('/' + $('#dep2').val()) + '/' : '';
        var muni = ($('#mun2').val() != 0) ? ('/' + $('#mun2').val()) + '/' : '';
        var buscar = ($('#txt_buscar').val() != '' && $('#txt_buscar').val().length > 3) ? '/' + $('#txt_buscar').val() + '/' : '';
        var url = cate + depar + muni + buscar;


//        console.log(url);
        for (var i = 0; i < url.length; i++) {

            if (url[i] == '/' && i + 1 < url.length) {
                if (url[i + 1] == '/') {

//                    url = url.replaceAt(i + 1, "a");
                    var index = i + 1;
                    url = url.substr(0, index) + '' + url.substr(index + 1);
                }

            }
//            console.log(url[i]);
        }
//        console.log(url);
        window.location.href = url;
    };


    $("#dep2").change(function () {

        $.get("/bd/getMun.php", {iddep: $("#dep2").val()})
                .done(function (data) {
                    $('#mun2 option[value!="-1"]').remove();
                    $('#mun2').append($("<option></option>").attr("value", '0').text('Ciudad'));
                    $.each(data, function (index, value) {

                        $('#mun2').append($("<option></option>").attr("value", value.m_nombre).text(value.m_nombre));

                    });
                    $('#mun2').show();
                }).fail(function () {

            alert('Error de comunicación');
        });
    });

    var cargar_mun = function () {
        $.get("./bd/getMun.php", {iddep: $("#dep2").val()})
                .done(function (data) {
                    $('#mun2 option[value!="-1"]').remove();
                    $('#mun2').append($("<option></option>").attr("value", '0').text('Ciudad'));
                    $.each(data, function (index, value) {


                        $('#mun2').append($("<option></option>").attr("value", value.m_nombre).text(value.m_nombre));

                    });
                    $('#mun2').show();
                }).fail(function () {

            alert('Error de comunicación');
        });
    }

    var cerrarSession = function () {

        $.post("./bd/entrar.php",
                {
                    cerrar: 1
                }).done(function (data) {

            if (data == 1) {
                window.location.href = ".";
            }
        }).fail(function () {
            alert('Error de comunicación');
        });

    };

    if ($('#btn_session').attr('mostrar') == 1) {

        $('#btn_session').on('click', cerrarSession);
    }

});