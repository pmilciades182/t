<?php
//// laboratorio
include_once('mongo.php');

$_SS        = '#QURNSU4=';
$APP_ID     = '1';


$_CHECK = check_permissions($_SS,$APP_ID,$_MONGO, $_DB);

var_dump($_CHECK);

function check_permissions($USUARIO,$APP,$_MONGO, $_DB)
{
    /// array con las id de app con las que cuenta el usuario

    $_APP_LIST = [];

    /// decodifica el usuario
    $USUARIO = substr($USUARIO,1) ;
    $USUARIO = base64_decode($USUARIO);

    //var_dump($USUARIO);
    //_hr();

    /// obtener grupos del usuario
    $_CHECK_USR =  __select($_MONGO, $_DB, 'usuario' , ['usuario' => $USUARIO ] ,[] );
    $_CHECK_USR = json_decode($_CHECK_USR);
    $_GRUPOS = $_CHECK_USR[0]->grupo;
    //var_dump($_GRUPOS);
    //_hr();

    foreach ($_GRUPOS as &$GRUPO) {
        //_e($GRUPO);
        //_br();

        ///obtener aplicaciones de los grupos

        /// obtener aplicaciones de los grupos

        $_CHECK_GRP =  __select($_MONGO, $_DB, 'grupo' , ['descripcion' => $GRUPO ] ,[] );
        $_CHECK_GRP = json_decode($_CHECK_GRP);
        $_APLICACIONES = $_CHECK_GRP[0]->aplicacion;
        //var_dump($_APLICACIONES);
        //_hr();

        /// obtener id de las aplicacion y agregar al $_APP_LIST

        foreach ($_APLICACIONES as &$APLICACION) {
           // _e($APLICACION);
            //_br();
            $_CHECK_APL =  __select($_MONGO, $_DB, 'aplicacion' , ['descripcion' => $APLICACION ] ,[] );
            $_CHECK_APL = json_decode($_CHECK_APL);
            $_ID_APLICACION = $_CHECK_APL[0]->id;
            //var_dump($_ID_APLICACION);
            array_push($_APP_LIST,$_ID_APLICACION);
            //_hr();
        }
    }

    //var_dump($_APP_LIST);

    $_PERMISSION = false;

    $APP = intval($APP);

    if (in_array($APP, $_APP_LIST)) 
    {
        $_PERMISSION = true;
    }

    return $_PERMISSION;
}


function _hr(){
    echo '<hr>';
} 
function _br(){
    echo '<br>';
}
function _e($e){
    echo $e;
}

?>