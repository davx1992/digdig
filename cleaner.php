<?php include("includes/db.php");

    if(isset($_GET['deletesession'])){
        $data = $_GET;
            unset($_SESSION[$_GET['deletesession']]);
    }

?>
