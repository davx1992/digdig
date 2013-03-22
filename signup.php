<?php include("includes/db.php");
//print_r($_SESSION);
//session_destroy();
if (isset($_POST) && !empty($_POST)) {
    $email = $_POST['email'];
    $passw = sha1($_POST['password'] . $salt);
    $result = mysql_query("SELECT * FROM users WHERE email = '" . $email . "' AND password = '" . $passw . "'", $db);
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
            <span>Signup</span>
        </h2>

        <div class="error"><?php if (isset($error)) echo $error; ?></div>
        <form action="signup.php" method="post" id="signup">
            <div class="input">
                <label>Name</label>
                <input type="text" name="name" class="required"/>
            </div>
            <div class="input">
                <label>Surname</label>
                <input type="text" name="surname" class="required"/>
            </div>
            <div class="input">
                <label>email</label>
                <input type="text" name="surname"  class="required"/>
            </div>
            <div class="input">
                <label>Password</label>
                <input type="password" name="password"  class="required"/>
            </div>
            <div class="submitter">
                <input type="submit" value="Login" id="submit"/>
            </div>
        </form>
        <script type="text/javascript">
            $('#submit').click(function(){
                if (!$('form#signup').validate()){
                    return false;
                }
            });
        </script>
        <br style="clear: both;"/>
    </div>
</div>
<div id="footer-wrap">
    <div id="footer">

    </div>
</div>
</body>
</html>