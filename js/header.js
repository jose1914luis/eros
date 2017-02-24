/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(function () {
    
    $('#alt_correo').hide();

    $("#btn_buscar").on('click', function (){
        window.location.href = 'index.php?buscar=' + $('#txt_buscar').val() + '&cat='+ $('#categoria2').val()+
                '&depa='+$('#dep2').val() + '&mun='+ $('#mun2').val();
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
});