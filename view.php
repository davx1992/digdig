<?php include("includes/db.php");?>
<?php
    /* Izņemmam no datubāzes objekta informāciju */
    $data = getData();
    $result = mysql_query("
        SELECT objects.*, object_options.main_text
        FROM objects, object_options
        WHERE '".$data['get']['id']."' = objects.id AND '".$data['get']['id']."' = object_options.object_id");
    $object = mysql_fetch_array($result, MYSQL_ASSOC);

    /* Dabūnu koordinātes */
    $result = mysql_query("SELECT * FROM coordinates WHERE coordinates.object_id = '".$data['get']['id']."'",$db);
    $coord = mysql_fetch_array($result, MYSQL_ASSOC);
    $title = array("title"=>$object['title']);
    $coord = array_merge($coord, $title);

    $coord = json_encode($coord);

    /* Iznemu bildes */
    $gallery = mysql_query("
        SELECT gallery.*
        FROM gallery
        WHERE gallery.object_id = '".$data['get']['id']."'");
    $gallery = mysql_fetch_array($gallery, MYSQL_ASSOC);
    $pictures = mysql_query("
        SELECT pictures.*
        FROM pictures
        WHERE pictures.gallery_id = '".$gallery['id']."'");

    while ($picture = mysql_fetch_array($pictures, MYSQL_ASSOC)) {
        $images[] = $picture;
    }

    $reitings = mysql_query("
        SELECT ratings.*
        FROM ratings
        WHERE ratings.object_id = '".$data['get']['id']."'");
    $rate = 0;
    while ($reiting = mysql_fetch_array($reitings, MYSQL_ASSOC)) {
        $rate += $reiting['rate'];
        $ratings[] = $reiting;
    }

    $rated = false;

    if (!empty($ratings)) {
        $rate = round($rate/count($ratings));
        if ($logged) {
            foreach ($ratings as $r) {
                if ($r['user_id'] == $_SESSION['User']['id']) {
                    $rated = true;
                }
            }
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
<body onload="initObjectView(coords);">
<div id="header-wrap">
    <?php include("includes/header.php"); ?>
</div>
<div id="cont-wrapper">
    <div id="content">
        <h2 class="home-heading main view">
            <span><?php echo $object['title']?></span>
            <div class="rate-stars">
                <?php for ($i = 0; $i < 5; $i++): ?>
                    <a class="star" href="#" />
                <?php endfor ?>
                <?php if ($rate != 0 && $rated): ?>
                    <script type="text/javascript">
                        var rate = <?php echo $rate ?>;
                        var last = $('.rate-stars .star:last').index();
                        for (var i = last-rate+1; i <= last; i++) {
                            $('.rate-stars .star').eq(i).addClass('rated');
                        }
                    </script>
                <?php elseif($rate != 0): ?>
                    <script type="text/javascript">
                        var rate = <?php echo $rate ?>;
                        var last = $('.rate-stars .star:last').index();
                        for (var i = last-rate+1; i <= last; i++) {
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
                <?php echo $object['main_text'] ?>
            </div>
            <div id="right-col">
                <?php foreach ($images as $k=>$image): ?>
                    <a rel="gallery_images" href="./uploads/objects/<?php echo $data['get']['id'] ?>/<?php echo $gallery['id'] ?>/<?php echo $image['name'] ?>" class="gallery">
                        <img src="./uploads/objects/<?php echo $data['get']['id'] ?>/<?php echo $gallery['id'] ?>/<?php echo $image['name'] ?>"/>
                    </a>
                <?php endforeach ?>
            </div>
            <br style="clear: both;"/>
        </div>
        <?php //print_r($object); ?>
    </div>
</div>
<div id="footer-wrap">
    <div id="footer">

    </div>
</div>
</body>
</html>