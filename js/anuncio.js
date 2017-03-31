var addImages = [];

$(function () {



    $('#div_alerta').hide();
    $('#public_div').hide();
    $('#public_label').hide();
    var validar = function () {

        if (CKEDITOR.instances.editor.getData().length < 30) {
            alert('Debes ingresar una descripcion mas larga');
            $('#editor').focus();
            return false;
        }
        return true;
    };

    $("#publicar").on('submit', (function (e) {

        e.preventDefault();

        if (!validar())
            return;
        
        $('#numfiles').attr('value', addImages.length);
        var datos = new FormData(this);
        
        for (var i = 0; i < addImages.length; i++) {

            datos.append('file_' + (i + 1), addImages[i]);
        }
        
        datos.append('texto', CKEDITOR.instances.editor.getData());
                
        $('#public_div').show();
        $('#public_label').show();

        $.ajax({
            url: "/bd/publicar.php", // Url to which the request is send
            type: "POST", // Type of request to be send, called as method
            data: datos, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false, // To send DOMDocument or non processed data file it is set to false
            success: function (data)   // A function to be called if request succeeds
            {
                
                console.log(data);
//                if (data > 0) {
//
//                    window.location.href = "/P_AN/" + data+"/"+ $("#categoria option:selected").text() +"/"+ $("#dep option:selected").text() + "/" ;
//                    $('#div_alerta').hide();
//                    $('#public_div').hide();
//                } else {
//
//                    $('#div_alerta').attr('class', 'alert alert-danger');
//                    $('#div_alerta').text('');
//                    $('#div_alerta').html('<b>Ups hubo un Error!!.</b> Por favor vuelve a intentar.');
//                }
            },
            fail: function (e) {

                $('#div_alerta').attr('class', 'alert alert-danger');
                $('#div_alerta').text('');
                $('#div_alerta').html('<b>Ups hubo un Error!!.</b> Por favor vuelve a intentar.');
                $('#public_div').hide();
                $('#public_label').hide();
            }
        });
    }));

    CKEDITOR.replace('editor', {
        toolbar: [
            {name: 'basicstyles', items: ['Bold', 'Italic']},
            {name: 'styles', items:['Styles', 'Format']},
            {name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']},
            {name: 'links', items:['Link', 'Unlik', 'Anchor']},            
            {name: 'document', items: ['-', 'NewPage', 'Preview', '-', 'Templates']}, // Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
            ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] // Defines toolbar group without name.
        ]
    });


    for (var j = 1; j <= 8; j++) {
        $('#image_' + j).attr('style', 'visibility: hidden');

        $('#btn_close_' + j).hide();

        $('#btn_mas_' + j).on('click', function () {

            var id = $(this).attr('id');
            //$('#btn_mas_' + id[id.length - 1]).attr('class', 'btn_mas fa fa-spinner fa-pulse fa-3x fa-fw');
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
        $('#btn_mas_' + i).attr('class', 'btn_mas fa fa-camera-retro fa-3x');
        $('#btn_mas_' + i).show();
        $('#btn_close_' + i).hide();
        addImages = [];
    };

    $("#dep").change(function () {

        $.get("/bd/getMun.php", {iddep: $("#dep").val(), id:1})
                .done(function (data) {
                    $('#mun option[value!="-1"]').remove();
                    $.each(data, function (index, value) {


                        $('#mun').append($("<option></option>").attr("value", value.idmun).text(value.m_nombre));

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
                rederizarCanvas($('#image_' + i), e.target.result, 550, 550, 100, 100);
                $('#btn_mas_' + i).hide();
            };
            reader.readAsDataURL(e.files[0]);
        }
    };
});
