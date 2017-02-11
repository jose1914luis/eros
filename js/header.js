/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(function () {

    $("#dep2").change(function () {

        $.get("getMun.php", {iddep: $("#dep2").val()})
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