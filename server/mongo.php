<?php

$_MONGO = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$_DB    = 'db_acceso';

//echo __select($m, 'db_acceso.usuario', ['usr' => 'admin','psw' => '123' ] ,[] );

function __select($_CONN,$_DB, $_COLECCION, $_FILTRO , $_OPCIONES )
{
    $_DATOS     = '';
    $_BASE = $_DB . '.' . $_COLECCION;
    $query          = new MongoDB\Driver\Query($_FILTRO, $_OPCIONES);
    $cursor         = $_CONN->executeQuery( $_BASE , $query);

    foreach ($cursor as $a ) 
    {

        $_DATOS .= json_encode($a);
        $_DATOS .= ',';
    }

    $_DATOS = trim($_DATOS);
    $_DATOS = trim($_DATOS,',');

    if(strlen($_DATOS) == 0)
    {
        return null;
    }
    else
    {
        return $_DATOS;
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

