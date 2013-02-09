<?php

$db = mysql_connect("localhost","davx","Murafa");
if (!$db)
  {
  die('Could not connect: ' . mysql_error());
  }
  
$db_selected = mysql_select_db('digdig', $db);
$salt = "22asdas34ff211fssaw21r3f";

session_start();

//Nodroshinamies no mysql injekcijaam
function secure() {
    $_GET = array_map('trim', $_GET);
    $_POST = array_map('trim', $_POST);
    $_COOKIE = array_map('trim', $_COOKIE);
    $_REQUEST = array_map('trim', $_REQUEST);

    if(get_magic_quotes_gpc()) {
        $_GET = array_map('stripslashes', $_GET);
        $_POST = array_map('stripslashes', $_POST);
        $_COOKIE = array_map('stripslashes', $_COOKIE);
        $_REQUEST = array_map('stripslashes', $_REQUEST);
    }

    $_GET = array_map('mysql_real_escape_string', $_GET);
    $_POST = array_map('mysql_real_escape_string', $_POST);
    $_COOKIE = array_map('mysql_real_escape_string', $_COOKIE);
    $_REQUEST = array_map('mysql_real_escape_string', $_REQUEST);
}

secure();
?>