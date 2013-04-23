<?php
include("includes/db.php");
include("includes/authcheck.php");
    if (isset($_GET['comment'])) {
        $commentId = $_GET['comment'];
        $comment = mysql_query('
            SELECT comments.user_id
            FROM comments
            WHERE comments.id = ' . $commentId);
        $comment = mysql_fetch_array($comment, MYSQL_ASSOC);
        if ($comment['user_id'] == $_SESSION['User']['id'] || $_SESSION['User']['role'] > 0) {
            $delete = mysql_query('
                DELETE comments.*
                FROM comments
                WHERE comments.id = ' . $commentId);
        }
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }
?>