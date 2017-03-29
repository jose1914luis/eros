$(function () {

    if ($('#dep2').val() == '0') {

        $('#mun2').hide();
    }    

    $("#form_buscar").on('submit', (function (e) {

        e.preventDefault();
    }));
    
    $("#txt_buscar").keyup(function (event) {
        if (event.keyCode == 13) {
            var cate = ($('#categoria2').val() != 0) ? ('/' + $('#categoria2').val().replace(/ /g, '-')) + '/' : '';
            var depar = ($('#dep2').val() != 0) ? (((cate.substr(cate.length - 1) == '/') ? '' : '/') + $('#dep2').val()) + '/' : '';
            var muni = ($('#mun2').val() != 0) ? (((depar.substr(depar.length - 1) == '/') ? '' : '/') + $('#mun2').val()) + '/' : '';
            var buscar = ($('#txt_buscar').val() != '' && $('#txt_buscar').val().length > 3) ? ((muni.substr(muni.length - 1) == '/') ? '' : '/') + $('#txt_buscar').val() + '/' : '';
            var url = cate + depar + muni + buscar;
            
            window.location.href = url;
        }
    });

    $("#btn_buscar").on('click', function () {

        var cate = ($('#categoria2').val() != 0) ? ('/' + $('#categoria2').val().replace(/ /g, '-')) + '/' : '';
        var depar = ($('#dep2').val() != 0) ? (((cate.substr(cate.length - 1) == '/') ? '' : '/') + $('#dep2').val()) + '/' : '';
        var muni = ($('#mun2').val() != 0) ? (((depar.substr(depar.length - 1) == '/') ? '' : '/') + $('#mun2').val()) + '/' : '';
        var buscar = ($('#txt_buscar').val() != '' && $('#txt_buscar').val().length > 3) ? ((muni.substr(muni.length - 1) == '/') ? '' : '/') + $('#txt_buscar').val() + '/' : '';
        var url = cate + depar + muni + buscar;
        window.location.href = url;
    });


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