<?php
include("includes/db.php");
if (isset($_GET['email']) && isset($_GET['key'])) {
    $key = $_GET['key'];
    $email = $_GET['email'];
    $result = mysql_query("SELECT * FROM users WHERE activation = '" . $key . "' AND email = '" . $email . "'", $db);
    $user = mysql_fetch_array($result, MYSQL_ASSOC);
    if ($user) {
        $result = mysql_query("UPDATE users SET activation = null WHERE id = '" . $user['id'] . "'");
        $_SESSION['message'] = "Congratz, you succefully activated account!";
        header('Location: ' . $_SERVER['HTTP_ORIGIN'] . '/digdig');
    } else {
        $error = "Wrong activation url!";
        header('Location: ' . $_SERVER['HTTP_ORIGIN'] . '/digdig');
    }
}