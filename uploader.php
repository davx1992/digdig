<?php
include("includes/db.php");
include("includes/authcheck.php");
require_once 'helpers/ThumbLib.inc.php';
    
    //if(isset($_GET['action']) && $_GET['action'] == 'addgallery' ){
    //    $oid = $_POST['object'];
    //    $result = mysql_query("INSERT INTO gallery(`object_id`,`date`) VALUES ('".$oid."','".date("Y-m-d H:i:s")."') ");
    //    $gallery_id = mysql_insert_id();
    //    
    //    echo $gallery_id;
    //
    //}
    
    //print_r($_SESSION); print_r(session_id());
    
    if(isset($_FILES) && !empty($_FILES)){
        $data = $_FILES;
            if ($data['file']['error'] == 0) {
                /* Izveidojam galeriju */
                $oid = $_SESSION['object_id'];
                if( !isset($_SESSION['gallery_id'])){
                    $result = mysql_query("INSERT INTO gallery(`object_id`,`date`) VALUES ('".$oid."','".date("Y-m-d H:i:s")."')");
                    $_SESSION['gallery_id'] = mysql_insert_id();
                }
                $gallery_id = $_SESSION['gallery_id'];
                $uploads_dir = '/uploads/objects/'.$oid.'/';
                
                /* Izveidojam mapi uz servera */
                if(!file_exists(dirname(__FILE__).$uploads_dir.$gallery_id."/")) {
                    mkdir(dirname(__FILE__).$uploads_dir.$gallery_id, 0777,true);
                }
                
                $tmp_name = $_FILES["file"]["tmp_name"];
                $name = time().'.jpg';
                  
                $pic = PhpThumbFactory::create($tmp_name);  
                if($pic->resize(200, 200)->save('uploads/objects/'.$oid.'/'.$gallery_id.'/'.$name)){
                    /* Pievienojam datubaze attelus */
                    $result = mysql_query("INSERT INTO pictures(`gallery_id`,`name`,`date`) VALUES ('".$gallery_id."','".$name."','".date("Y-m-d H:i:s")."') ");
                    /* Izvadu celju uz atteliem */
                    echo 'uploads/objects/'.$oid.'/'.$gallery_id.'/'.$name;
                }  
            }
        if(mysql_error() != ''){
            die();
        }
    }

?>
