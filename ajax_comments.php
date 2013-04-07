<?php include('includes/db.php') ?>
<?php include('includes/authcheck.php') ?>
<?php
    if(isset($_POST['commenttext'])) {
        $result = mysql_query("INSERT INTO comments(`user_id`, `object_id`, `comment`, `date`)
        VALUES ('" . $_SESSION['User']['id'] . "','" . $_POST['object_id'] . "','" . $_POST['commenttext'] . "','" . date('Y-m-d H:i:s') . "')", $db);
        if($result){ ?>
            <div class="comment" style="display:none;">
                <div class="info">
                    <span class="username"><?php echo $_POST['name'] . ' ' . $_POST['surname'] ?></span>
                    <span class="datetime"><?php echo date('Y-m-d H:i:s') ?></span>
                </div>
                <div class="comment-text">
                    <?php echo $_POST['commenttext'] ?>
                </div>
            </div>
        <?php }
    }
?>
