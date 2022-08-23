<?php

if (!$db = mysqli_connect('', 'root', '')){/*/echo 'mysqli_connet error'/*/; $db_error = 1;}

if (!mysqli_select_db($db,'base64')){/*/echo 'mysqli_select_db error'/*/; $db_error2 = 1;} 


?>