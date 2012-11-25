<?php include("includes/db.php");

    
    if(isset($_GET['action']) && $_GET['action'] == 'addgallery' ){
        $oid = $_POST['object'];
        $result = mysql_query("INSERT INTO gallery(`object_id`,`date`) VALUES ('".$oid."','".date("Y-m-d H:i:s")."') ");
        $gallery_id = mysql_insert_id();
        
        echo $gallery_id;

    }
    if(isset($_FILES) && !empty($_FILES)){
        $data = $_FILES;
            print_r($_FILES);
        if(mysql_error() != ''){
            die();
        }
    }

?>
