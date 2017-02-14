var rederizar = function (imagen, altura, ancho, margen) {

    var maxWidth = ancho; // Max width for the image
    var maxHeight = altura;    // Max height for the image
    var ratio = 0;  // Used for aspect ratio

    var width = $(imagen).width();    // Current image width
    var height = $(imagen).height();  // Current image height
//    console.log($(imagen).width());
//    console.log($(imagen).height());
    // Check if the current width is larger than the max
    if (width > maxWidth) {
        ratio = maxWidth / width;   // get ratio for scaling image
        $(imagen).css("width", maxWidth); // Set new width
        $(imagen).css("height", height * ratio);  // Scale height based on ratio

        height = height * ratio;    // Reset height to match scaled image
        width = width * ratio;    // Reset width to match scaled image
    }

    // Check if current height is larger than max
    if (height > maxHeight) {
        ratio = maxHeight / height; // get ratio for scaling image
        $(imagen).css("height", maxHeight);   // Set new height
        $(imagen).css("width", width * ratio);    // Scale width based on ratio                        
        width = width * ratio;    // Reset width to match scaled image            
    }

//    if (margen == 1) {
//        if ($(imagen).height() < maxHeight) {
//
//            $(imagen).css("margin-top", $(imagen).height() / 2);
//        }
//    }


};