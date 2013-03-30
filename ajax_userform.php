<?php include('includes/db.php') ?>
<?php include('includes/variables.php'); ?>
<form action="<?php echo $baseUrl ?>user.php" method="POST">
    <div class="input">
        <label>Name</label>
        <input type="text" name="name" class="required"/>
    </div>
    <div class="input">
        <label>Surname</label>
        <input type="text" name="surname" class="required"/>
    </div>
    <div class="input">
        <label>Password</label>
        <input type="password" name="password" class="required"/>
    </div>
    <div class="input">
        <label>Repeat password</label>
        <input type="password" name="password_submit" class="required"/>
    </div>
</form>