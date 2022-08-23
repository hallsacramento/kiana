<?php error_reporting(0); 

$host = "http://localhost/files/";

$id = $_GET['id'];  
	
if (!$id){$id = 1;}

$c = 1;

foreach (glob("*") as $f){


    if ($f == 'files.php'){
        continue;
    }

    if ($c == $id){
        echo "$host$f";
    }

$c++;
}


?>