<?php include("includes/db.php");

    if(isset($_POST) && !isset($_SESSION['object_id'])){
        $data = $_POST;
        //Inserting in main info
        $result = mysql_query("INSERT INTO objects(`title`,`city`,`description`,`date`) VALUES ('".$data['name']."','".$data['city']."','".$data['description']."','".date("Y-m-d H:i:s")."') ");
        $object_id = mysql_insert_id();  //last inserted id
        //Inserting texts
        $result = mysql_query("INSERT INTO object_options(`object_id`,`main_text`) VALUES ('".$object_id."','".$data['main_text']."') ");
        //Inserting coordinates
        $result = mysql_query("INSERT INTO coordinates(`object_id`,`coordx`,`coordy`) VALUES ('".$object_id."','".$data['coordx']."','".$data['coordy']."') ");
        
        if(mysql_error() != ''){
            die('MySql error');
        }
        $_SESSION['object_id'] = $object_id;
        print_r($_SESSION);
    }else{
        $data = $_POST;
        //Inserting in main info
        $result = mysql_query("UPDATE objects SET title='".$data['name']."',city='".$data['city']."',description='".$data['description']."',date='".date("Y-m-d H:i:s")."' WHERE id=".$_SESSION['object_id']."");
        $object_id = $_SESSION['object_id'];
        //Inserting texts
        $result = mysql_query("UPDATE object_options SET object_id='".$object_id."',main_text='".$data['main_text']."' WHERE object_id='".$object_id."' ");
        //Inserting coordinates
        $result = mysql_query("UPDATE coordinates SET object_id='".$object_id."',coordx='".$data['coordx']."',coordy='".$data['coordy']."' WHERE object_id='".$object_id."' ");
        
        if(mysql_error() != ''){
            die('MySql error');
        }
        //print_r($_SERVER);
        header('Location: '.$_SERVER['HTTP_ORIGIN'].'/digdig');
    }

?>
