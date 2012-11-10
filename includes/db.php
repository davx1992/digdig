<?php

$db = mysql_connect("localhost","davx","Murafa");
if (!$db)
  {
  die('Could not connect: ' . mysql_error());
  }
  
$db_selected = mysql_select_db('digdig', $db);
$salt = "22asdas34ff211fssaw21r3f";

session_start();
?>