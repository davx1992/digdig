<?php include("includes/db.php");

    if(isset($_FILES)){
        $data = $_FILES;
            print_r($_FILES);
        if(mysql_error() != ''){
            die();
        }
    }

?>
