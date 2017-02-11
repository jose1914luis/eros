<script src="js/contenido.js" type="text/javascript"></script>
<?php
include './bd/Anuncio.php';

$anuncio = new Anuncio();

$datos = $anuncio->getAnuncios();

echo '<div class="row">';
$i = 1;
foreach ($datos as $pos => $value) {
    echo '<div class="col-lg-5 ">';
    echo '<div class="panel panel-danger">';
    echo '<div class="panel-heading">';
    echo 'Escort - Antioquia - Medellin';
    echo '</div>';
    echo '<table class="table">';
    echo '<tr>';
    echo '<td> ';
    echo '<div class="w3-content w3-display-container">';
    echo '<img class="slides_' . $i . '" src="image/fff2.png" alt="..." style="">';
    echo '<img class="slides_' . $i . '" src="image/58c704.png" alt="..." style="">';
    echo '<a class="w3-btn-floating w3-display-left" onclick="plusDivs_' . $i . '(-1)">&#10094;</a>';
    echo '<a class="w3-btn-floating w3-display-right" onclick="plusDivs_' . $i . '(1)">&#10095;</a>';

    echo '<script type="text/javascript">';
    echo '                            var slide_' . $i . ' = 1;';
    echo '                            showDivs_' . $i . '(slide_' . $i . ');';
    echo '                            plusDivs_' . $i . ' = function (n) {';
    echo '                                showDivs_' . $i . '(slide_' . $i . ' += n);';
    echo '                            };';
    echo '                      function showDivs_' . $i . '(n) {';
    echo '                          var i;';
    echo '                          var x = $(".slides_' . $i . '");';
    echo '                          if (n > x.length) {';
    echo '                              slide_' . $i . ' = 1;';
    echo '                          }';
    echo '                          if (n < 1) {';
    echo '                              slide_' . $i . ' = x.length;';
    echo '                          }';
    echo '                          for (i = 0; i < x.length; i++) {';
    echo '                              x[i].style.display = "none";';
    echo '                          }';
    echo '                          console.log($(".slides_' . $i . '")[0]);';
    echo '                          x[slide_' . $i . ' - 1].style.display = "block";';
    echo '                      }';
    echo '                  </script>';
    echo '</div>';
    echo '</td>';
    echo '<td style="word-wrap: break-word; max-width: 318px; max-height: 250px;">';
    echo '<a><b style="font-size: 15px;">' . $value['titulo'] . '</b></a><br>';
    echo '<div style="font-size: 12px;max-height: 120px;overflow: hidden;">' . strip_tags($value['texto']) . '</div>';    
    echo '<b style="font-size: 15px;">Edad: </b>' . $value['edad'] . '</div><br>';
    echo '<b style="font-size: 15px;">Altura: </b>' . $value['altura'] . '</div><br>';
    echo '<b style="font-size: 15px;">Tarifa minima: </b>' . $value['edad'] . '</div><br>';
    echo '<b style="font-size: 15px;">Tel: </b>' . $value['tel'] . '</div><br>';
    echo '</td>';
    echo '</tr>';
    echo '</table>';
    echo '</div>';
    echo '</div>';
    $i = $i + 1;
//    echo '';
//    echo '';
//    echo '';
//    echo '';
//    
//    
//    echo '<option value = "' . $value[0] . '">' . . '</option>';
//    break;
}
echo '</div>';
?>
<!--<div class="row">
    <div class="col-lg-5 ">
        <div class="panel panel-danger">
            <div class="panel-heading">
                Escort - Antioquia - Medellin
            </div>
            <table class="table">
                <tr>
                    <td> 
                        <div class="w3-content w3-display-container">                            
                            <img class="slides_1" src="image/fff2.png" alt="..." style="" >
                            <img class="slides_1" src="image/58c704.png" alt="..." style="" >
                            <a class="w3-btn-floating w3-display-left" onclick="plusDivs_1(-1)">&#10094;</a>
                            <a class="w3-btn-floating w3-display-right" onclick="plusDivs_1(1)">&#10095;</a>
                            
                        </div>
                    </td>
                    <td>
                        <p><a>BONITA OJOS CLAROS RUBIA DELGADA. LINDA CARA PASA DIME QUE QUIERES CHAPINERO</a></p>                                 

                        <p>Te invito a que vengas y disfrutes de nuestros servicios de masajes relajantes y tantricos que te dejaran como nuevo... INF 3102462998-3152467067</p>
                    </td>
                </tr>

            </table>


        </div>
    </div>-->

<!--    <div class="col-lg-5 ">
        <div class="panel panel-danger">
            <div class="panel-heading">
                Escort - Antioquia - Medellin
            </div>
            <table class="table">
                <tr>
                    <td> 
                        <div >
                            <img class="mySlides" src="image/fff2.png" alt="..." style="">
                            <img class="mySlides" src="image/58c704.png" alt="..." style="">
                                                        <a class="w3-btn-floating w3-display-left" onclick="plusDivs(-1)">&#10094;</a>
                                                        <a class="w3-btn-floating w3-display-right" onclick="plusDivs(1)">&#10095;</a>
                        </div>
                    </td>
                    <td>
                        <p><a>BONITA OJOS CLAROS RUBIA DELGADA. LINDA CARA PASA DIME QUE QUIERES CHAPINERO</a></p>                                 

                        <p>Te invito a que vengas y disfrutes de nuestros servicios de masajes relajantes y tantricos que te dejaran como nuevo... INF 3102462998-3152467067</p>
                    </td>
                </tr>

            </table>


        </div>
    </div>

</div>

<div class="row">

    <div class="col-lg-5 ">
        <div class="panel panel-danger">
            <div class="panel-heading">
                Escort - Antioquia - Medellin
            </div>
            <table class="table">
                <tr>
                    <td> <img src="image/fff2.png" alt="..."></td>
                    <td>
                        <p><a>BONITA OJOS CLAROS RUBIA DELGADA. LINDA CARA PASA DIME QUE QUIERES CHAPINERO</a></p>                                 

                        <p>Te invito a que vengas y disfrutes de nuestros servicios de masajes relajantes y tantricos que te dejaran como nuevo... INF 3102462998-3152467067</p>
                    </td>
                </tr>

            </table>


        </div>
    </div>

    <div class="col-lg-5 ">
        <div class="panel panel-danger">
            <div class="panel-heading">
                Escort - Antioquia - Medellin
            </div>
            <table class="table">
                <tr>
                    <td> <img src="image/fff2.png" alt="..."></td>
                    <td>
                        <p><a>BONITA OJOS CLAROS RUBIA DELGADA. LINDA CARA PASA DIME QUE QUIERES CHAPINERO</a></p>                                 
                        <p>edad: 18</p>
                        <p>altura: 154cm</p>
                        <p>contacto: 3152467067</p>
                        <p>Te invito a que vengas y disfrutes de nuestros servicios de masajes relajantes y tantricos que te dejaran como nuevo... INF 3102462998-3152467067</p>
                    </td>
                </tr>

            </table>


        </div>
    </div>

</div>

<div class="row">

    <div class="col-lg-5 ">
        <div class="panel panel-danger">
            <div class="panel-heading">
                Escort - Antioquia - Medellin
            </div>
            <table class="table">
                <tr>
                    <td> <img src="image/fff2.png" alt="..."></td>
                    <td>
                        <p><a>BONITA OJOS CLAROS RUBIA DELGADA. LINDA CARA PASA DIME QUE QUIERES CHAPINERO</a></p>                                 
                        <p>edad: 18</p>
                        <p>altura: 154cm</p>
                        <p>contacto: 3152467067</p>
                        <p>Te invito a que vengas y disfrutes de nuestros servicios de masajes relajantes y tantricos que te dejaran como nuevo... INF 3102462998-3152467067</p>
                    </td>
                </tr>

            </table>


        </div>
    </div>

    <div class="col-lg-5 ">
        <div class="panel panel-danger">
            <div class="panel-heading">
                Escort - Antioquia - Medellin
            </div>
            <table class="table">
                <tr>
                    <td> <img src="image/fff2.png" alt="..."></td>
                    <td>
                        <p><a>BONITA OJOS CLAROS RUBIA DELGADA. LINDA CARA PASA DIME QUE QUIERES CHAPINERO</a></p>                                 
                        <p>edad: 18</p>
                        <p>altura: 154cm</p>
                        <p>contacto: 3152467067</p>
                        <p>Te invito a que vengas y disfrutes de nuestros servicios de masajes relajantes y tantricos que te dejaran como nuevo... INF 3102462998-3152467067</p>
                    </td>
                </tr>

            </table>


        </div>
    </div>-->

</div>