<?php include("includes/db.php");
//print_r($_SESSION);
//session_destroy();
if (isset($_POST) && !empty($_POST)) {
    $passw = sha1($_POST['password'] . $salt);
    $passw_sub = sha1($_POST['password_submit'] . $salt);
        if ($passw != $passw_sub) {
            $error['type'] = 'error';
            $error['text'] = 'Passwords do not match!';
        }
    $exist = mysql_query("SELECT * FROM users WHERE email = '" . $_POST['email'] . "'", $db);
    $exist_email = mysql_fetch_array($exist, MYSQL_ASSOC);
    if (!isset($error)){
        if ($exist_email) {
            $error['type'] = 'error';
            $error['text'] = 'User with this Email already exists!';
        } else {
            $result = mysql_query("INSERT INTO users(`email`, `password`, `name`, `surname`, `activation`, `date`) VALUES ('" . $_POST['email'] . "','" . $passw . "','" . $_POST['name'] . "','" . $_POST['surname'] . "', '" . md5($_POST['email']) . "', '" . date('Y-m-d h:i:s') . "')", $db);
            if ($result) {
                $error['type'] = 'success';
                $error['text'] = 'Succeffuly registred your account! Confirmation email was sent to ' . $_POST['email'] . '.';
                $to = $_POST['email'];
                $subject = 'DigDig - verification email';
                $message = 'You succeffuly registred in DigDig.com!<br />
                    To activate your account follow this link: <br />'
                    . '<a href="'. $baseUrl . 'activate.php?email=' . $_POST['email'] . '&key=' . md5($_POST['email']) . '">'
                    . $baseUrl . 'activate.php?email=' . $_POST['email'] . '&key=' . md5($_POST['email']) . '</a>';

                $headers = "From: noreply@digdig.com \r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                mail($to, $subject, $message, $headers);
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

        <?php if (isset($error)): ?>
        <div class="<?php echo $error['type'] ?>"><span><?php echo $error['text'] ?></span></div>
            <?php
                if ($error == 'success') {
                    header('Location: ' . $_SERVER['HTTP_ORIGIN'] . '/digdig');
                }
            ?>
        <?php endif; ?>

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
                <label>Email</label>
                <input type="text" name="email" class="required email"/>
            </div>
            <div class="input">
                <label>Password</label>
                <input type="password" name="password" class="required"/>
            </div>
            <div class="input">
                <label>Repeat password</label>
                <input type="password" name="password_submit" class="required"/>
            </div>
            <div class="submitter">
                <input type="submit" value="Submit" id="submit"/>
            </div>
        </form>
        <script type="text/javascript">
            $('#submit').click(function () {
                if (!$('form#signup').validate()) {
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