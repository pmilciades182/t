<?php
include_once('mongo.php');
session_start();

if(isset($_SESSION['session_id']))
{
    ////genera variable global de usuario js
    $_SS = $_SESSION['session_id'];

    //// verica si el usuario dispone de permisos para acceder a la aplicacion
    $_CHECK = check_permissions($_SS,APP_ID,$_MONGO, $_DB);
    /// si el usuario dispone de permisos
    if($_CHECK){

        echo "<script> var session_id = '$_SS' </script>";

    }else{
        /// el usuario no dispone de permisos para acceder a la aplicacion
        echo '<hr>El Usuario No dispone de permisos para acceder a la aplicacion <hr>';
        exit();
        return null;
    }

   
    
    ///ok
}
else
{
    echo '<hr> Usuario No Logueado al sistema <hr>';
    exit();
    return null;
}


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

?>