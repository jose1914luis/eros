/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var addImages = [];

$(function () {



    $('#div_alerta').hide();
    var validar = function () {

        if ($('#editor').val().length < 50) {
            alert('Debes ingresar una descripcion mas larga');
            $('#editor').focus();
            return false;
        }
        return true;
    };

    $("#publicar").on('submit', (function (e) {
        e.preventDefault();

        if(!validar())return;     

        $('#numfiles').attr('value', addImages.length);
        var datos = new FormData(this);

        for (var i = 0; i < addImages.length; i++) {

            datos.append('file_' + (i + 1), addImages[i]);
        }
        $.ajax({
            url: "./bd/publicar.php", // Url to which the request is send
            type: "POST", // Type of request to be send, called as method
            data: datos, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false, // To send DOMDocument or non processed data file it is set to false
            success: function (data)   // A function to be called if request succeeds
            {
                
                $("html, body").animate({
                    scrollTop: 0
                }, 900);

                $("#publicar").find("input, textarea").val("");
                $('#div_alerta').show();
                $('#anuncio').scrollTop();
                cerrarTodas();
                if (data > 0) {

                    $('#div_alerta').attr('class', 'alert alert-success');
                    $('#div_alerta').text('');
                    $('#div_alerta').html('<b>Genial!! Tu anuncio fue creado satisfactoriamente</b>, ' +
                            'se te envio un correo con un numero de registro y la informacion ' +
                            'adicional para que puedas promover tu anuncio y obtener mejores resultados. ' +
                            '<a href="index.php?idanuncio=' + data + '">ver anuncio</a> ');
                } else {

                    $('#div_alerta').attr('class', 'alert alert-danger');
                    $('#div_alerta').text('');
                    $('#div_alerta').html('<b>Ups hubo un Error!!.</b> Por favor vuelve a intentar.');
                }
            },
            fail: function (e) {

                alerta('Error: ' + e + '. Vuelve a intentar.');
            }
        });
    }));


    $("#editor").cleditor({controls: // controls to add to the toolbar
                "bold italic underline strikethrough subscript superscript | font size " +
                "style | color highlight removeformat | bullets numbering | outdent " +
                "indent | alignleft center alignright justify | undo redo | " +
                "rule link unlink | cut copy paste pastetext"});

    var cledDesc = $("#editor").cleditor()[0];
    var frameDesc = cledDesc.$frame[0].contentWindow.document;

    $(frameDesc).bind('keydown change', function (event) {

        var text = cledDesc.$area.val();

        if (text.length >= 32700 && event.which != 8) {
            console.log("Longer than MaxLength");
            //lose focus / stop writing
            return false;
        } else {
            //Do something
        }
    });

    for (var j = 1; j <= 8; j++) {
        $('#image_' + j).attr('style', 'visibility: hidden');

        $('#btn_close_' + j).hide();

        $('#btn_mas_' + j).on('click', function () {

            var id = $(this).attr('id');
            $('#btn_mas_' + id[id.length - 1]).attr('class', 'btn_mas fa fa-spinner fa-pulse fa-3x fa-fw');
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

    var cerrarTodas = function () {

        for (var j = 1; j <= 8; j++) {

            cerrar_imagen(j);
        }
    };

    var cerrar_imagen = function (i) {

        $('#image_' + i).attr('src', null);
        $('#image_' + i).attr('style', 'visibility: hidden');
        $('#btn_mas_' + i).attr('class', 'btn_mas fa fa-camera-retro fa-3x');
        $('#btn_mas_' + i).show();
        $('#btn_close_' + i).hide();
        addImages = [];
    };

    $("#dep").change(function () {

        $.get("./bd/getMun.php", {iddep: $("#dep").val()})
                .done(function (data) {
                    $('#mun option[value!="-1"]').remove();
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
        if (file.size > 10000000) {
            alert('La foto debe ser de un tamaño menor a 10Mb. Intente con otra foto o reduzca su tamaño.');
            return false;
        }
        if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2])))
        {
            alert('Seleccione un formato valido "image/jpeg", "image/png", "image/jpg"');
            return false;
        } else
        {
            var reader = new FileReader();
            reader.onload = function (e) {


                $('#image_' + i).attr('style', 'visibility: visible');
                $('#btn_close_' + i).show();
                rederizarCanvas($('#image_' + i), e.target.result, 550, 450, 100, 100);
                $('#btn_mas_' + i).hide();
            };
            reader.readAsDataURL(e.files[0]);
        }
    };
});
