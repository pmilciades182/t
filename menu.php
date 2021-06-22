<html>
<head>
    <title>ACCESO</title>
    <meta charset="UTF-8">
    <link rel="icon" type="img/image/png" href="img/i.png">
    <link rel="stylesheet" href="css/g.css">
    <link rel="stylesheet" href="css/solid.css">
    <link rel="stylesheet" href="css/brands.css">
    <link rel="stylesheet" href="css/fontawesome.css">
</head>
<body>
    <div id="o2">
        <div id="q1">
            <div id="w1">
                <img src="img/f.png" alt="Avatar" class="logo">
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
                    <li class="li_de"
                     onClick = "abre_prog(this)"
                     data-prog="mensaje"
                     data-id="90000"
                     data-tit_pes = "Mensajes"
                    ><i class="fas fa-envelope"></i> Mensajes (0)</li>
                    <li class="li_de"
                     onClick = "abre_prog(this)"
                     data-prog="perfil"
                     data-id="90001"
                     data-tit_pes = "Mi Perfil"
                    ><i class="fas fa-user"></i> Mi Perfil</li>
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
</html>

