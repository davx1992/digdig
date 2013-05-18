<?php include("includes/db.php");
    if (isset($_GET['user'])) {
        $result = mysql_query("SELECT id FROM objects WHERE user_id='" . $_GET['user'] . "'",$db);
        while ($object = mysql_fetch_assoc($result)){
            $coord_res = mysql_query("SELECT * FROM coordinates WHERE object_id='" . $object['id'] . "'",$db);
            $coordinates[] = mysql_fetch_array($coord_res, MYSQL_ASSOC);
        }
        $coords = array();
        foreach ($coordinates as $coord){
            $object = mysql_query("SELECT `title` FROM objects WHERE objects.id = '".$coord['object_id']."'",$db);
            $title = mysql_fetch_assoc($object);
            $title = array("title"=>$title['title']);
            $coord = array_merge($coord, $title);
            $coords[]=$coord;
        }
    } else {
        $result = mysql_query("
            SELECT *
            FROM coordinates
            RIGHT JOIN objects ON objects.id = coordinates.object_id
            WHERE objects.description != ''
            ",$db);
        $coords = array();
        while ($coord = mysql_fetch_assoc($result)){
            $object = mysql_query("SELECT `title` FROM objects WHERE objects.id = '".$coord['object_id']."'",$db);
            $title = mysql_fetch_assoc($object);
            $title = array("title"=>$title['title']);
            $coord = array_merge($coord, $title);
            $coords[]=$coord;
        }
    }
    echo json_encode($coords);
?>