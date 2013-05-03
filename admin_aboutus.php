<?php include("includes/db.php");?>
<?php include("includes/authcheck.php"); ?>
<?php if ($_SESSION['User']['role'] < 3) header('Location: ' . $baseUrl . 'user.php') ?>
<?php
    if (isset($_POST) && !empty($_POST)) {
        $result = mysql_query("
            INSERT INTO articles (user_id, title, main_text, date)
            VALUES ('" . $_SESSION['User']['id'] . "', '" . $_POST['title'] . "', '" . $_POST['main_text'] . "', '" . date('Y-m-d H:i:s') . "')");
            $error['type'] = 'success';
            $error['text'] = 'Succefully added article!';
    }
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
<body class="user-page">
<div id="header-wrap">
    <?php include("includes/header.php"); ?>
</div>
<div id="cont-wrapper">
    <div id="content">
        <h2 class="home-heading main view">
            <span>Add news article</span>
        </h2>
        <div class="leftcol">
            <ul class="user-menu-list">
                <li><a href="admin_objectlist.php">Admin object list</a></li>
                <li><a href="admin_newsarticle.php">Add news article</a></li>
                <?php if ($_SESSION['User']['role'] == 3): ?>
                    <li class="active"><a href="admin_aboutus.php">About us</a></li>
                <?php endif ?>
            </ul>
        </div>

        <div class="maincol admin">
            <?php if (isset($error)): ?>
                <div class="<?php echo $error['type'] ?>"><span><?php echo $error['text'] ?></span></div>
            <?php endif; ?>
            <form id="addNewsArticle" action="admin_aboutus.php" method="POST">
                <div class="input">
                    <input type="text" name="title" class="placeholder" place="Title" value="Title"/>
                </div>
                <div class="input">
                    <textarea class="mceEditorArticle" name="main_text"></textarea>
                </div>
                <button type="submit" class="submit">Submit</button>
            </form>
        </div>
    </div>
    <br style="clear: both;"/>
</div>
<div id="footer-wrap">
    <?php include('includes/footer.php'); ?>
</div>
</body>
</html>