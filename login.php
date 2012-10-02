<?php include("includes/db.php"); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>DigDig - Login</title>
    
    <!-- Stilu pievienosana-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    
     <!-- FANCYBOX pievienošana-->
    <script type="text/javascript" src="js/mousewheel.js"></script>
    <script type="text/javascript" src="js/fancybox/jquery.fancybox.js?v=2.1.0"></script>
    <link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox.css?v=2.1.0" media="screen" />
    <!-- END -->
    
    <link href='http://fonts.googleapis.com/css?family=Ubuntu+Condensed&subset=latin,cyrillic-ext,cyrillic,latin-ext' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="js/functions.js"></script>
    
   
  
  </head>
  <body">
    <div id="fancy-wrap">
      <div id="header">
        <h1>Login</h1>
      </div>
      <div class="fancy-cont">
        <div class="error"></div>
      <form action="loginer.php" method="POST" id="login">
        <div class="fieldset" id="login-form">
              <div class="input">
                <label>E-mail</label>
                <input type="text" name="email"></input>
              </div>

              <div class="input">
                <label>Password</label>
                <input type="password" name="password"></input>
              </div>
              <div class="submitter">
                <input type="submit" value="Login" id="submitLogin"/><br />
                <a href="signup.php" class="signup-link">Sign up?</a>
              </div>
        </div>
      </form>
      </div>
    </div>
  </body>
</html>