<?php ?>

<!DOCTYPE html>
<html>
	<head>
		<title>Lector Facial</title>
        <script src="../../js/face-api.js"></script>

        <style>
            html{
    
                display: flex;
                width: 100%;
                height: 100%;
                justify-content: center;
                align-items: center;
            }

            body{
                margin:0;
                padding:0;
       
                display: flex;
                justify-content : center;
                align-items: center;
                background-color: coral;
            }

            canvas{
                position: absolute;
            }
        </style>
 
	</head>
	<body>

    <video 
    id      = "video"
    width   = "800px"
    height  = "600px"
    autoplay
    muted
    > </video>
		
	</body>
</html>
<?php 
if(isset($_GET['id']))
{

echo '<script>';
echo ' var global_id = ' . $_GET['id'] . ';';
echo '</script>';

}
?>
<script src="../../js/s.js"></script>
<script src="../../js/face.js"></script>