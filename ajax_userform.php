<?php include('includes/db.php') ?>
<?php
    if(isset($_POST['name'])) {
        $result = mysql_query("UPDATE users SET name = '" . $_POST['name'] . "', surname='" . $_POST['surname'] . "' WHERE id='" .$_SESSION['User']['id']. "'", $db);
        if($result) {
            $error['type'] = 'success';
            $error['text'] = 'Succefully updated!';
        }
    } elseif(isset($_POST['password']) && $_POST['password'] != '') {
        $passw = sha1($_POST['password'] . $salt);
        $passw_sub = sha1($_POST['password_submit'] . $salt);
        if ($passw != $passw_sub) {
            $error['type'] = 'error';
            $error['text'] = 'Passwords do not match!';
        } else {
            $result = mysql_query("UPDATE users SET password = '" . $passw . "' WHERE id='" .$_SESSION['User']['id']. "'", $db);
            if($result) {
                $error['type'] = 'success';
                $error['text'] = 'Succefully updated!';
            }
        }
    }
$result = mysql_query("SELECT * FROM users WHERE id = '" . $_SESSION['User']['id'] . "'", $db);
$user = mysql_fetch_array($result, MYSQL_ASSOC);
?>
<div id="user-info-form">
    <?php if (isset($error)): ?>
        <div class="message <?php echo $error['type'] ?>"><span><?php echo $error['text'] ?></span></div>
    <?php endif; ?>
    <form action="<?php echo $baseUrl ?>user.php" method="POST" id="user-form-data">
        <div class="fieldset">
            <span class="fieldsetlabel">Change main information</span>
            <div class="input">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $user['name']?>" class="required"/>
            </div>
            <div class="input">
                <label>Surname</label>
                <input type="text" name="surname" value="<?php echo $user['surname']?>" class="required"/>
            </div>
            <div class="submitter">
                <input type="submit" value="Submit" onclick="sendAjaxUserData(); return false; " id="submit"/>
            </div>
        </div>
    </form>
    <form action="<?php echo $baseUrl ?>user.php" method="POST" id="user-password">
        <div class="fieldset">
            <span class="fieldsetlabel">Change password</span>
            <div class="input">
                <label>Password</label>
                <input type="password" name="password" class="required"/>
            </div>
            <div class="input">
                <label>Repeat password</label>
                <input type="password" name="password_submit" class="required"/>
            </div>
            <div class="submitter">
                <input type="submit" value="Submit" onclick="sendAjaxUserPassword(); return false;" id="submit"/>
            </div>
        </div>
    </form>
</div>