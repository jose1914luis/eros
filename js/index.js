function eliminarAnuncio(id) {

    if (confirm('Estas seguro que deseas eliminar este anuncio?')) {
        
        $.post("./bd/modificar.php",
        {
            id_anuncio:id
        }).done(function (data) {
           
            if(data == 1){
                alert('Anuncio borrado. Recarga la pagina.');                
            }else{
                alert('El anuncio no fue borrado');
            }
        }).fail(function () {
            alert('Error de comunicación');
        });
    } 
}
