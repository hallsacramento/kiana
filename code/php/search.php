<?php error_reporting(0); ?>

<html>
<head>
<style type="text/css">

a{
font-family: Arial;
letter-spacing: 2px;
}

i{
font-family: Verdana;
letter-spacing: 3px;
padding: 2px;
}

b{
font-size: 10px;
font-family: Arial;
letter-spacing: 2px;
padding-left: 5px;
}


body{
//letter-spacing: 2px;
//font-family: Verdana;
}

input{
border: 2px solid #DDD;
border-radius: 12px 12Px 12px 12px;
padding: 10px;
margin: 3px;
}

hr{
color: #DDD;
}

</style>
</head>

<script>
var clicked = false;
var host = "http://localhost/files/";

function likeFrame(url){

        var ifrm = document.createElement("iframe");
        ifrm.setAttribute("src", host + 'sql/like.php?url=' + url);
        ifrm.style.width = "0px";
        ifrm.style.height = "0px";
        ifrm.setAttribute("hidden", true);

        document.body.appendChild(ifrm);

        window.alert("Liked!");
}

function deslikeFrame(url){

        var ifrm = document.createElement("iframe");
        ifrm.setAttribute("src", host + 'sql/deslike.php?url=' + url);
        ifrm.style.width = "0px";
        ifrm.style.height = "0px";
        ifrm.setAttribute("hidden", true);

        document.body.appendChild(ifrm);        

        window.alert("Desliked!");
}    

</script>

<body>

<br>

<div align='right'><a href='search.php'><b>home</b></a>&nbsp;&nbsp;</div>

<div align='center'><img src='img/logo_1.png'>

<form action='search.php' method='POST'>

<input type='text' name='search' placeholder='Name'>

<br>

<input style='color: #333;border: 4px solid #DDD;border-radius: 10px 10Px 10px 10px;padding: 10px;margin: 2px;font-family: Verdana;letter-spacing: 2px;background-color: #20B2AA;text-decoration: none;' type='submit' Value='Search' name='submit_search' placeholder='Sua chave Pix'>

</form>

<table>
  <tr>
    <td>

<?php

// For include image search
$search = $_POST["search"];

if ($_POST["search"] == ""){$search = $_GET['search'];}

$unallowed_chars = array ('<', '>', "'", '"', '$', '*', ",");

$search = str_replace($unallowed_chars, "", $search); 

include("sql/conf.php");

$start = $_GET['start'];  
	
if (!$start){$start = 0;}

$limit = 20;

$ini = $start * $limit;
$end = $ini + $limit;

$query = "SELECT * FROM 64pic WHERE hash LIKE '%$search%' LIMIT $ini, $limit";

$result = mysqli_query($db, $query);

$count = "";

    while ($row = mysqli_fetch_array($result)){
 
      $count++;
      $hash = $row['1'];
      $img = $row['3'];
      $redirect = $row['8'];

      if($img == ""){continue;}

     $filename_len = strlen($hash);


     if ($filename_len == 40){
        $img = "<a href='$img' target='_blank'><img src='$img'></a>";	
     }else{
        $img = "<a href='$img' target='_blank'>$img</a>";	
     }

      echo "$hash <br> $img<br>";
      echo " <a href='#' onClick='likeFrame(" . '"' . $hash . '"' .  ")'>like</a> "; 
      echo " <a href='#' onClick='deslikeFrame(" . '"' . $hash . '"' .  ")'>deslike</a><hr></hr><br><br>";  
     

    }

      if ($count == ""){echo "<br><br<br><br><br><br>No items!";}


echo "<div align='center'></br></br></br></br>";

if ($start < 19){

    for ($i = 0; $i < 20; $i++){
     
        echo "<a href='$home?start=$i&search=$search'>$i/ </a>";
    }

}else{

    for ($i = $start; $i < $start+ 20; $i++){
     
        echo "<a href='$home?start=$i&search=$search'>$i/ </a>";
    }

} 

?>


<div id="ifrm">