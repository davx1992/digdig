<?php
include("includes/db.php");
include("includes/authcheck.php");

    //Ieraksu sesija ka laboju objektu
    $_SESSION['edit'] = true;
    // Iznemu objektu no datubazes
    $data = getData();
    $result = mysql_query("
        SELECT objects.*, object_options.main_text
        FROM objects, object_options
        WHERE '" . $data['get']['id'] . "' = objects.id AND '" . $data['get']['id'] . "' = object_options.object_id");
    $object = mysql_fetch_array($result, MYSQL_ASSOC);
    $_SESSION['object_id'] = $data['get']['id']; var_dump($object);
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

                    <div class="input text">
                        <label>Description</label>
                        <textarea class="mceEditorSimpleEdit" name="description" value="<?php echo $object['description'] ?>"></textarea>
                    </div>

                    <div class="input text">
                        <label>Main text</label>
                        <textarea class="mceEditor" name="main_text" value="<?php echo $object['main_text'] ?>" ></textarea>
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