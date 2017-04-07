$(function () {
    if ($('#top_anuncio li').length > 1) {

        $('#top_anuncio li').last().attr('class', 'active');
    }
});


function init(slideIndex, id) {    
    showDivs(slideIndex, 1, id);
}

function plusDivs(slideIndex, n, id) {
    
    showDivs(slideIndex, slideIndex.con += n, id);
};

function showDivs(slideIndex, n, id) {
           
    var i;    
    var x = $(".slides_" + id);
    if (n > x.length) {
        slideIndex.con = 1;
    }
    if (n < 1) {
        slideIndex.con = x.length;
    }
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    x[slideIndex.con - 1].style.display = "inline-block";
}

