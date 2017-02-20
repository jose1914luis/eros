//var rederizarCanvas = function (can, imagen, altura, ancho) {
//
//
//    var maxWidth = ancho; // Max width for the image
//    var maxHeight = altura;    // Max height for the image
//    var ratio = 0;  // Used for aspect ratio
//
//    var width = $(imagen).width();    // Current image width
//    var height = $(imagen).height();  // Current image height
////    console.log($(imagen).height());
//    // Check if the current width is larger than the max
//    if (width > maxWidth) {
//        ratio = maxWidth / width;   // get ratio for scaling image
//        $(imagen).css("width", maxWidth); // Set new width
//        $(imagen).css("height", height * ratio);  // Scale height based on ratio
//
//        height = height * ratio;    // Reset height to match scaled image
//        width = width * ratio;    // Reset width to match scaled image
//    }
//
//    // Check if current height is larger than max
//    if (height > maxHeight) {
//        ratio = maxHeight / height; // get ratio for scaling image
//        $(imagen).css("height", maxHeight);   // Set new height
//        $(imagen).css("width", width * ratio);    // Scale width based on ratio                        
//        width = width * ratio;    // Reset width to match scaled image            
//    }
//
////    console.log($(can));
//    //var ctx = $(can)[0].getContext("2d");
//    var canvas = $(can)[0];
//    var ctx = canvas.getContext("2d");
//    var cw = canvas.width;
//    var ch = canvas.height;
//
////    console.log();
//
//    var img = new Image();
//    img.onload = start;
//    img.src = $(imagen).attr('src');
//
//    function start() {
//
//
//        // scale the 1000x669 image in half to 500x334 onto a temp canvas
//        var c1 = scaleIt(img, 0.50) ;
////        console.log(c1.width);
//        // scale the 500x335 canvas in half to 250x167 onto the main canvas
//        canvas.width = c1.width / 2;
//        canvas.height = c1.height / 2;
//        ctx.drawImage(c1, 0, 0, width, height);
//
//    }
//    ;
//
//    var scaleIt = function (source, scaleFactor) {
//        var c = document.createElement('canvas');
//        var ctx = c.getContext('2d');
//        var w = source.width * scaleFactor;
//        var h = source.height * scaleFactor;
//        c.width = w;
//        c.height = h;
////        console.log(alto);
//        console.log(h);
//        ctx.drawImage(source, 0, 0, w, h);
//        return(c);
//    };
//
//
//
//
//
//};
//


var rederizar = function (imagen, altura, ancho) {

    var maxWidth = ancho; // Max width for the image
    var maxHeight = altura;    // Max height for the image
    var ratio = 0;  // Used for aspect ratio

    var width = $(imagen).width();    // Current image width
    var height = $(imagen).height();  // Current image height
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

};