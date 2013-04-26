<?php include("includes/db.php"); ?>
<?php $_SESSION['menu'] = 'objects' ?>
<?php
    /* Kartoshana */
    if (isset($_GET['sort'])) {
        $_SESSION['sort'] = $_GET['sort'];
        $sortQuery = 'ORDER BY ' .  $_SESSION['sort'] . ' DESC';
    } elseif (isset($_SESSION['sort'])) {
        $sortQuery = 'ORDER BY ' .  $_SESSION['sort'] . ' DESC';
    } else {
        $sortQuery = '';
    }
    $perPage = 5;
    /* Mekleshanas skripts */
    if (isset($_POST['search'])) {
        $string = $_POST['search'];
        $flag = true;
        $result = mysql_query("
            SELECT objects.*, object_options.main_text, COUNT(pop.id) AS popularity,
            ((SELECT SUM(ratings.rate) FROM ratings WHERE ratings.object_id = objects.id) / (SELECT COUNT(rs.id) FROM ratings AS rs WHERE rs.object_id = objects.id)) AS rate
            FROM objects
            LEFT JOIN popularity AS pop ON pop.object_id = objects.id
            LEFT JOIN object_options ON object_options.object_id = objects.id
            WHERE objects.title LIKE '%" . $string . "%'
            OR objects.description LIKE '%" . $string . "%'
            OR objects.city LIKE '%" . $string . "%'
            OR object_options.main_text LIKE '%" . $string . "%'
            GROUP BY objects.id
            " . $sortQuery . "
            ");
    }
    /* Veidojam paginatoru */
    if (isset($_GET['page'])) {
        $start = ($_GET['page'] - 1) * $perPage;
        $cpage = $_GET['page'];
    } else {
        $start = 0;
        $cpage = 1;
    }

    $objectCount = mysql_query("SELECT COUNT(objects.id) AS object_count FROM objects WHERE 1");
    $objectCount = mysql_fetch_array($objectCount, MYSQL_ASSOC);

    if (isset($result)) {
        $objectCount = mysql_num_rows($result);
    }

    if ($objectCount['object_count'] > $perPage){
        $pages = ceil($objectCount['object_count'] / $perPage);
    } else {
        $pages = 0;
    }

    if (!isset($flag)) {
        /* Izņemmam no datubāzes objekta informāciju */
        $result = mysql_query("
            SELECT objects.*, object_options.main_text, COUNT(pop.id) AS popularity,
            ((SELECT SUM(ratings.rate) FROM ratings WHERE ratings.object_id = objects.id) / (SELECT COUNT(rs.id) FROM ratings AS rs WHERE rs.object_id = objects.id)) AS rate
            FROM objects
            LEFT JOIN popularity AS pop ON pop.object_id = objects.id
            LEFT JOIN object_options ON object_options.object_id = objects.id
            GROUP BY objects.id
            " . $sortQuery . "
            LIMIT " . $start . "," . $perPage . "");
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
<body>
<div id="header-wrap">
    <?php include("includes/header.php"); ?>
</div>
<div id="cont-wrapper">
    <div id="content">
        <h2 class="home-heading main listview">
            <span>Objects list</span>
            <form method="POST" action="<?php echo $baseUrl?>listview.php">
                <input name="search" class="search placeholder" value="Search:"/>
            </form>
            <p class="sort-by">
                <span>Sort By:</span>
                <?php (isset($_SESSION['sort']) && $_SESSION['sort'] == 'rate') ? $class = 'active' : $class = '' ?>
                <a href="?sort=rate" class="<?php echo $class ?>"><span>Rating</span> / </a>
                <span class="divider">/</span>
                <?php (isset($_SESSION['sort']) && $_SESSION['sort'] == 'popularity') ? $class = 'active' : $class = '' ?>
                <a href="?sort=popularity" class="<?php echo $class ?>"><span>Popularity</span></a>
            </p>
        </h2>

        <div id="left-col">
            <?php while ($object = mysql_fetch_array($result, MYSQL_ASSOC)): ?>
            <div class="object listview">
                <?php
                    $text = $object['main_text'];
                    $text = (strlen($text) > 1000) ? substr($text, 0, 1000) . '...' : $text;
                    $text = str_replace("<p>&nbsp;</p>","",$text);

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
            <?php if ($objectCount == 0): ?>
                <div class="nothing">No objects found.</div>
            <?php endif ?>
        </div>
        <?php if ($pages > 0): ?>
            <div class="paginator">
                <div class="paginator-holder-outer">
                    <div class="paginator-holder-inner">
                    <?php for ($i = 1; $i <= $pages; $i++): ?>
                        <?php if ($cpage == $i) $class = 'active' ?>
                        <a class="page <?php echo $class ?>" href="<?php echo $baseUrl ?>listview.php?page=<?php echo $i ?>"><?php echo $i ?></a>
                        <?php $class = ''; ?>
                    <?php endfor ?>
                    </div>
                </div>
                <div style="clear: both;"></div>
            </div>
        <?php endif ?>
        <br style="clear: both;"/>
    </div>
</div>
<div id="footer-wrap">
    <?php include('includes/footer.php'); ?>
</div>
</body>
</html>