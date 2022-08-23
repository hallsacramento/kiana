<?php error_reporting(0); session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta charset="UTF-8" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />  
<title>Like</title>  
  <link rel="stylesheet" href="../default.css">
</head>

<body>

<?php


include("conf.php");
    
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

    echo $user = $ip_hash;

    $file = $_GET['url'];


    // In likes table search for the user and file liked

    $query = "SELECT * FROM deslikes WHERE file LIKE '$file' and user LIKE '$user'";


    $result = mysqli_query($db, $query);

        while ($row = mysqli_fetch_array($result)){
                $file_db = $row['0'];
                $user_db = $row['1'];
        }	


    if ($file_db != "" and $user_db != ""){echo "Already liked!"; die;} else{

	// In likes table insert user and file if not voted



        $query = "INSERT INTO deslikes (file, user) VALUES ('$file', '$user')";


        mysqli_query($db, $query);

        echo "Liked!";
	
    }

    // In like table count the numbers of likes of the file

    $query = "SELECT file, COUNT(file) FROM deslikes WHERE file LIKE '$file' GROUP BY file HAVING COUNT(file) > 0";


    $result = mysqli_query($db, $query);

        while ($row = mysqli_fetch_array($result)){

            $likes = $row['1'];     	
        }

    // Update the likes number in the file table


    $query = "UPDATE 64pic SET deslikes = '$likes' WHERE hash = '$file'";


    $result = mysqli_query($db, $query);



?>

</body>

</html>
