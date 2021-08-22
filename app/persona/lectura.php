<?php ?>

<!DOCTYPE html>
<html>
	<head>
		<title>Lector Facial</title>
        <script src="../../js/face-api.js"></script>

        
        <style>
            body{
                margin:0;
                padding:0;
                width: 800px;
                height: 600px;
                display: flex;
                justify-content : center;
                align-items: center;
            }
            canvas{
                position: absolute;
            }
        </style>

	</head>
	<body>

    <video 
    id="video"
    width="800px"
    height = "600px"
    autoplay
    muted
    > </video>
		
	</body>
</html>
<script src="../../js/face.js"></script>