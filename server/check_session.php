<?php

include_once('util.php');
include_once('mongo.php');

$_TABLA = 'db_acceso.usuario';

if(isset($_GET['user']))
{
    $_USER = strtoupper($_GET['user']);
    $_PASS = $_GET['pass'];

    $_CHECK_USR =  __select($m, $_TABLA , ['usr' => $_USER ] ,[] );

    //echo $_CHECK_USR;

    if($_CHECK_USR == null )
    {
        err_login('Error: Usuario No Registrado');
    }else
    {
        $_CHECK_USR_PSW =  __select($m, $_TABLA , ['usr' => $_USER ,'psw' => $_PASS  ] ,[] );

        if($_CHECK_USR_PSW == null )
        {
            err_login('Error: Error de Usuario o Contraseña');
        }
        else
        {
            echo '#123';
        }
    }
}
else
{
    err_login('Error: Error de Get');
}
