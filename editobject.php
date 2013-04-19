<?php
include("includes/db.php");
include("includes/authcheck.php");

    /* Dzeesham aara objektu */
    if (isset($_GET['delete'])) {
        $query = mysql_query("DELETE objects.*, object_options.*, coordinates.*
            FROM objects
            LEFT JOIN object_options ON object_options.object_id = objects.id
            LEFT JOIN coordinates ON coordinates.object_id = objects.id
            WHERE objects.id = " . $_GET['delete']);

        $query = mysql_query("DELETE gallery.*, pictures.*
            FROM gallery
            LEFT JOIN pictures ON pictures.gallery_id = gallery.id
            WHERE gallery.object_id = " . $_GET['delete']);

        header('Location: ' . $baseUrl . 'user.php');
    }

    // Iznemu objektu no datubazes
    $data = getData();
    $result = mysql_query("
        SELECT objects.*, object_options.main_text
        FROM objects, object_options
        WHERE '" . $data['get']['id'] . "' = objects.id AND '" . $data['get']['id'] . "' = object_options.object_id");
    $object = mysql_fetch_array($result, MYSQL_ASSOC);

    //Ieraksu sesija ka laboju objektu
    if (isset($_SESSION['User'])){
        if ($_SESSION['User']['id'] == $object['user_id'] || $_SESSION['User']['role'] == 2) {
            $editable = true;
        } else {
            header('Location: ' . $baseUrl . 'user.php');
        }
    }
    $_SESSION['object_id'] = $data['get']['id'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <title>DigDig - Worlds Diggers and Archeologist club</title>
    <link rel="shortcut icon" href="/digdig/img/favico.ico"/>
    <!-- Pievienojam skriptus -->
    <?php include("includes/scripts.php"); ?>
    <!-- END -->
</head>
<body class="editobject">
<div id="header-wrap">
    <?php include("includes/header.php"); ?>
</div>
<div id="cont-wrapper">
    <div id="content">
        <h2 class="home-heading main">
            <span>Edit object</span>
        </h2>

        <div id="addObjWrap">
            <div id="addObject">
                <form id="addObjectForm" action="objectsaver.php?edit=redirect" method="POST">
                    <div class="fieldset">
                        <span class="legend">Main information</span>

                        <div class="input">
                            <input type="text" name="name" value="<?php echo $object['title'] ?>" placeholder="Title"/>
                        </div>

                        <div class="input">
                            <input type="text" name="city" value="<?php echo $object['city'] ?>" placeholder="City"/>
                        </div>
                    </div>

                    <br style="clear:both;"/>
                    <input type="submit" class="add_button addObj" value="Next">
                    <a class="addPhotosLink edit" id="editPhotoLink">Add photos</a>
                    <a class="admin-delete" onclick="if(!confirm('Are you sure, about deletion?')) return false;" href="<?php echo $baseUrl ?>editobject.php?delete=<?php echo $object['id'] ?>">[delete]</a>

                    <div class="input text">
                        <label>Description</label>
                        <textarea class="mceEditorSimpleEdit" id="description" name="description"><?php echo $object['description'] ?></textarea>
                    </div>

                    <div class="input text">
                        <label>Main text</label>
                        <textarea class="mceEditor" id="main_text" name="main_text"><?php echo $object['main_text'] ?></textarea>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="footer-wrap">
    <?php include('includes/footer.php'); ?>
</div>
</body>
</html>