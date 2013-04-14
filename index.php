<?php include("includes/db.php"); ?>
<?php
$result = mysql_query('
            SELECT gallery.*, objects.description
            FROM gallery, objects
            WHERE gallery.object_id = objects.id AND objects.description != ""
            ORDER BY date DESC
            LIMIT 6');
while ($object = mysql_fetch_array($result, MYSQL_ASSOC)) {
    $picres = mysql_query('
            SELECT pictures.*
            FROM pictures
            WHERE pictures.gallery_id = ' . $object['id']);
    while ($picture = mysql_fetch_array($picres, MYSQL_ASSOC)) {
        $pics['pictures'][] = $picture;
    }
    $gallery[] = array_merge($object, $pics);
    unset($pics);
}

/* Iznemu objekta reitingus, lai iznemtu labakos objektus */
$reitings = mysql_query('
            SELECT object_id, SUM(rate) / (SELECT COUNT(id) FROM ratings as ratingtb WHERE ratings.object_id = ratingtb.object_id) AS rate
            FROM ratings
            WHERE rate<=5
            GROUP BY object_id
            ORDER BY rate DESC LIMIT 4');

while ($reiting = mysql_fetch_array($reitings, MYSQL_ASSOC)) {
    $result = mysql_query('
                SELECT gallery.*, objects.description
                FROM gallery, objects
                WHERE gallery.object_id = "' . $reiting['object_id'] . '" AND objects.description != ""');
    $object = mysql_fetch_array($result, MYSQL_ASSOC);
    $picres = mysql_query('
                    SELECT pictures.*
                    FROM pictures
                    WHERE pictures.gallery_id = ' . $object['id'] . ' LIMIT 1');
    while ($picture = mysql_fetch_array($picres, MYSQL_ASSOC)) {
        $pics['pictures'][] = $picture;
    }
    $bestObjects[] = array_merge($object, $pics);
    unset($pics);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <title>DigDig - Worlds Diggers and Archeologist club</title>
    <link rel="shortcut icon" href="/digdig/img/favico.ico"/>
    <script type="text/javascript">
        var url = "<?php echo 'http://localhost/digdig/'?>";
    </script>
    <!-- Pievienojam skriptus -->
    <?php include("includes/scripts.php"); ?>
    <!-- END -->
</head>
<body onload="initialize();">

<!-- Overlay -->
<?php if (isset($_SESSION['message'])): ?>
<div class="overlay" id="mies1">
    <p><span> <?php echo $_SESSION['message'] ?></span></p>
</div>
<script type="text/javascript">
    jQuery('#mies1').overlay({
        top:150,
        mask:{
            loadSpeed:200,
            opacity:0.5
        },
        closeOnClick:true,
        load:true
    });
</script>
    <?php unset($_SESSION['message']); ?>
    <?php endif ?>
<!-- Overlay end -->

<div id="header-wrap">
    <?php include("includes/header.php"); ?>
</div>
<div id="cont-wrapper">
    <div id="content">
        <div id="canva-hider">
            <div id="map_canvas"></div>
        </div>
        <div id="featured-wrap">
            <h2 class="home-heading">
                <span>Latest objects</span>
            </h2>

            <div id="featured-objects">
                <?php foreach ($gallery as $k => $gal): ?>
                <?php $text = (strlen($gal['description']) > 140) ? substr($gal['description'], 0, 140) . '...' : $gal['description']; ?>
                <div class="object-small">
                    <img src="uploads/objects/<?php echo $gal['object_id'] ?>/<?php echo $gal['id'] ?>/thumbnail/<?php echo $gal['pictures'][0]['name'] ?>"/>
                    <a href="<?php echo $baseUrl . 'view.php?id=' . $gal['object_id'] ?>">
                        <p><?php echo $text ?></p>
                    </a>
                </div>
                <?php endforeach ?>
            </div>
        </div>
        <div id="latest-wrapper">
            <h2 class="home-heading">
                <span>Best objects</span>
            </h2>

            <div id="latest-objects">
                <?php if (isset($bestObjects) && !empty($bestObjects)): ?>
                <?php foreach ($bestObjects as $k => $best): ?>
                    <?php $text = (strlen($best['description']) > 140) ? substr($best['description'], 0, 140) . '...' : $best['description']; ?>
                    <div class="news-object object-small">
                        <img src="uploads/objects/<?php echo $best['object_id'] ?>/<?php echo $best['id'] ?>/thumbnail/<?php echo $best['pictures'][0]['name'] ?>"/>
                        <a href="<?php echo $baseUrl . 'view.php?id=' . $best['object_id'] ?>">
                            <p><?php echo $text ?></p>
                        </a>
                    </div>
                    <?php endforeach ?>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
<div id="footer-wrap">
    <?php include('includes/footer.php'); ?>
</div>
</body>
</html>