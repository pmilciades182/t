<?php

include_once('mongo.php');

$_COLECCION = 'usuario';

if(isset($_GET['user']))
{
    $_USER = strtoupper($_GET['user']);
    $_PASS = $_GET['pass'];

    $_CHECK_USR =  __select($_MONGO, $_DB, $_COLECCION , ['usr' => $_USER ] ,[] );

    //echo $_CHECK_USR;

    if($_CHECK_USR == null )
    {
        err_login('Error: Usuario No Registrado');
    }
    else
    {
        $_CHECK_USR_PSW =  __select($_MONGO, $_DB, $_COLECCION , ['usr' => $_USER ,'psw' => $_PASS  ] ,[] );
        //var_dump($_CHECK_USR_PSW);
        if($_CHECK_USR_PSW == null )
        {
            err_login('Error: Error de Usuario o Contraseña');
        }
        else
        {
            $_SSID =  base64_encode($_USER);
            echo  '#' . $_SSID;
        }
    }
}
else
{
    err_login('Error: Error de Get');
}


function err_login($e)
{
    echo "
    <script>

    document.addEventListener('DOMContentLoaded', function(event) { 
        var f = document.getElementById('error');
        f.style.display = 'flex';
        f.innerText = '$e';
      });

    </script>
    
    ";

}
