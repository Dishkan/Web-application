<?php
   $list = array(15, "22", "My string", true);
   echo $list [2];
   $list[] = "New Element";
   echo"<br />";
   echo $list[4];
   $list[4] = "Change";
   echo"<br />";
   echo $list[4];
   for ($i = 0; $i < count($list); $i++) {
	 echo "<br />";
	 echo "Элемент индексом $i равен :<b>".$list[$i]."</b><br />";  
   }
?>