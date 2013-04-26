<?php
include("includes/db.php");
include("includes/authcheck.php");
    $data = $_POST;
    $result = mysql_query("INSERT INTO ratings(`object_id`,`rate`,`user_id`,`date`) VALUES
    ('".$data['object_id']."','".$data['rate']."','".$_SESSION['User']['id']."','".date("Y-m-d H:i:s")."') ");
    if ($result) {

    }

?>