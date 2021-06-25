<?php

/// incluye la conexion a la bd
include_once('../../server/mongo.php');

///entidad
$_COLECCION = 'persona';

///crear collection

__collection($_MONGO , $_DB, $_COLECCION);

///letra e utilizado para select
if(isset($_POST['e']) or isset($_GET['e'])    )
{
    ///letra w para definir un where
    if(isset($_POST['w']) or isset($_GET['w']) )
    {

    }
    else
    {
       $_FILTRO    = [];
       $_OPCIONES   = ['sort' => ['id' => -1]];
       $_D = __select($_MONGO,$_DB, $_COLECCION, $_FILTRO , $_OPCIONES );
    }
    echo $_D;
}

///letra c para definir un count
if(isset($_POST['c']) or isset($_GET['c'])    )
{
       $_FILTRO    = [];
       $_OPCIONES   = [];
       $_D = __count($_MONGO,$_DB, $_COLECCION);
       echo $_D;
}


?>