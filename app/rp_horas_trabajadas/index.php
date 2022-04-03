<?php
const APP_ID = 4;
include_once('../../server/_rpt_index.php');
?>


<div class="dsb_con tent">
    <div class="dsb_line"> 
        <div class="dsb_card dsb_card1b colum"> 

            <span> Seleccionar Persona :</span> 

            <select id="personas" ></select>

            <br>
            
            <span> Fecha Desde :</span> 
            <input type="date" id="desde"> <br>
            
            <span>Fecha Hasta :</span> 
            <input type="date" id="hasta">

            <div class="agrupador" onclick='go_cargar(this)'>
                    <div> &nbsp&nbsp <span>CAGAR </span>&nbsp&nbsp </div>
            </div>
        </div>
    </div>

    <div class="dsb_line"> 
    <iframe id="frame"> </iframe>
    </div>
</div>
<script src="../../js/alert.js"></script>

<script>

/// globales

frame.style.visibility = 'hidden';

let gg_year = 2022;
let gg_week = 1;
let gg_sucursal = 0;

$( document ).ready(function() {
   
    let list_persona = document.getElementById('personas');
    load_list_persona(list_persona, 'persona') ;

});


function go_cargar()
{
    let persona   =  $('#personas option:selected').val();
    let persona_T =  $('#personas option:selected')[0].innerText;
    
   console.log(persona);
   console.log(desde.value);
   console.log(hasta.value);

   let _desde = desde.value;
   let _hasta = hasta.value;

   if( _desde != '' && 
       _hasta != '' && 
       persona != ''
   
   ){

    frame.src = 'reporte_horas.php?idpersona=' +persona + '&desde=' + _desde + '&hasta=' + _hasta + '&nombre='  + persona_T;

    Swal.fire(
    'Archivo Generado!',
    'Verifique su carpeta de descargas',
    'success'
    )

   }else{
            Swal.fire({
        title: 'Error!',
        text: 'Debe Completar todos los campos',
        icon: 'error',
        confirmButtonText: 'Ok'
        })
   }


    

}


</script>
</html>