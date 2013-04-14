<?php include("includes/db.php");
if (isset($_GET['logout'])) {
    unset($_SESSION['User']);
}

if (isset($_POST) && !empty($_POST)) {
    $email = $_POST['email'];
    $passw = sha1($_POST['password'] . $salt);
    $result = mysql_query("SELECT * FROM users WHERE email = '" . $email . "' AND password = '" . $passw . "' AND activation = ''", $db);
    $user = mysql_fetch_array($result, MYSQL_ASSOC);
    if ($user) {
        unset($user['password']);
        $_SESSION['User'] = $user;
        header('Location: ' . $_SERVER['HTTP_ORIGIN'] . '/digdig');
        $_SESSION['message'] = "You succsefuly logged in! Greetings from DigDig!";
    } else {
        $error = "Wrong email or password!";
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

</head>
<body>
<div id="header-wrap">
    <?php include("includes/header.php"); ?>
</div>
<div id="cont-wrapper">
    <div id="content">
        <h2 class="home-heading main">
            <span>Login</span>
        </h2>

        <?php if (isset($error)): ?>
        <div class="error"><span><?php echo $error ?></span></div>
        <?php endif; ?>

        <form action="login.php" method="post" id="login" style="min-height: 200px;">
            <div class="fieldset" id="login-form">
                <div class="input">
                    <label>E-mail</label>
                    <input type="text" name="email"/>
                </div>
                <div class="input">
                    <label>Password</label>
                    <input type="password" name="password"/>
                </div>
                <div class="submitter">
                    <input type="submit" value="Login" id="submitLogin"/>
                    <a href="signup.php" class="signup-link">Sign up?</a>
                </div>
            </div>
        </form>
    </div>
</div>
<div id="footer-wrap">
    <?php include('includes/footer.php'); ?>
</div>
</body>
</html>