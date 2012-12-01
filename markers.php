<?php include("includes/db.php");
    $result = mysql_query("SELECT * FROM coordinates",$db);
    $coords = array();
    while ($coord = mysql_fetch_assoc($result)){
        $object = mysql_query("SELECT `title` FROM objects WHERE objects.id = '".$coord['object_id']."'",$db);
        $title = mysql_fetch_assoc($object);
        $title = array("title"=>$title['title']);
        $coord = array_merge($coord, $title);
        $coords[]=$coord;
    } 
    echo json_encode($coords);
?>