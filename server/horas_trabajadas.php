<?php
/// incluye la conexion a la bd
include_once('mongo.php');

/// variables de entrada
if(isset($_GET['idpersona'])){$_PERSONA = $_GET['idpersona'];}else{$_PERSONA = $_POST['idpersona'];};
if(isset($_GET['desde'])){$_DESDE = $_GET['desde'];}else{$_DESDE = $_POST['desde'];};
if(isset($_GET['hasta'])){$_HASTA = $_GET['hasta'];}else{$_DESDE = $_POST['hasta'];};

/// listar fechas
$_FILTRO        = [ '$and' =>[['date' => ['$gte' => $_DESDE]],['date' => ['$lte' => $_HASTA]]]];
$_OPCIONES      = ['sort' => ['date2' => 1]];
$_D             = __select($_MONGO,$_DB, 'semanas', $_FILTRO , $_OPCIONES );
$_D             = json_decode($_D);
$_COUNT         = count($_D);

//echo $_COUNT . '<br>';
//var_dump($_D);

for ($i = 0; $i < $_COUNT; $i++) 
{   
    $_LINEA             = ($_D[$i]);
    $_LINEA->persona    = $_PERSONA ;

    $_YEAR              = $_LINEA->year;
    $_WEEK              = $_LINEA->week;
    $_DAY               = $_LINEA->day_of_week;
    $_DATE              = $_LINEA->date;

    ///buscar turnos
    //echo $_PERSONA.$_YEAR.$_WEEK.$_DAY;
    $H = buscar_turno($_PERSONA,$_YEAR,$_WEEK,$_DAY,$_MONGO,$_DB);
    //var_dump($H);
    //echo '<hr>';
    $_LINEA->turno     = $H ;
    // buscar marcaciones en la fecha
    if($_LINEA->turno == 'MAÑANA' or $_LINEA->turno == 'TARDE' ){
        $M = buscar_marcaciones($_PERSONA,$_DATE,$_MONGO,$_DB);
    }else{
        $M = buscar_marcaciones($_PERSONA,$_DATE,$_MONGO,$_DB);
    }

    if($M <> null){

        $_LINEA->marcaciones     = $M[0] ;
        $_LINEA->horas           = $M[1] ;

    }else{
        $_LINEA->marcaciones     = null ;
        $_LINEA->horas           = null ;
    }

    // calcular tiempo trabajado
    $T = tiempo_trabajado($_LINEA->marcaciones);

    $_LINEA->tiempo     = $T;
  

}

var_dump($_D);


function buscar_turno($_PERSONA,$_YEAR,$_WEEK,$_DAY,$_MONGO,$_DB)
{
    $_WH = '{"anho":"'.$_YEAR.'","semana":"'.$_WEEK.'","dia":"'.$_DAY.'","persona":"'.$_PERSONA.'"}';

    $_WH = json_decode($_WH);
    //var_dump($_WH);

    $_FILTRO    = [
        '$and' => [$_WH]
    ];

   
    $_OPCIONES      = [];
    $_D             = __select($_MONGO,$_DB, 'persona_turno', $_FILTRO , $_OPCIONES );
    $_D             = json_decode($_D);

    if($_D <> null)
    {
        //var_dump($_D[0]);
        if($_D[0]->turno == 1){$R = 'MAÑANA';}
        if($_D[0]->turno == 2){$R = 'TARDE';}
        if($_D[0]->turno == 3){$R = 'NOCHE';}
    }
    else
    {
        $R = '-';
    }

    return $R;

}

function buscar_marcaciones($_PERSONA,$_DATE,$_MONGO,$_DB)
{

    $_FILTRO        = [ '$and' =>[
        ['insert_date' => array('$regex' =>   $_DATE  )] , 
        ['persona' => $_PERSONA] 
       ]];

       //var_dump($_FILTRO );

    $_OPCIONES      = ['sort' => ['insert_date' => 1]];


    $_D             = __select($_MONGO,$_DB, 'marcacion', $_FILTRO , $_OPCIONES );
    $_D             = json_decode($_D);

    if($_D <> null)
    {
        $_COUNT         = count($_D);

        $_ARRAY_HORAS           = []; 
        $_ARRAY_MARCACIONES     = [];

        for ($i = 0; $i < $_COUNT; $i++) {

            $_LINEA             = ($_D[$i]);
            $_HORA              = $_LINEA->insert_date;

            $_ARRAY_HORAS[$i]         = $_HORA;
            $_ARRAY_MARCACIONES[$i]   = substr(trim($_HORA),11,5);

        }


        //var_dump($_D);

        $_ARRAY_FINAL = [$_ARRAY_HORAS, $_ARRAY_MARCACIONES ];
    }
    else 
    {
        $_ARRAY_FINAL = null;
    }
    return $_ARRAY_FINAL;

}

function tiempo_trabajado($M){

    if($M == null){
        return null;
    }

    if(count($M) < 2 ){
        return null;
    }

    usort($M, function($a, $b) {
        $dateTimestamp1 = strtotime($a);
        $dateTimestamp2 = strtotime($b);
    
        return $dateTimestamp1 < $dateTimestamp2 ? -1: 1;
    });


    var_dump($M);
    $_MIN = new DateTime($M[0]);
    $_MAX = new DateTime($M[count($M) - 1]);

    var_dump( $_MIN);
    var_dump( $_MAX);

    $diff = $_MAX->diff($_MIN);
    return $diff->format('%h:%i');


}



?>