<?php include("includes/db.php"); ?>
<?php $_SESSION['menu'] = 'news' ?>
<?php
    $perPage = 5;
    /* Veidojam paginatoru */
    if (isset($_GET['page'])) {
        $start = ($_GET['page'] - 1) * $perPage;
        $cpage = $_GET['page'];
    } else {
        $start = 0;
        $cpage = 1;
    }

    $objectCount = mysql_query("SELECT COUNT(news.id) AS news_count FROM news WHERE 1");
    $objectCount = mysql_fetch_array($objectCount, MYSQL_ASSOC);

    if (isset($result)) {
        $objectCount = mysql_num_rows($result);
    }

    if ($objectCount['news_count'] > $perPage){
        $pages = ceil($objectCount['news_count'] / $perPage);
    } else {
        $pages = 0;
    }
    /* Izņemmam no datubāzes objekta informāciju */
    $result = mysql_query("
        SELECT news.*
        FROM news
        LIMIT " . $start . "," . $perPage . "");
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
            <span>News</span>
        </h2>

        <div id="left-col">
            <?php while ($object = mysql_fetch_array($result, MYSQL_ASSOC)): ?>
                <div class="news listview">
                    <?php
                        $text = $object['main_text'];
                        $text = str_replace("<p>&nbsp;</p>","",$text);
                    ?>
                    <div class="left">
                        <a class="listview-heading">
                            <h3><?php echo $object['title'] ?></h3></a>
                        <p class="date">
                            <span><?php echo date('Y-m-d H:i:s' ,strtotime($object['date'])) ?></span>
                        </p>
                    </div>
                    <div class="text">
                    <!-- Ievietoju objekta tekstu -->
                        <?php echo $text ?>
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