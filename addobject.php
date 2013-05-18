<?php
include("includes/db.php");
include("includes/authcheck.php");
?>
<?php $_SESSION['menu'] = '' ?>
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
    <script type="text/javascript">
        var objectId = false;
        /* Lapas pameshanas parbaude */
        $(document).ready(function(){
            $('.add_button').click(function(){
                window.onbeforeunload = '';
//                if (!$(':.add_button["disabled"]')) {
//                    mainSave = true;
//                }
            });
            window.onbeforeunload = function (event) {
                var message = 'Sure you want to leave?';
                    event.returnValue = message;
                return message;
            }
//            window.onunload = deleteObject();
        });
//        function deleteObject() {
//            if (objectId && !mainSave) {  alert();
//                $.post('editobject.php?delete=' + objectId, function() { alert(objectId);});
//            }
//        }
    </script>
</head>
<body onload="initAddObject();">
<div id="header-wrap">
    <?php include("includes/header.php"); ?>
</div>
<div id="cont-wrapper">
    <div id="content">
        <h2 class="home-heading main">
            <span>Add object</span>
        </h2>

        <div id="addObjWrap">
            <div id="canva-hider-addobject">
                <div id="map_canvas_addobject"></div>
            </div>

            <div id="addObject">
                <form id="addObjectForm" action="objectsaver.php" method="POST">
                    <div class="fieldset">
                        <span class="legend">Main information</span>

                        <div class="input">
                            <input type="text" name="name" class="placeholder" place="Title" value="Title"/>
                        </div>

                        <div class="input">
                            <input type="text" name="city" class="placeholder" place="City" value="City"/>
                        </div>
                    </div>

                    <br style="clear:both;"/>
                    <input type="submit" class="add_button addObj" disabled value="Next">
                    <a class="addPhotosLink" id="addPhotoLink" >Add photos</a>

                    <div class="input text">
                        <label>Description</label>
                        <textarea class="mceEditorSimple" name="description"></textarea>
                    </div>

                    <div class="input text">
                        <label>Main text</label>
                        <textarea class="mceEditor" name="main_text"></textarea>
                    </div>

                    <!-- Hidden inputs -->
                    <input type="hidden" name="coordx" id="coordx" value=""/>
                    <input type="hidden" name="coordy" id="coordy" value=""/>


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