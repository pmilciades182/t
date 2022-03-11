<?php
 $tz = 'America/Asuncion';
 $timestamp = time();
 $dt = new DateTime("now", new DateTimeZone($tz)); 
 $dt->setTimestamp($timestamp);
 $dt = date_modify($dt, "-3 hour");

 var_dump($dt);

 echo '<br><hr>';
 var_dump( $dt->format('U') * 1000 );
 echo '<br><hr>';

 $mDate = new \MongoDB\BSON\UTCDateTime( ($dt->format('U') * 1000) );

 var_dump($mDate);

