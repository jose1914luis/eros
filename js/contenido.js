$(function () {
    if ($('#top_anuncio li').length > 1) {

        $('#top_anuncio li').last().attr('class', 'active');
    }

});


function init(slideIndex, id) {

    showDivs(slideIndex, 1, id);
    var interval = null;
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {

        $("#panelId" + id).bind('touchstart', function () {
            if (interval == null) {
                interval = setInterval(function () {

                    if (slideIndex.con < slideIndex.total) {
                        slideIndex.con = slideIndex.con + 1;
                    } else {
                        slideIndex.con = 1;
                    }
                    showDivs(slideIndex, slideIndex.con, id);
                }, 800);
            }

            setTimeout(function () {
                clearInterval(interval);
                interval = null;
            }, 3000);
        });

    } else {
        $("#panelId" + id).on("mouseenter", function () {
            if (interval == null) {
                interval = setInterval(function () {

                    if (slideIndex.con < slideIndex.total) {
                        slideIndex.con = slideIndex.con + 1;
                    } else {
                        slideIndex.con = 1;
                    }
                    showDivs(slideIndex, slideIndex.con, id);
                }, 800);
            }

        });
        $("#panelId" + id).on("mouseleave", function () {
            clearInterval(interval);
            interval = null;
        });
    }

    $("#panelId" + id).click(function () {
        clearInterval(interval);
        interval = null;
    });

}

function plusDivs(slideIndex, n, id) {

    showDivs(slideIndex, slideIndex.con += n, id);
}
;

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

