<?php
include_once('mongo.php');
session_start();

if(isset($_SESSION['session_id']))
{
    ////genera variable global de usuario js
    $_SS = $_SESSION['session_id'];

    //// verica si el usuario dispone de permisos para acceder a la aplicacion
    $_CHECK = check_permissions($_SS,APP_ID);

    echo "<script> var session_id = '$_SS' </script>";
    
    ///ok
}
else
{
    echo '<hr> Usuario No Logueado al sistema <hr>';
    exit();
    return null;
}


function check_permissions($USUARIO,$APP)
{
    return true;
}

?>