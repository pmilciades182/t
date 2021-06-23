<?php

/// incluye la conexion a la bd
include_once('../../server/mongo.php');

///entidad
$_COLECCION = 'persona';


///crear collection

__collection($_MONGO , $_DB, $_COLECCION);



if(isset($_POST['e']) or isset($_GET['e'])    )
{
    if(isset($_POST['w']) or isset($_GET['w']) )
    {

    }else
    {
       $_FILTRO    = [];
       $_OPCIONES   = [];
       $_D = __select($_MONGO,$_DB, $_COLECCION, $_FILTRO , $_OPCIONES );
    }
    


    echo $_D;
}


?>