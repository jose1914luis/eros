$(function () {

    $('#public_div').hide();
    $('#public_label').hide();

    $("#publicar").on('submit', (function (e) {

        e.preventDefault();

        if (!validarDatos())
            return;

        var datos = new FormData(this);

        for (var i = 0; i < addImages.length; i++) {

            datos.append('file_' + (i + 1), addImages[i]);
        }

//        $('#public_div').show();
//        $('#public_label').show();

//        $.ajax({
//            url: "./bd/crearUsuario.php", // Url to which the request is send
//            type: "POST", // Type of request to be send, called as method
//            data: datos, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
//            contentType: false, // The content type used when sending data to the server.
//            cache: false, // To unable request pages to be cached
//            processData: false, // To send DOMDocument or non processed data file it is set to false
//            success: function (data)   // A function to be called if request succeeds
//            {
//
//                if (data > 0) {
//
//                    if (data == 23000) {
//
//                        $('#public_div').hide();
//                        $('#public_label').hide();
//
//                        alert("Ups hubo un Error!!.\n\
//                        El usuario que estas intentando crear ya existe. \n\
//                        Por favor vuelve a intentar con uno nuevo.");
//
//
//                    } else if (data == 1) {
//
//                        window.location.href = "panel";
//                    }
//                } else {
//
//                    alert("Ups hubo un Error!!. Por favor vuelve a intentar.");
//                }
//            },
//            fail: function (e) {
//
//                alert("Ups hubo un Error!!. Por favor vuelve a intentar.");
//                $('#public_div').hide();
//                $('#public_label').hide();
//            }
//        });
    }));

});

