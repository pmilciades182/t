<?php
//// laboratorio

$DATA['id'] = '1,2,3';

var_dump($DATA['id']);

_hr();

$DATA['id'] = explode(",",$DATA['id']);

var_dump($DATA['id']);

_hr();



function _hr(){
    echo '<hr>';
}

function _br(){
    echo '<br>';
}

?>