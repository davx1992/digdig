<?php
include("includes/db.php");
require_once 'helpers/ThumbLib.inc.php';
    
    if(isset($_GET['action']) && $_GET['action'] == 'addgallery' ){
        $oid = $_POST['object'];
        $result = mysql_query("INSERT INTO gallery(`object_id`,`date`) VALUES ('".$oid."','".date("Y-m-d H:i:s")."') ");
        $gallery_id = mysql_insert_id();
        
        echo $gallery_id;

    }
    if(isset($_FILES) && !empty($_FILES)){
        $data = $_FILES;
            $uploads_dir = '/uploads';
            if ($data['file']['error'] == 0) {
                $tmp_name = $_FILES["file"]["tmp_name"];
                $name = $_FILES["file"]["name"];
                  
                $pic = PhpThumbFactory::create($tmp_name);  
                if($pic->resize(200, 200)->save('uploads/galleries/pictures/'.$name)){
                    echo 'uploads/galleries/pictures/'.$name;
                }  
            }
        if(mysql_error() != ''){
            die();
        }
    }

?>
