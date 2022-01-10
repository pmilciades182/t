<?php
if(isset($_POST['user']))
{
    //var_dump($_POST);
     $_USER =  $_POST['user'];
     $_PASS =  $_POST['pass'];

     $_FILE = 'http://localhost/t/server/check_session.php?user=' ;
     $_FILE .= $_USER . '&pass=';
     $_FILE .= $_PASS ;
     $RES = file_get_contents($_FILE,FILE_USE_INCLUDE_PATH);
     $RES_P =  substr($RES,0,1);

     if( $RES_P == '#' )
     {
         /// comienza la session
         session_start();
         $_SESSION['session_id'] = $RES;
         header('Location: menu');
         die();
     }
     else
     {
        echo $RES;
     }
     
}    
else
{
    if(isset($_SESSION['user']))
    {
        session_destroy();
    }
}
?>

<html>
<head>
    <title>ACCESO</title>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="img/i.png">
    <link rel="stylesheet" href="css/g.css">
</head>
<body>
    <div id="error"></div>
    <div id="o1">
        <div id="p1">
            <form id="fo1" method="post">
                <div class="imgcontainer">
                    <img src="img/f.png" alt="Avatar" class="avatar">
                </div>
                <div class="container">
                    <h1>Iniciar Sesión</h1>
                    <span>Usuario:</span>
                    <input type="text" placeholder="Ingrese su Usuario" name="user" required>
                      <span>Contraseña:</span>
                    <input type="password" placeholder="Ingrese su contraseña" name="pass" suggested= "current-password"  autocomplete="on" required>
                    <button type="submit">Ingresar</button>
                </div>
               
            </form>
        </div> 
        <div id="p2">
            
        </div>
    </div>
</body>
</html>


