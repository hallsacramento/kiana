<?php
error_reporting(0); 
?>

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
/*/
border: 2px solid #DDD;
border-radius: 12px 12Px 12px 12px;
padding: 20px;
margin: 2px;
font-family: Verdana;
letter-spacing: 2px;
text-decoration: none;
/*/
}

body{
letter-spacing: 2px;
font-family: Verdana;
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

<body>

<div align='center'>

<div align='right'><a href='search_nosql.php'><b>home</b></a>&nbsp;&nbsp;</div>

<div align='center'><img src='img/logo_1.png'></div>

<form action='search_nosql.php' method='POST'>

<input type='text' name='nome' placeholder='Name'>

<br>

<input style='color: #333;border: 4px solid #DDD;border-radius: 10px 10Px 10px 10px;padding: 10px;margin: 2px;font-family: Verdana;letter-spacing: 2px;background-color: #20B2AA;text-decoration: none;' type='submit' Value='Search' name='submit_search' placeholder='Sua chave Pix'>

</form>

<div align='center'>

<table width='80%'><tr><td>

</br>

<?php

$button_insert = $_POST['submit'];
$button_search = $_POST['submit_search'];
$p=$_GET['p'];

?>

</div>

<?php

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

$nome = $_POST['nome'];
$submit = $_POST['submit'];

$allow = 1;

$avoid_chars = array ('<', '>');

$avoid_chars_cat = array ('.', '//');

$nome = str_replace($avoid_chars, "", $nome); 

?>

<br>

<?php

if(!$p){$p=0;}$c= 0;$l=5;$n=$p*$l;$e=$n+$l;$y=0;$s=$_POST['nome'];

if($s == ''){$s = $_GET['s'];}

foreach(glob('links/*')as$f){

$name = explode('/', $f);
$name = $name[1];

$f=strtolower($f);

$g = file_get_contents($f); 

if($s!=''){

$m=str_replace($s,'',$f);$t=strlen($m);$o=strlen($f);}

if($o>$t||$s==''){

if($y>=$n&&$y<$e){

$dir_hash = sha1($f);

$q = "";
$q = file_get_contents("hashes/$dir_hash/total.txt");
$q--;

if ($q == ''){$q = 0;}

     $filename_len = strlen($f);

     if ($filename_len == 46){
        $g= "<a href='$g' target='_blank'><img src='$g'></a>";	
     }

echo "$name<br>$g<br><a href='search_nosql.php?comment_file=$f&p=$p&s=$name'>Comment</a>&nbsp;&nbsp;<a href='search_nosql.php?like_file=$f&p=$p&s=$name'>Like</a> ($q)";

echo "<hr></hr><br><br>";

}

$message = $_POST['message'];

if($_GET['comment_file'] == $f){

$comment_file = $_GET['comment_file'];

$avoid_chars = array ('<', '>', "//");

$message = str_replace($avoid_chars, "", $message); 

$filesize = filesize("$comment_file.txt");
if ($filesize > 5000){unlink("$comment_file.txt");}  

echo "<form action='search_nosql.php?comment_file=$comment_file&p=$p&s=$s' method='POST'>
      <br>
<div align='center'>
     Send<input type='text' name='message' maxlength='50'>
     
     <input type='submit' name='submit_comment' value='Enviar' style='background-color: #EEEEEE;'>
</div>
     </form><br>";

$ip = ip();

$ip_hash = sha1($ip);

$comment_file = 'hashes/' . sha1($comment_file);

echo "<div align='left'>";
include("$comment_file" . ".txt"); 
echo "</div>";

    $day = date("d");

    $month = date("m");

    $year = date("y");



    $hour = date('G');
    $min = date('i');
    $sec = date('s');    

    $date = $day . '/' . $month . '/' . $year;

if ($message != ''){
$write = fopen("$comment_file.txt", "a");
fwrite($write,"<b>$ip_hash" . " ($date)</b><br>" . "<i>$message</i>" . "<br><hr></hr>");
fclose($write);
header("Refresh:0");

}

}

if($_GET['like_file'] != '' && file_exists($_GET['like_file'])){
$z= 0;

$like_file = $_GET['like_file'];

$ip = ip();

$ip_hash = sha1($ip);

$dir_hash = 'hashes/' . sha1($like_file);

mkdir("$dir_hash");

$write = fopen("$dir_hash/$ip_hash", "a");
fwrite($write, "");
fclose($write);

foreach (glob("$dir_hash/*") as $u){
$z++;}

$write = fopen("$dir_hash/total.txt", "w");
fwrite($write, "$z");
fclose($write);
}


if($y==$e){break;}$y++;}}

echo "<div align='center'>";
if($p<19){for($i=0;$i<20;$i++){echo "<a href='search_nosql.php?p=$i&s=$s'>$i/ </a>";}}else{for($i=$p;$i<$p+20;$i++){echo '<a href=\'search_nosql.php' . '?p=' . $i . '&s=' . $s . '\'>' . $i . '/ </a>';}}
echo "</div>";

?>

</td></tr></table>

<div align='center'>
   
</div>

</br>

</div>


</div>
