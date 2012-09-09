<?php

$db = mysql_connect("localhost","davx","Melnis92");
if (!$db)
  {
  die('Could not connect: ' . mysql_error());
  }
  
$db_selected = mysql_select_db('digdig', $db);

?>