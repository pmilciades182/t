<?php
///crear collection
__collection($_MONGO , $_DB, $_COLECCION);

///letra e utilizado para select

if(isset($_POST['e']) or isset($_GET['e']) )
{
    //// p es para la paginacion

    if(isset($_POST['p']))
    {
        $_P = $_POST['p'];
    }
    else
    {
        if(isset($_GET['p']))
        {
            $_P = $_GET['p'];
        }else
        {
            $_P = 1;
        }
    }

    $_P = intval($_P);
    
    if($_P == 1)
    {
        $_P = 0; 
    }
    else
    {
        $_P = (intval($_P) - 1) * 10;
    }
   

    ///letra w para definir un where
    if(isset($_POST['w']) or isset($_GET['w']) )
    {
        $_FILTRO    = [];
        $_OPCIONES   = ['sort' => ['id' => -1]];
        $_D = __select($_MONGO,$_DB, $_COLECCION, $_FILTRO , $_OPCIONES );
    }
    else
    {
       $_FILTRO    = [];
       $_OPCIONES   = [
           'sort' => ['id' => -1]  ,
           'skip' => $_P,
           'limit' => 10
        ];
       $_D = __select($_MONGO,$_DB, $_COLECCION, $_FILTRO , $_OPCIONES );
    }

    echo $_D;
}

///letra c para definir un count
if(isset($_POST['c']) or isset($_GET['c']))
{
       $_FILTRO    = [];
       $_OPCIONES   = [];
       $_D = __count($_MONGO,$_DB, $_COLECCION);
       echo $_D;
}


?>