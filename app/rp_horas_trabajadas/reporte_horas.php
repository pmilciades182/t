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



$IMPRESION = date('Y-m-d h:i:s');

$dompdf->setHttpContext($context);

// Introducimos HTML de prueba
$html = "

<style>
.tabla, .tabla tr, .tabla tr td{
    border:solid;
    border-collapse: collapse;
    border-width: 1px;
    width: 130px;
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
    <td><b>Horas Trabajadas </b></td>
</tr>


";






$A =  devolver_array($_DESDE,$_HASTA,$_PERSONA,$_MONGO,$_DB);


$_COUNT         = count($A);


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

    if(is_array($_HORAS )) {

        $_HORAS = implode('<br>' ,$_HORAS );

    }

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
    $html .= "<td> $_TIEMPO </td>";

    $html .= "</tr>";

    

}

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