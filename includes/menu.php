<?php if (isset($_SESSION['User'])) {
    $class = 'user_menu_wrap';
} else {
    $class = '';
} ?>
<div id="menu-wrap" class="<?php echo $class ?>">
    <ul id="menu">
        <li><a href="">Home<span>Welcome</span></a></li>
        <li><a href="">Objects<span>Explore</span></a></li>
        <li><a href="">Forum<span>Discuss</span></a></li>
        <li><a href="">News<span>Read</span></a></li>
        <li><a href="">About us<span>Get to know</span></a></li>
        <?php if (isset($_SESSION['User'])): ?>
            <li class="user_menu"><a href="#"><?php echo $_SESSION['User']['email'] ?></a>
                <ul>
                    <li><a href="<?php echo $baseUrl ?>user.php">User menu</a></li>
                    <li><a href="<?php echo $baseUrl ?>login.php?logout=true">Logout</a></li>
                </ul>
            </li>
        <?php endif ?>
    </ul>
</div>