var addImages = [];

$(function () {

    $('#public_div').hide();
    $('#public_label').hide();

    $("#publicar").on('submit', (function (e) {

        e.preventDefault();
        
        if(!validarDatos())return;

        var datos = new FormData(this);

        for (var i = 0; i < addImages.length; i++) {

            datos.append('file_' + (i + 1), addImages[i]);
        }

        $('#public_div').show();
        $('#public_label').show();

        $.ajax({
            url: "./bd/crearUsuario.php", // Url to which the request is send
            type: "POST", // Type of request to be send, called as method
            data: datos, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false, // To send DOMDocument or non processed data file it is set to false
            success: function (data)   // A function to be called if request succeeds
            {
                
                if (data > 0) {

                    if (data == 23000) {

                        $('#public_div').hide();
                        $('#public_label').hide();

                        alert("Ups hubo un Error!!.\n\
                        El usuario que estas intentando crear ya existe. \n\
                        Por favor vuelve a intentar con uno nuevo.");


                    } else if (data == 1) {

                        window.location.href = "panel";
                    }
                } else {

                    alert("Ups hubo un Error!!. Por favor vuelve a intentar.");
                }
            },
            fail: function (e) {

                alert("Ups hubo un Error!!. Por favor vuelve a intentar.");
                $('#public_div').hide();
                $('#public_label').hide();
            }
        });
    }));

    validarDatos = function () {



        // validacion del nombre de la persona:
        patron = /[A-Za-z]{3,}/;
        if ($('#nombre').val().search(patron) < 0 || $('#nombre').val().length < 6) {

            alert("'Nombre' no debe ser inferior a 6 caracteres y poseer letras");
            return false;
        }

        // validacion de correo electr�nico:
        patron = /^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
        if ($('#correo').val().search(patron) < 0) {

            alert("'Correo Electrónico' no posee caracteres válidos");
            return false;
        }

//                // validacion de contrase�as: longitud de la contrase�a
        if ($('#contra').val().length < 5) {
            alert("La Contrase\u00F1a no debe ser inferior a 6 caracteres");

            return false;
        }
//
        if ($('#contra').val() != $('#contra2').val()) {
            alert("Ambas contrase\u00F1as deben coincidir");
            return false;
        }
        return true;
    };


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
