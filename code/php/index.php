<?php
error_reporting(0); 
?>



<?php

/*/

Script for receive and save a image via base64

  - Close a file if the hash name changes (using session)
  - Create a temporary files to put together the GET chunks
  - Avoid overwrite final files

/*/

$id = $_GET['id'];  

if ($id != ""){

include("sql/conf.php");

$folder = "links";
	
$query = "SELECT * FROM 64pic WHERE id = '$id'";

$result = mysqli_query($db, $query);

while ($row = mysqli_fetch_array($result)){
 
      echo 'http://localhost/files/'. $hash = $row['1'];
      $img = $row['3'];
      $redirect = $row['8'];


if (!file_exists("$folder/$hash")){
    $file = fopen("$folder/$hash", "w");
    fwrite($file, "$img ");
    fclose($file);
}

}
die;
}else{

echo "
<div align='center'>
  <img src='img/logo_1.png'><br>
  <a href='search.php'>MySQL</a> / <a href='search_nosql.php'>No-SQL</a>
</div>";

}

function ip() {

    $ip = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ip = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ip = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ip = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ip = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ip = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ip = getenv('REMOTE_ADDR');
    else
        $ip = 'none';
    return $ip;
}

$ip = ip();

$ip_hash = sha1($ip);

$hash = $_GET['hash'];

$base64 = $_GET['base64'];

$blocked_chars = array ('<', '>');

$hash = str_replace($blocked_chars, "", $hash); 

$base64 = str_replace($blocked_chars, "", $base64); 

$ip_hash = str_replace($blocked_chars, "", $ip_hash); 

$folder = "links";

$folder_user = "users";

//Avoid the users use the symbol reserved for temporary files

$hash = str_replace("_","",$hash);

$base64 = str_replace(" ","+",$base64);

//Already exist files cannot be overwrite
if(file_exists("$folder/$hash")){

    echo "File already exists.";

    }else{

    //Open and write temporary file
    $base64_file = fopen("$folder/tmp_$hash", "a");
    fwrite($base64_file, $base64);
    fclose($base64_file);

}

$last_hash = file_get_contents("$folder_user/$ip_hash");
    
if($last_hash != "tmp_$hash"){

    $wallet = $_GET['wallet'];
    $category = $_GET['category'];
    $redirect = $_GET['redirect'];

    $wallet = str_replace($blocked_chars, "", $wallet); 
    $category = str_replace($blocked_chars, "", $category); 
    $redirect = str_replace($blocked_chars, "", $redirect); 
    
    $filename =  substr($last_hash, 4);
    rename("$folder/$last_hash", "$folder/$filename");

    $last = fopen("$folder_user/$ip_hash", "w");
    fwrite($last, "tmp_$hash");
    fclose($last);

    include("sql/conf.php");

    $day = date("d");

    $month = date("m");

    $year = date("y");



    
    $date = $year . '/' . $day . '/'. $month ;

    $base64_content = file_get_contents("$folder/$filename");

    $query = "INSERT INTO 64pic (hash, wallet, base64, date, category, redirect) VALUES ('$filename', '$wallet', '$base64_content', '$date', '$category', '$redirect')";

    $result = mysqli_query($db, $query);   

}

?>