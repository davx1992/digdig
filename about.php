<?php include("includes/db.php"); ?>
<?php $_SESSION['menu'] = 'aboutus' ?>
<?php
    $result = mysql_query('SELECT * FROM articles WHERE title = "About Us"');
    $article = mysql_fetch_array($result, MYSQL_ASSOC);
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
<body>
<div id="header-wrap">
    <?php include("includes/header.php"); ?>
</div>
<div id="cont-wrapper">
    <div id="content">
        <h2 class="home-heading main news">
            <span>About Us</span>
        </h2>
        <div id="left-col">
            <div class="aboutus">
                <div class="text">
                   <?php echo $article['main_text'] ?>
                </div>
                <br style="clear: both;"/>
            </div>
        </div>
        <br style="clear: both;"/>
    </div>
</div>
<div id="footer-wrap">
    <?php include('includes/footer.php'); ?>
</div>
</body>
</html>