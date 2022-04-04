<?php
use Dompdf\Dompdf;
use Dompdf\Options;

require_once '../../server/mongo.php';
require_once 'dompdf/autoload.inc.php';
require_once '../../server/horas_trabajadas.php';

/// variables de entrada
if(isset($_GET['idpersona'])){$_PERSONA = $_GET['idpersona'];}else{ $_PERSONA = $_POST['idpersona'];};
if(isset($_GET['desde'])){$_DESDE = $_GET['desde'];}else{ $_DESDE = $_POST['desde'];};
if(isset($_GET['hasta'])){$_HASTA = $_GET['hasta'];}else{ $_DESDE = $_POST['hasta'];};
if(isset($_GET['nombre'])){$_NOMBRE = $_GET['nombre'];}else{ $_NOMBRE = $_POST['nombre'];};


$options = new Options();
$options->set('isRemoteEnabled', TRUE);
$dompdf = new Dompdf($options);

$context = stream_context_create([ 
	'ssl' => [ 
		'verify_peer' => FALSE, 
		'verify_peer_name' => FALSE,
		'allow_self_signed'=> TRUE 
	] 
]);



$IMPRESION = date('Y-m-d H:i:s');

$dompdf->setHttpContext($context);

// Introducimos HTML 
$html = "

<style>
.tabla, .tabla tr, .tabla tr td{
    border:solid;
    border-collapse: collapse;
    border-width: 1px;
    width: 120px;
}
</style>


<h1>Detalle de Horas trabajadas</h1>

<table>
<tr>
    <td><b>Empleado: </b></td>
    <td>$_NOMBRE</td>
</tr>
<tr>
    <td><b>Desde: </b></td>
    <td>$_DESDE</td>
</tr>
<tr>
    <td><b>Hasta: </b></td>
    <td>$_HASTA</td>
</tr>
<tr>
    <td><b>Fecha de Impresion: </b></td>
    <td>$IMPRESION</td>
</tr>
</table>

<hr>

<table class='tabla'>
<tr>
    <td><b>Fecha </b></td>
    <td><b>Dia de la Semana </b></td>
    <td><b>Turno </b></td>
    <td><b>Marcaciones </b></td>
    <td><b>Horas Diurnas </b></td>
    <td><b>Horas Nocturnas </b></td>
</tr>


";


$A =  devolver_array($_DESDE,$_HASTA,$_PERSONA,$_MONGO,$_DB);


$_COUNT         = count($A);

$_SUMA_DIURNA       = 0;
$_SUMA_NOCTURNA     = 0;


for ($i = 0; $i < $_COUNT; $i++) 
{   
    $_LINEA             = ($A[$i]);
    $_YEAR              = $_LINEA->year;
    $_WEEK              = $_LINEA->week;
    $_DAY               = $_LINEA->day_of_week;
    $_DATE              = $_LINEA->date;
    $_TURNO             = $_LINEA->turno;
    $_MARCACION         = $_LINEA->marcaciones;
    $_HORAS             = $_LINEA->horas;
    $_TIEMPO            = $_LINEA->tiempo;

    $_TIEMPO_DIURNO     = 0;
    $_TIEMPO_NOCTURNO   = 0;



    if(is_array($_HORAS )) {

        $_HORAS = implode('<br>' ,$_HORAS );

    }

    /// fix tiempo y distribuir

    if( trim($_TIEMPO) == '')
    {
        $_TIEMPO = 0;
    }

    if($_TURNO <> '-'){

        if($_TURNO == 'Noche'){
            $_TIEMPO_DIURNO = 0;
            $_TIEMPO_NOCTURNO = $_TIEMPO;
        }else{
            $_TIEMPO_DIURNO = $_TIEMPO;
            $_TIEMPO_NOCTURNO = 0;
        }

    }

    $_SUMA_DIURNA   = $_SUMA_DIURNA + $_TIEMPO_DIURNO;
    $_SUMA_NOCTURNA = $_SUMA_NOCTURNA + $_TIEMPO_NOCTURNO;

    switch ($_DAY) {
        case 1: $_DAY = 'Lunes';  break;
        case 2: $_DAY = 'Martes';  break;
        case 3: $_DAY = 'Miercoles';  break;
        case 4: $_DAY = 'Jueves';  break;
        case 5: $_DAY = 'Viernes';  break;
        case 6: $_DAY = 'Sabado';  break;
        case 7: $_DAY = 'Domingo';  break;
      
    }

    $html .= "<tr>";

    $html .= "<td> $_DATE   </td>";
    $html .= "<td> $_DAY    </td>";
    $html .= "<td> $_TURNO  </td>";
    $html .= "<td> $_HORAS </td>";
    $html .= "<td> $_TIEMPO_DIURNO </td>";
    $html .= "<td> $_TIEMPO_NOCTURNO </td>";

    $html .= "</tr>";
}

$html .= "

<tr>
<td><b>Total </b></td>
<td></td>
<td></td>
<td></td>
<td><b> $_SUMA_DIURNA </b></td>
<td><b> $_SUMA_NOCTURNA </b></td>
</tr>

";

$html .= "</table>";


// Instanciamos un objeto de la clase DOMPDF.
$pdf = new DOMPDF();
 
// Definimos el tamaño y orientación del papel que queremos.
$pdf->set_paper("A4", "portrait");
 
// Cargamos el contenido HTML.
$pdf->load_html(utf8_decode($html));
 
// Renderizamos el documento PDF.
$pdf->render();
 
// Enviamos el fichero PDF al navegador.

$_HORA_ARCHIVO = date('Ymdhis');
$pdf->stream('Marcaciones_' . $_HORA_ARCHIVO . '.pdf');