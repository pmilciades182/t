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

    $_DATOS = '[' . $_DATOS . ']';

    if( trim($_DATOS) == '[]' )
    {
        return null;
    }
    else
    {
        return $_DATOS;
    }

}

///crea la collection
function __collection($_CONN,$_DB,$_COLECCION)
{
    $command = new MongoDB\Driver\Command(['listCollections' => 1, 'filter' => ['name' =>  $_COLECCION ] ] );

    //var_dump($command);
    $result = $_CONN->executeCommand($_DB, $command )->toArray();
    //var_dump($result);

    if (false == empty($result))
    { 

    }
    else
    {
        $command = new MongoDB\Driver\Command(["create" => $_COLECCION]);
        $cursor = $_CONN->executeCommand($_DB, $command);
        $response = $cursor->toArray()[0];
    }
}

function __count($_CONN,$_DB,$_COLECCION)
{
    $command = new \MongoDB\Driver\Command(['count' => $_COLECCION ]);
    try 
    {
        $cursor = $_CONN->executeCommand($_DB, $command);
    } 
    catch (\MongoDB\Driver\Exception\Exception $e) 
    {
        $error_message = $e->getMessage();
    }
    $count = $cursor->toArray()[0]->n;
    return $count;
}

function __insert($_CONN,$_DB,$_COLECCION,$DATA)
{
    $_BASE = $_DB . '.' . $_COLECCION;

    $bulk = new MongoDB\Driver\BulkWrite;
    $_id1 = $bulk->insert($DATA);
    //var_dump($_id1);
    $result = $_CONN->executeBulkWrite($_BASE, $bulk);

}

function __delete($_CONN,$_DB,$_COLECCION,$DATA)
{
    $_BASE = $_DB . '.' . $_COLECCION;

    $bulk = new MongoDB\Driver\BulkWrite;
    $DATA = intval($DATA);
    $bulk->delete(['id' => $DATA], ['limit' => 1]);

    

    $result = $_CONN->executeBulkWrite($_BASE, $bulk);
    //var_dump($result);

}

