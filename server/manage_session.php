<?php
session_start();
if(isset($_SESSION['session_id']))
{
    ///ok
}
else
{
    echo 'Fail';
    exit();
    return null;
}
?>