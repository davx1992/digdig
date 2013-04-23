<?php include("includes/db.php"); ?>
<?php
    /* Izņemmam no datubāzes objekta informāciju */
    $data = getData();
    $result = mysql_query("
            SELECT objects.*, object_options.main_text
            FROM objects, object_options
            WHERE '" . $data['get']['id'] . "' = objects.id AND '" . $data['get']['id'] . "' = object_options.object_id");
    $object = mysql_fetch_array($result, MYSQL_ASSOC);

    /* Dabūnu koordinātes */
    $result = mysql_query("SELECT * FROM coordinates WHERE coordinates.object_id = '" . $data['get']['id'] . "'", $db);
    $coord = mysql_fetch_array($result, MYSQL_ASSOC);
    $title = array("title" => $object['title']);
    $coord = array_merge($coord, $title);

    $coord = json_encode($coord);

    /* Iznemu bildes */
    $gallery = mysql_query("
            SELECT gallery.*
            FROM gallery
            WHERE gallery.object_id = '" . $data['get']['id'] . "'");
    $gallery = mysql_fetch_array($gallery, MYSQL_ASSOC);
    $pictures = mysql_query("
            SELECT pictures.*
            FROM pictures
            WHERE pictures.gallery_id = '" . $gallery['id'] . "'");

    while ($picture = mysql_fetch_array($pictures, MYSQL_ASSOC)) {
        $images[] = $picture;
    }

    $reitings = mysql_query("
            SELECT ratings.*
            FROM ratings
            WHERE ratings.object_id = '" . $data['get']['id'] . "'");
    $rate = 0;
    while ($reiting = mysql_fetch_array($reitings, MYSQL_ASSOC)) {
        $rate += $reiting['rate'];
        $ratings[] = $reiting;
    }

    $rated = false;

    if (!empty($ratings)) {
        $rate = round($rate / count($ratings));
        if ($logged) {
            foreach ($ratings as $r) {
                if ($r['user_id'] == $_SESSION['User']['id']) {
                    $rated = true;
                }
            }
        }
    }

    // Iznemu komentarus
    $comments = mysql_query("
            SELECT comments.*, users.name AS name, users.surname AS surname
            FROM comments, users
            WHERE comments.object_id = '" . $data['get']['id'] . "' AND comments.user_id = users.id");

    $editable = false;
    if (isset($_SESSION['User'])){
        if ($_SESSION['User']['id'] == $object['user_id']) {
            $editable = true;
        }
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
        var coords = <?php echo $coord ?>;
        var object_id = <?php echo $data['get']['id'] ?>;
    </script>
</head>
<body onload="initObjectView(coords);" class="view">
<div id="header-wrap">
    <?php include("includes/header.php"); ?>
</div>
<div id="cont-wrapper">
    <div id="content">
        <?php if($editable): ?>
            <a class="editlink" href="<?php echo $baseUrl ?>editobject.php?id=<?php echo $data['get']['id'] ?>"><p class="rotate">Edit</p></a>
        <?php endif ?>
        <h2 class="home-heading main view">
            <span><?php echo $object['title']?></span>

            <div class="rate-stars">
                <?php for ($i = 0; $i < 5; $i++): ?>
                <a class="star" href="#"></a>
                <?php endfor ?>
                <?php if ($rate != 0 && $rated): ?>
                <script type="text/javascript">
                    var rate = <?php echo $rate ?>;
                    var last = $('.rate-stars .star:last').index();
                    for (var i = last - rate + 1; i <= last; i++) {
                        $('.rate-stars .star').eq(i).addClass('rated');
                    }
                </script>
                <?php elseif ($rate != 0): ?>
                <script type="text/javascript">
                    var rate = <?php echo $rate ?>;
                    var last = $('.rate-stars .star:last').index();
                    for (var i = last - rate + 1; i <= last; i++) {
                        $('.rate-stars .star').eq(i).addClass('rate');
                    }
                </script>
                <?php endif ?>
            </div>
        </h2>
        <div id="object-map-hider">
            <div id="object-map">
                <!-- Map holder -->
            </div>
        </div>
        <div class="main-text">
            <div id="left-col">
                <div class="main-text-holder <?php if (isset($editable)) echo 'editable' ?>">
                    <?php echo $object['main_text'] ?>
                </div>
                <!-- Komentaari -->
                <div class="comments-block">
                    <p class="comments-count">
                        <strong>Total comments: <span><?php echo mysql_num_rows($comments) ?></span></strong>
                    </p>
                    <?php if (isset($_SESSION['User'])): ?>
                    <h3>Add comment:</h3>
                        <div class="add-block">
                            <form method="post" id="add_comment">
                                <textarea class="commenttext" name="commenttext"></textarea>
                                <input type="hidden" name="object_id" value="<?php echo $data['get']['id'] ?>"/>
                                <input type="hidden" name="name" value="<?php echo $_SESSION['User']['name'] ?>"/>
                                <input type="hidden" name="surname" value="<?php echo $_SESSION['User']['surname'] ?>"/>
                                <div class="submitter">
                                    <input type="submit" value="Comment" id="submit" onclick="sendComment(); return false;"/>
                                    <br style="clear: both;"/>
                                </div>
                            </form>
                        </div>
                    <?php else: ?>
                        <div class="no-comment">
                            <p><h3>To add comments on this object, please <a href="<?php echo $baseUrl ?>login.php">login</a> or
                            <a href="<?php echo $baseUrl ?>signup.php">signup</a></h3></p>
                        </div>
                    <?php endif ?>
                    <div class="comments-list">
                        <?php
                            if (mysql_num_rows($comments) > 0):
                            while ($comment = mysql_fetch_array($comments, MYSQL_ASSOC)):
                        ?>
                            <div class="comment">
                                <div class="info">
                                    <span class="username"><?php echo $comment['name'] . ' ' . $comment['surname'] ?></span>
                                    <span class="datetime"><?php echo date('Y-m-d H:i:s',strtotime($comment['date'])) ?></span>
                                </div>
                                <div class="comment-text">
                                    <?php echo $comment['comment'] ?>
                                </div>
                                <?php if ($comment['user_id'] == $_SESSION['User']['id'] || $_SESSION['User']['role'] > 0): ?>
                                    <a class="comment-delete" onclick="if(!confirm('Are you sure, about deletion?')) return false;" href="<?php echo $baseUrl ?>commentdelete.php?comment=<?php echo $comment['id'] ?>">[delete]</a>
                                <?php endif ?>
                            </div>
                        <?php
                            endwhile;
                            else:
                        ?>
                            <div class="no-comment">
                                <p><h3>No comments on this object.</h3></p>
                            </div>
                        <?php
                            endif;
                        ?>
                    </div>
                </div>
            </div>
            <div id="right-col">
                <?php foreach ($images as $k => $image): ?>
                <a rel="gallery_images"
                   href="./uploads/objects/<?php echo $data['get']['id'] ?>/<?php echo $gallery['id'] ?>/main/<?php echo $image['name'] ?>"
                   class="gallery">
                    <img src="./uploads/objects/<?php echo $data['get']['id'] ?>/<?php echo $gallery['id'] ?>/thumbnail/<?php echo $image['name'] ?>"/>
                </a>
                <?php endforeach ?>
            </div>
            <br style="clear: both;"/>
        </div>
    </div>
</div>
<div id="footer-wrap">
    <?php include('includes/footer.php'); ?>
</div>
</body>
</html>