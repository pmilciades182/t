$(document).ready(function () {
  
    $( "#close_modal" ).on( "click", function() 
    {

       cerrar_modal();

    });

    $( "#go_busq" ).on( "click", function() 
    {
       mostrar_modal(1);
    });

    $( "#go_exp" ).on( "click", function() 
    {
       mostrar_modal(2);
    });

    $( "#go_new" ).on( "click", function() 
    {
       mostrar_modal(3);
    });

    $( "#go_delete" ).on( "click", function() 
    {
       mostrar_modal(4);
    });



});


function cerrar_modal()
{

    $( "#mgs_modal" ).css( "display","none") ;  

}

//// mostrar modal
//// - tipo
function mostrar_modal(t)
{

    switch (t) {
        //// busqueda avanzada
        case 1:
            $( "#mgs_modal" ).css( "background-color","rgb(69 122 177 / 37%)") ;
          break;
        //// exportar
        case 2:
            $( "#mgs_modal" ).css( "background-color","rgb(87 101 115 / 20%)") ;
          break;
        ///nuevo registro
        case 3:
            $( "#mgs_modal" ).css( "background-color","rgb(67 156 87 / 45%)") ;
          break;
        /// eliminar
        case 4:
            $( "#mgs_modal" ).css( "background-color","rgb(144 45 45 / 45%)") ;
          break;
        default:
            $( "#mgs_modal" ).css( "background-color","rgb(87 101 115 / 20%)") ;
      }

    $( "#mgs_modal" ).css( "display","flex") ;

}