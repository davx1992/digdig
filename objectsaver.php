<?php include("includes/db.php");

    if(isset($_POST)){
        $data = $_POST;
        //Inserting in main info
        $result = mysql_query("INSERT INTO objects(`title`,`city`,`description`,`date`) VALUES ('".$data['name']."','".$data['city']."','".$data['description']."','".date("Y-m-d H:i:s")."') ");
        $object_id = mysql_insert_id();  //last inserted id
        //Inserting texts
        $result = mysql_query("INSERT INTO object_options(`object_id`,`main_text`) VALUES ('".$object_id."','".$data['main_text']."') ");
        //Inserting coordinates
        $result = mysql_query("INSERT INTO coordinates(`object_id`,`coordx`,`coordy`) VALUES ('".$object_id."','".$data['coordx']."','".$data['coordy']."') ");
        
        if(mysql_error() != ''){
            die();
        }
        
        header('Location:'.$_SERVER['HTTP_REFERER'].'?object_id='.$object_id);
    }

?>
