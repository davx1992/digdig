<?php include("includes/db.php");?>
<?php include("includes/authcheck.php"); ?>
<?php $_SESSION['menu'] = 'user' ?>

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
                <li class="your-objects active">Your objects</li>
                <li class="user-information">User information</li>
                <?php if ($_SESSION['User']['role'] == 2): ?>
                    <li><a href="admin_objectlist.php">Admin options</a></li>
                <?php endif ?>
            </ul>
        </div>

        <script type="text/javascript">
            <!-- Ajax userform actions -->
            function sendAjaxUserData() {
                $.post('<?php echo $baseUrl ?>ajax_userform.php', $('#user-form-data').serialize(), function(data){
                    $('#user-info-form').remove();
                    $('.maincol').append(data);
                });
            }

            function sendAjaxUserPassword() {
                $.post('<?php echo $baseUrl ?>ajax_userform.php', $('#user-password').serialize(), function(data){
                    $('#user-info-form').remove();
                    $('.maincol').append(data);
                });
            }
        </script>

        <div class="maincol">
            <div id="user_map_canvas"></div>
        </div>
    </div>
    <br style="clear: both;"/>
</div>
<div id="footer-wrap">
    <?php include('includes/footer.php'); ?>
</div>
</body>
</html>