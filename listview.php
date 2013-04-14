<?php include("includes/db.php"); ?>
<?php
/* Izņemmam no datubāzes objekta informāciju */
$data = getData();
$result = mysql_query("
            SELECT objects.*, object_options.main_text
            FROM objects, object_options
            WHERE objects.id = object_options.object_id AND object_options.main_text != ''");

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
        <h2 class="home-heading main view">
            <span>List view</span>
        </h2>

        <div id="left-col">
            <?php while ($object = mysql_fetch_array($result, MYSQL_ASSOC)): ?>
            <div class="object listview">
                <?php
                    $text = $object['main_text'];
                    $text = (strlen($text) > 1000) ? substr($text, 0, 1000) . '...' : $text;

                    /* Iznemu objekta reitingus */
                    $reitings = mysql_query("
                            SELECT ratings.*
                            FROM ratings
                            WHERE ratings.object_id = '" . $object['id'] . "'");
                    $rate = 0;

                    $ratings = array();
                    while ($reiting = mysql_fetch_array($reitings, MYSQL_ASSOC)) {
                        $rate += $reiting['rate'];
                        $ratings[] = $reiting;
                    }

                    if (!empty($ratings)) {
                        $rate = round($rate / count($ratings));
                    }
                ?>

                <a class="listview-heading" href="<?php echo $baseUrl . 'view.php?id=' . $object['id'] ?>">
                    <h3><?php echo $object['title'] ?></h3></a>

                <!-- Lieku reitingus -->
                <div class="rate-stars">
                    <?php if ($rate !=0): ?>
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <?php if ($rate !=0): ?>
                                <a class="stare rate" href="#"></a>
                            <?php  $rate--; else: ?>
                                <a class="stare" href="#"></a>
                            <?php endif ?>
                        <?php endfor ?>
                    <?php else: ?>
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <a class="stare" href="#"></a>
                        <?php endfor ?>
                    <?php endif ?>
                </div>
                <div class="text">
                <!-- Ievietoju objekta tekstu -->
                    <?php echo $text ?>
                </div>
                <div class="photo">
                    <?php
                        /* Iznemu bildes */
                        $gallery = mysql_query("
                                    SELECT gallery.*
                                    FROM gallery
                                    WHERE gallery.object_id = '" . $object['id'] . "'");
                        $gallery = mysql_fetch_array($gallery, MYSQL_ASSOC);
                        $pictures = mysql_query("
                                    SELECT pictures.*
                                    FROM pictures
                                    WHERE pictures.gallery_id = '" . $gallery['id'] . "' LIMIT 1");

                        $picture = mysql_fetch_array($pictures, MYSQL_ASSOC);
                    ?>
                    <a href="<?php echo $baseUrl . 'view.php?id=' . $object['id'] ?>">
                        <img src="./uploads/objects/<?php echo $object['id'] ?>/<?php echo $gallery['id'] ?>/thumbnail/<?php echo $picture['name'] ?>"/>
                    </a>
                </div>
                <br style="clear: both;"/>
            </div>
            <?php endwhile ?>
        </div>
        <br style="clear: both;"/>
    </div>
</div>
<div id="footer-wrap">
    <?php include('includes/footer.php'); ?>
</div>
</body>
</html>