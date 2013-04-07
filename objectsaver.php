<?php
include("includes/db.php");
include("includes/authcheck.php");

    if (isset($_POST) && isset($_GET['edit'])) {
        $data = $_POST;
        //Inserting in main info
        $result = mysql_query("UPDATE objects SET title='" . $data['name'] . "',city='" . $data['city'] . "',description='" . $data['description'] . "',date='" . date("Y-m-d H:i:s") . "' WHERE id=" . $_SESSION['object_id'] . "");
        $object_id = $_SESSION['object_id'];
        //Inserting texts
        $result = mysql_query("UPDATE object_options SET object_id='" . $object_id . "',main_text='" . $data['main_text'] . "' WHERE object_id='" . $object_id . "' ");

        if (mysql_error() != '') {
            die('MySql error');
        }
        if ($_GET['edit'] == 'redirect') {
            header('Location: ' . $baseUrl);
        }
    } elseif (isset($_POST) && !isset($_SESSION['object_id']) && !isset($_SESSION['saved'])) {
        $data = $_POST;
        //Inserting in main info
        $result = mysql_query("INSERT INTO objects(`title`,`city`,`description`,`date`) VALUES ('" . $data['name'] . "','" . $data['city'] . "','" . $data['description'] . "','" . date("Y-m-d H:i:s") . "') ");
        $object_id = mysql_insert_id(); //last inserted id
        //Inserting texts
        $result = mysql_query("INSERT INTO object_options(`object_id`,`main_text`) VALUES ('" . $object_id . "','" . $data['main_text'] . "') ");
        //Inserting coordinates
        $result = mysql_query("INSERT INTO coordinates(`object_id`,`coordx`,`coordy`) VALUES ('" . $object_id . "','" . $data['coordx'] . "','" . $data['coordy'] . "') ");

        if (mysql_error() != '') {
            die('MySql error');
        }
        $_SESSION['saved'] = true;
        $_SESSION['object_id'] = $object_id;
    } else {
        $data = $_POST;
        //Inserting in main info
        $result = mysql_query("UPDATE objects SET title='" . $data['name'] . "',city='" . $data['city'] . "',description='" . $data['description'] . "',date='" . date("Y-m-d H:i:s") . "' WHERE id=" . $_SESSION['object_id'] . "");
        $object_id = $_SESSION['object_id'];
        //Inserting texts
        $result = mysql_query("UPDATE object_options SET object_id='" . $object_id . "',main_text='" . $data['main_text'] . "' WHERE object_id='" . $object_id . "' ");
        //Inserting coordinates
        $result = mysql_query("UPDATE coordinates SET object_id='" . $object_id . "',coordx='" . $data['coordx'] . "',coordy='" . $data['coordy'] . "' WHERE object_id='" . $object_id . "' ");

        if (mysql_error() != '') {
            die('MySql error');
        }

        header('Location: ' . $baseUrl);
    }

?>
