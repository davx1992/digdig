<?php if (isset($_SESSION['User'])) {
    $class = 'user_menu_wrap';
} else {
    $class = '';
} ?>

<script type="text/javascript">
    var activeMenu = '<?php echo $_SESSION["menu"]?>';
</script>
<div id="menu-wrap" class="<?php echo $class ?>">
    <ul id="menu">
        <li><a href="<?php echo $baseUrl ?>" id="home">Home<span>Welcome</span></a></li>
        <li><a href="<?php echo $baseUrl ?>listview.php" id="objects">Objects<span>Explore</span></a></li>
        <li><a href="<?php echo $baseUrl ?>news.php" id="news">News<span>Read</span></a></li>
        <li><a href="<?php echo $baseUrl ?>about.php" id="aboutus">About us<span>Get to know</span></a></li>
        <?php if (isset($_SESSION['User'])): ?>
            <li class="user_menu"><a href="#" id="user"><?php echo $_SESSION['User']['email'] ?></a>
                <ul>
                    <li><a href="<?php echo $baseUrl ?>user.php">User menu</a></li>
                    <li><a href="<?php echo $baseUrl ?>login.php?logout=true">Logout</a></li>
                </ul>
            </li>
        <?php endif ?>
    </ul>
</div>