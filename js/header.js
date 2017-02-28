$(function () {

    $('#alt_correo').hide();

    $("#btn_buscar").on('click', function () {
        window.location.href = 'index.php?buscar=' + $('#txt_buscar').val() + '&cat=' + $('#categoria2').val() +
                '&depa=' + $('#dep2').val() + '&mun=' + $('#mun2').val();
    });


    $("#dep2").change(function () {

        $.get("./bd/getMun.php", {iddep: $("#dep2").val()})
                .done(function (data) {
                    $('#mun2 option[value!="-1"]').remove();
                    $('#mun2').append($("<option></option>").attr("value", '0').text('Selecciona'));
                    $.each(data, function (index, value) {


                        $('#mun2').append($("<option></option>").attr("value", value.idmun).text(value.nombre));

                    });
                }).fail(function () {

            alert('Error de comunicación');
        });
    });

    var iniciarSession = function () {

        $.post("./bd/entrar.php",
        {
            usuario:$('#usuario').val(), 
            contra:$('#contra').val()
        }).done(function (data) {
            if(data == 1){
                location.reload();   
            } 
        }).fail(function () {
            alert('Error de comunicación');
        });

    };
    
    var cerrarSession = function () {

        $.post("./bd/entrar.php",
        {
            cerrar:1
        }).done(function (data) {
           
            if(data == 1){
                location.reload();   
            }            
        }).fail(function () {
            alert('Error de comunicación');
        });

    };
    
    $('#btn_ini').on('click', iniciarSession);
    
    if($('#btn_session').attr('mostrar') == 1 ){
        
        $('#btn_session').on('click', cerrarSession);
    }

});