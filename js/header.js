$(function () {

    if ($('#dep2').val() == '0') {

        $('#mun2').hide();
    }

    $("#btn_buscar").on('click', function () {
        var buscar = ($('#txt_buscar').val() != '')?'/'+$('#txt_buscar').val():'';
        
        window.location.href = '/' + $('#categoria2').val() +
                '/' + $('#dep2').val() + '/' + $('#mun2').val() + buscar;
    });


    $("#dep2").change(function () {

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
    });

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