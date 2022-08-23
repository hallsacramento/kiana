
<div align='center'>
<table width='60%'>
<tr>
<td>
<?php

$search = $_POST["search"];

if ($_POST["search"] == ""){$search = $_GET['search'];}

$unallowed_chars = array ('<', '>', "'", '"', '$', '*', ",");

$search = str_replace($unallowed_chars, "", $search); 

include("sql/link_conf.php");

$start = $_GET['start'];  
	
if (!$start){$start = 0;}

$limit = 20;

$ini = $start * $limit;
$end = $ini + $limit;

$query = "SELECT * FROM instances WHERE name LIKE '%$search%' OR categories LIKE '%$search%' OR description LIKE '%$search%' OR url LIKE '%$search%' ORDER BY likes DESC LIMIT $ini, $end";

$result = mysqli_query($db, $query);

$count = "";

    while ($row = mysqli_fetch_array($result)){
 
       $count++;

       $id = $row['0'];
       $name = $row['1'];
       $hash = $row['2'];
       $user = $row['3'];
       $url = $row['4'];
       $category = $row['5'];
       $date = $row['6'];
       $size = $row['7'];
       $description = $row['8'];
       $image = $row['9'];
       $urls = $row['18'];

       echo "$date - <a href='$url' target='_blank'>$url</a> ";

       if ($name){echo "Name: $name/ ";}
       if ($user){echo "Creator: $user/ ";}
       if ($size){echo "Size: $size/ ";}
       if ($description){echo "Description: $description/ ";}
       if ($category){echo "Categories: $category/ ";}
       if ($urls){echo "Mirros";}

       $link_list = explode(",", $urls);
       $list_size = count($link_list);

      for ($i = 0; $i < $list_size; $i++){

          echo "/ <a href='$link_list[$i]' target='_blank'>$link_list[$i]</a>";

      }      
      
       echo " <a href='#' onClick='likeFramelk(" . '"' . $url . '"' .  ")'><img src='symbols/thumb_up.png' width='20'></a> "; 

       echo " <a href='#' onClick='deslikeFramelk(" . '"' . $url . '"' .  ")'><img src='symbols/thumb_down.png' width='20'></a><br>";  

       echo "<br>";

   

    }


      if ($count == ""){echo "<br><br<br<br><br><br><div align='center'>No links!</div>";}

?>

</td>
</tr>
</table>
</div>
<br>
<hr></hr>
<br>