<?php
session_start();
if(isset($_SESSION['session_id']))
{
    ////genera variable global de usuario js
    $_SS = $_SESSION['session_id'];

    echo "<script> var session_id = '$_SS' </script>";
    
    ///ok
}
else
{
    echo 'Fail';
    exit();
    return null;
}
?>