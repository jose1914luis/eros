/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(function () {


    $("#publicar").on('submit', (function (e) {
        e.preventDefault();
        console.log(new FormData(this));
//        $("#message").empty();
//        $('#loading').show();
        console.log('entro');
        $.ajax({
            url: "./bd/publicar.php", // Url to which the request is send
            type: "POST", // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false, // To send DOMDocument or non processed data file it is set to false
            success: function (data)   // A function to be called if request succeeds
            {
//                $('#loading').hide();
//                $("#message").html(data);
                  console.log(data);
            },
            fail: function (e){
                console.log(e);
            }
        });
    }));

    $("#input").cleditor();


    for (var j = 1; j <= 5; j++) {
        $('#image_' + j).attr('style', 'visibility: hidden');
        $('#btn_close_' + j).hide();

        $('#btn_mas_' + j).on('click', function () {

            var id = $(this).attr('id');
            $('#file_' + id[id.length - 1]).click();
        });

        $('#btn_close_' + j).on('click', function () {
            var id = $(this).attr('id');
            cerrar_imagen(id[id.length - 1]);
        });

        $("#file_" + j).change(function () {
            var id = $(this).attr('id');
            mostrar_imagen(this, id[id.length - 1]);
        });
    }



    var cerrar_imagen = function (i) {

        $('#image_' + i).attr('src', null);
        $('#image_' + i).attr('style', 'visibility: hidden');
        $('#btn_mas_' + i).show();
        $('#btn_close_' + i).hide();
    };

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




    var mostrar_imagen = function (e, i) {

        var file = e.files[0];
        var imagefile = file.type;
        var match = ["image/jpeg", "image/png", "image/jpg"];
        if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2])))
        {
            alert('seleccione un formato valido "image/jpeg", "image/png", "image/jpg"');
            return false;
        } else
        {
            var reader = new FileReader();
            reader.onload = function (e) {

                $('#btn_mas_' + i).hide();
                $('#image_' + i).attr('style', 'visibility: visible');
                $('#btn_close_' + i).show();
                $('#image_' + i).attr('src', e.target.result);

            };
            reader.readAsDataURL(e.files[0]);
        }
    };

});
