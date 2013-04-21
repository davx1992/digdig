<?php include("includes/db.php");?>
<?php include("includes/authcheck.php"); ?>
<?php if ($_SESSION['User']['role'] < 2) header('Location: ' . $baseUrl . 'user.php') ?>
<?php
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
                <li class="active"><a href="admin_objectlist.php">Admin object list</a></li>
            </ul>
        </div>

        <div class="maincol admin">
            <?php
            $result = mysql_query("
                SELECT objects.*, object_options.main_text, users.id AS user_id, users.name, users.surname, users.email,
                (SELECT COUNT(comments.id)
                    FROM comments
                    WHERE comments.object_id = objects.id
                ) AS comment_count,
                (SELECT COUNT(pictures.id)
                    FROM pictures
                    WHERE pictures.gallery_id = (SELECT gallery.id
                        FROM gallery
                        WHERE gallery.object_id = objects.id LIMIT 1)
                ) AS picture_count
                FROM objects
                LEFT JOIN object_options ON object_options.object_id = objects.id
                LEFT JOIN users ON users.id = objects.user_id
                WHERE object_options.main_text != ''");
            ?>
            <div class="admin-listview-heading">
                <div class="title">Title</div>
                <div class="descr">Description</div>
                <div class="photocount">Photos count</div>
                <div class="comment-count">Comments count</div>
                <div class="user">User</div>
                <div class="actions">Actions</div>
                <br style="clear: both;"/>
            </div>
            <div class="line"></div>
            <?php while ($object = mysql_fetch_array($result, MYSQL_ASSOC)): ?>
                <div class="admin-listview">
                    <div class="title"><?php echo $object['title'] ?></div>
                    <div class="descr"><?php echo $object['description'] ?></div>
                    <div class="photocount"><?php echo $object['picture_count'] ?></div>
                    <div class="comment-count"><?php echo $object['comment_count'] ?></div>
                    <div class="user"><?php echo $object['name'] . ' ' . $object['surname'] ?></div>
                    <div class="actions"><a class="admin-delete" onclick="if(!confirm('Are you sure, about deletion?')) return false;" href="<?php echo $baseUrl ?>admin_objectlist.php?delete=<?php echo $object['id'] ?>">[delete]</a></div>
                    <br style="clear: both;"/>
                </div>
            <?php endwhile ?>
        </div>
    </div>
    <br style="clear: both;"/>
</div>
<div id="footer-wrap">
    <?php include('includes/footer.php'); ?>
</div>
</body>
</html>