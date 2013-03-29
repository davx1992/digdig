<?php include("includes/db.php"); ?>
<?php
    $result = mysql_query('
            SELECT gallery.*, objects.description
            FROM gallery, objects
            WHERE gallery.object_id = objects.id
            ORDER BY date DESC
            LIMIT 6');
    while ($object = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $picres = mysql_query('
            SELECT pictures.*
            FROM pictures
            WHERE pictures.gallery_id = '.$object['id']);
        while ($picture = mysql_fetch_array($picres, MYSQL_ASSOC)) {
             $pics['pictures'][] = $picture;
        }
        $gallery[] = array_merge($object, $pics);
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
    <?php if(isset($_SESSION['message'])): ?>
        <div class="overlay" id="mies1">
            <p><span> <?php echo $_SESSION['message'] ?></span></p>
        </div>
        <script type="text/javascript">
            jQuery('#mies1').overlay({
                top: 150,
                mask: {
                    loadSpeed: 200,
                    opacity: 0.5
                },
                closeOnClick: true,
                load: true
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
                    <div class="object-small">
                        <img src="uploads/objects/<?php echo $gal['object_id'] ?>/<?php echo $gal['id'] ?>/<?php echo $gal['pictures'][0]['name'] ?>"/>
                        <a href="<?php echo $baseUrl.'view.php?id='.$gal['object_id'] ?>">
                            <p><?php echo $gal['description']?></p>
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
                <div class="news-object object-small">
                    <img src="img/dummies/featured-1.jpg"/>
                    <a href="/">
                        <p>Grumpy wizards make toxic brew for the evil Queen and Jack.
                            One morning, when Gregor Samsa woke from troubled dreams,
                            His many legs, pitifully thin compared with the size of
                            the rest of him, waved about</p>
                    </a>
                </div>
                <div class="news-object object-small">
                    <img src="img/dummies/featured-1.jpg"/>
                    <a href="/">
                        <p>Grumpy wizards make toxic brew for the evil Queen and Jack.
                            One morning, when Gregor Samsa woke from troubled dreams,
                            His many legs, pitifully thin compared with the size of
                            the rest of him, waved about</p>
                    </a>
                </div>
                <div class="news-object object-small">
                    <img src="img/dummies/featured-1.jpg"/>
                    <a href="/">
                        <p>Grumpy wizards make toxic brew for the evil Queen and Jack.
                            One morning, when Gregor Samsa woke from troubled dreams,
                            His many legs, pitifully thin compared with the size of
                            the rest of him, waved about</p>
                    </a>
                </div>
                <div class="news-object object-small">
                    <img src="img/dummies/featured-1.jpg"/>
                    <a href="/">
                        <p>Grumpy wizards make toxic brew for the evil Queen and Jack.
                            One morning, when Gregor Samsa woke from troubled dreams,
                            His many legs, pitifully thin compared with the size of
                            the rest of him, waved about</p>
                    </a>
                </div>
            </div>
        </div>
        <?php //include("includes/rightside.php"); ?>
    </div>
</div>
<div id="footer-wrap">
    <div id="footer">

    </div>
</div>
</body>
</html>