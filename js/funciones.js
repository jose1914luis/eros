var rederizarCanvas = function (imagen, url, altura, ancho, alturaDisplay, anchoDisplay) {

    var img = new Image();
    img.src = url;


    var maxWidth = ancho; // Max width for the image
    var maxHeight = altura;    // Max height for the image
    var ratio = 0;  // Used for aspect ratio
    var width = img.width;    // Current image width
    var height = img.height;  // Current image height

    // Check if the current width is larger than the max
    if (width > maxWidth) {
        ratio = maxWidth / width;   // get ratio for scaling image
        height = height * ratio;    // Reset height to match scaled image
        width = width * ratio;    // Reset width to match scaled image
    }
    // Check if current height is larger than max
    if (height > maxHeight) {
        ratio = maxHeight / height; // get ratio for scaling image                  
        width = width * ratio;    // Reset width to match scaled image            
    }

    //creo canvas dinamico para la conversion de la imagen.
    var canvas = document.createElement('canvas');
    var ctx = canvas.getContext("2d");


    img.onload = function () {

        var c1 = scaleIt(img, 0.50);
//        console.log(img.width);
        canvas.width = width;
        canvas.height = height;
        ctx.drawImage(c1, 0, 0, width, height);
        var dataURL = canvas.toDataURL("image/png");
        $(imagen).attr('src', dataURL);       
        //renderizo la imagen al para el display pequeño
        rederizar($(imagen), alturaDisplay, anchoDisplay);
        
        var blobBin = atob(dataURL.split(',')[1]);
        
        var array = [];
        for (var i = 0; i < blobBin.length; i++) {
            array.push(blobBin.charCodeAt(i));
        }
        addImages.push(new Blob([new Uint8Array(array)], {type: 'image/png'}));        
    };

    function scaleIt(source, scaleFactor) {
        var c = document.createElement('canvas');
        var ctx = c.getContext('2d');
        var w = source.width * scaleFactor;
        var h = source.height * scaleFactor;
        c.width = w;
        c.height = h;
        ctx.drawImage(source, 0, 0, w, h);
        return(c);
    }
    ;

};


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