<?php

/// incluye la conexion a la bd
include_once('../../server/mongo.php');

$entity = 'persona';

///crear collection

__collection($_MONGO , $_DB, $entity);




?>