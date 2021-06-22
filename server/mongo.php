<?php

$_MONGO = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$_DB    = 'db_acceso';

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

///crea la collection
function __collection($_CONN,$_DB,$_ENTIDAD)
{
    $command = new MongoDB\Driver\Command(['listCollections' => 1, 'filter' => ['name' =>  $_ENTIDAD ] ] );

    //var_dump($command);
    $result = $_CONN->executeCommand($_DB, $command )->toArray();
    //var_dump($result);

    if (false == empty($result))
    { 

    }
    else
    {
        $command = new MongoDB\Driver\Command(["create" => $_ENTIDAD]);
        $cursor = $_CONN->executeCommand($_DB, $command);
        $response = $cursor->toArray()[0];
    }
}

