/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(function () {
    
    $("#input").cleditor();


    $("#dep").change(function () {

        $.get("http://localhost/eros/bd/getMun.php", {iddep: $("#dep").val()})
                .done(function (data) {
                    $('#mun option[value!="-1"]').remove();
                    $('#mun').append($("<option></option>").attr("value", '0').text('Selecciona'));
                    $.each(data, function (index, value) {
                        
                        
                        $('#mun').append($("<option></option>").attr("value", value.idmun).text(value.nombre));

                    });
                }).fail(function () {
                    
                    alert('Error de comunicación');
                });
    });
});