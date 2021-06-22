<?php

function err_login($e)
{
    echo "
    <script>

    document.addEventListener('DOMContentLoaded', function(event) { 
        var f = document.getElementById('error');
        f.style.display = 'flex';
        f.innerText = '$e';
      });

    </script>
    
    ";

}