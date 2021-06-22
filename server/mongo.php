<?php
//phpinfo();
$m = new MongoDB\Driver\Manager("mongodb://localhost:27017");

//echo __select($m, 'db_acceso.usuario', ['usr' => 'admin','psw' => '123' ] ,[] );

function __select($_CONN, $_TABLA, $_FILTRO , $_OPCIONES )
{
    $_COLECCION     = '';
    $query          = new MongoDB\Driver\Query($_FILTRO, $_OPCIONES);
    $cursor         = $_CONN->executeQuery($_TABLA , $query);

    foreach ($cursor as $a ) 
    {

        $_COLECCION .= json_encode($a);
        $_COLECCION .= ',';
    }

    $_COLECCION = trim($_COLECCION);
    $_COLECCION = trim($_COLECCION,',');

    if(strlen($_COLECCION) == 0)
    {
        return null;
    }
    else
    {
        return $_COLECCION;
    }

}

