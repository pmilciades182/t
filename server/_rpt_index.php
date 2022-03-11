<?php  

include_once('manage_session.php');

$_r = rand(111111111, 999999999);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="../../css/all.css" rel="stylesheet">
    <link href="../../css/tablas.css?r=<?php echo $_r  ?>" rel="stylesheet">
    <script defer src="../../js/pro.js"></script>
    <script src="../../js/s.js"></script>
    <script src="../../js/app.js?r=<?php echo $_r  ?>"></script>
    <script src="../../js/forms.js?r=<?php echo $_r  ?>"></script>
    <script src="../../js/j2.js"></script>
    <script src="entity.js?r=<?php echo $_r  ?>"></script>
</head>

<script>
    
    $(document).ready(function () {

      
        console.log( 'DSB_EMPRESA' + ' | ' + session_id);

    });

</script>


</html>