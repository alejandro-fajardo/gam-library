 
 function LoadPage(Page, Datos, Objet)
    {
        $.ajaxSetup({cache: false});
        var Objet = "#" + Objet;
       
           //$("#ModalLoading").modal("show");
      
        $(Objet).load(Page, Datos, function(response, Estado, xhr){
            if(Estado == "error"){  
                var Message = "Error al cargar la Vista. ";
                $(Objet).html(Message + xhr.Estado + " " + xhr.Estado);
            }
        });
        // $("#ModalLoading").modal("hide"); //imagen cargando (espera de respuesta de archivo) //
    }

 function VerLibros(){
        LoadPage( 'sections/libros/viewlibros.php', {}, 'container_info');
    }

 

 function  CrearLibros(Autor, Nombre,Fecha){
        var parametros = {
                "Autor" : Autor,
                "Nombre":Nombre,
                "Fecha":Fecha
};
        $.ajax({
                data:  parametros,
                url:   'createlibros.php',
                type:  'post',
                beforeSend: function () {
//$("#ModalLoading").show();
                },
                success:  function (response) {
                        $("#ReturnCreateEmpresas").html(response);
                }
        });
}