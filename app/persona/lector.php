<?php
if(!isset($_GET['id']))
{
   return null;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Lector Facial</title>
        <script src="../../js/face-api.js"></script>

        <style>
            html{
    
                display: flex;
                width: 100%;
                height: 100%;
                justify-content: center;
                align-items: center;
            }

            body{
                margin:0;
                padding:0;
       
                display: flex;
                justify-content : center;
                align-items: center;
                background-color: whitesmoke;
                flex-direction: column;
            }

            canvas{
                position: absolute;
            }

            #menu_inferior{
                display: flex;
                width: 100%;
                background-color: bisque;
                flex-direction: row;
                height: 100px;
                position: absolute;
                 top: -1px;
            }

    

            #lector_mensajes{
                display: flex;
                width: 100%;
                justify-content: center;
                align-items: center;
                flex-direction: column;
            }
            .mensaje_datos_deteccion{
                font-weight: 900;
                font-size: 20px;
            }
        </style>
 
	</head>
	<body>

    <video 
    id      = "video"
    width   = "800px"
    height  = "600px"
    autoplay
    muted
    > </video>

    <hr>

    <div id="menu_inferior">
   
        <div id="lector_mensajes">  ...
            
        </div>
		
	</body>
</html>

<?php

if(isset($_GET['id']))
{
    echo '<script> var global_lector = '. $_GET['id'] .' </script>';
}


?>

<script src="../../js/s.js"></script>
<script src="../../js/lector.js"></script>