<?php
/// incluye la conexion a la bd
include_once('mongo.php');

$_YEAR = 2024;
$date = "01 january 2024";
$my_date = date('Y-m-d', strtotime($date));
//echo $my_date;
$_NUMBER_OF_WEEKS = 52;
$_NUMBER_OF_DAYS = 7;

for ($i = 1; $i <= $_NUMBER_OF_WEEKS; $i++) 
{

    echo '<hr>' .  $i . '<br><br>';

    for ($j = 1; $j <= $_NUMBER_OF_DAYS; $j++) 
    {
        echo $j . ' - ' . $my_date .  ' <br> ';

        $my_date =  date('Y-m-d', strtotime("+1 day", strtotime($my_date)));

        $DATA['year'] = $_YEAR;
        $DATA['week'] = $i;
        $DATA['day_of_week'] = $j;

        $DATA['date'] = $my_date;

      

        $tz = 'America/Asuncion';
        //$timestamp = time();
        $dt = new DateTime($my_date, new DateTimeZone($tz)); 
        //$dt->setTimestamp($timestamp);
       
        $mDate = new \MongoDB\BSON\UTCDateTime( ($dt->format('U') * 1000));

        echo '<br>' .  $mDate . '<br>';

        $DATA['date2'] =$mDate ;

        $_D = __insert($_MONGO,$_DB, 'semanas',$DATA);


    }




}

