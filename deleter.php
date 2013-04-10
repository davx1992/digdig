<?php
include("includes/db.php");
include("includes/authcheck.php");

    if (isset($_POST) && !empty($_POST)) {
        $query = mysql_query("DELETE FROM pictures WHERE gallery_id='" . $_POST['gallery_id'] . "' AND name='" . $_POST['name'] . "'", $db);
        $gallery_id = $_POST['gallery_id'];
        $oid = $_POST['object_id'];
        $uploads_dir = '/uploads/objects/' . $oid . '/';
    }
    if (mysql_error() != '') {
        die();
    }
    if ($query) {
        if (unlink(dirname(__FILE__) . $uploads_dir . $gallery_id . '/thumbnail/' . $_POST['name'])) {
            unlink(dirname(__FILE__) . $uploads_dir . $gallery_id . '/main/' . $_POST['name']);
            echo json_encode(array('response' => true));
        }
    }

?>
