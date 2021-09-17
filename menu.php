<?php
    const APP_ID = 16;
    include_once('server/manage_session.php');
?>
<html>
<head>
    <title>ACCESO</title>
    <meta charset="UTF-8">
    <link rel="icon" type="img/image/png" href="img/i.png">
    <link rel="stylesheet" href="css/g.css">
    <link rel="stylesheet" href="css/all.css">
</head>
<body>
    <div id="o2" class="noselect">
        <div id="q1">

            <div id="w0"> <span id="menu_ham" onClick="menu_toggle()"> <i class="fas fa-bars ham"></i> </span> </div>
            <div id="w1">
                <img src="img/f.png" alt="Avatar" class="logo" id="img_logo">
                <input type="text" placeholder="Buscar..." name="buscar" class="buscador" id="busc_menu" autocomplete="off" >
            </div>
            <div id="w2">
                <hr>
                <div id="con_menu">
                    <ul class="li_ca" id="menu_ca" >
                    </ul>
                    <ul class="li_ca" id='menu_bus'>
                    </ul>
                </div>
            </div>
            <div id="w3">
                <hr>
                <ul class="li_ca" >
                    <li class="li_de" onClick="cerrar_sess()"> <i class="fas fa-times-circle"></i>  Cerrar Sesion </li>
                </ul>
            </div>
        </div>
        <div id="q2">
            <div id="e1">
                <div id="r">
                </div>
            </div>
            <div id="e2">
            </div>
        </div>
    </div>
<script src="js/s.js"></script> 
<script src="js/p.js"></script>

<script>
    console.log(session_id);
</script>
</html>

