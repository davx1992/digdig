<?php include("includes/db.php");?>
<?php include("includes/authcheck.php"); ?>
<?php
//    /* Dabūnu koordinātes */
//    $result = mysql_query("SELECT * FROM coordinates WHERE coordinates.object_id = '".$data['get']['id']."'",$db);
//    $coord = mysql_fetch_array($result, MYSQL_ASSOC);
//    $title = array("title"=>$object['title']);
//    $coord = array_merge($coord, $title);
//
//    $coord = json_encode($coord);
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
    <script type="text/javascript">
        var url = "<?php echo 'http://localhost/digdig/'?>";
    </script>
</head>
<body onload="initializeUserObjects(<?php echo $_SESSION['User']['id']?>);" class="user-page">
<div id="header-wrap">
    <?php include("includes/header.php"); ?>
</div>
<div id="cont-wrapper">
    <div id="content">
        <h2 class="home-heading main view">
            <span>User menu</span>
        </h2>
        <div class="leftcol">
            <ul class="user-menu-list">
                <li></li>
            </ul>
        </div>
        <div class="maincol">
            <div id="user_map_canvas"></div>
        </div>
    </div>
    <br style="clear: both;"/>
</div>
<div id="footer-wrap">
    <div id="footer">

    </div>
</div>
</body>
</html>