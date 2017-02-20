$(document).ready(function () {

    var canvas = document.getElementById("canvas");
    var ctx = canvas.getContext("2d");
    var cw = canvas.width;
    var ch = canvas.height;

    var img = new Image();
    img.onload = start;
    img.src = "./upload/15/imagen1.jpg";
    function start() {


        // scale the 1000x669 image in half to 500x334 onto a temp canvas
        var c1 = scaleIt(img, 0.50);

        // scale the 500x335 canvas in half to 250x167 onto the main canvas
        canvas.width = c1.width / 2;
        canvas.height = c1.height / 2;
        ctx.drawImage(c1, 0, 0, 250, 167);

    }

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

});