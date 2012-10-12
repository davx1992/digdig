<?php include("includes/db.php");?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>DigDig - Worlds Diggers club</title>
    <link rel="shortcut icon" href="/digdig/img/favico.ico" />
    
    
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAS7PxeiwdvgSKqknSSesBjqZk72Pf99Fo&sensor=false">
    </script>
    <script type="text/javascript" src="js/jquery.js"></script>
    
     <!-- FANCYBOX pievienošana-->
    <script type="text/javascript" src="js/mousewheel.js"></script>
    <script type="text/javascript" src="js/fancybox/jquery.fancybox.js?v=2.1.0"></script>
    <link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox.css?v=2.1.0" media="screen" />
    <!-- END -->
    
    <link href='http://fonts.googleapis.com/css?family=Ubuntu+Condensed&subset=latin,cyrillic-ext,cyrillic,latin-ext' rel='stylesheet' type='text/css'>
    <!--<script type="text/javascript" src="js/mapsInit.js"></script>-->
    <script type="text/javascript" src="js/functions.js"></script>
    
  
  </head>
  <body">
    <div id="cont-wrapper">
      <div id="header">
        <img src="img/logo.png" id="logo"></img>
        <?php include("includes/menu.php"); ?>
      </div>
      <div id="content">
        <div id="formdiv">
          <form method="POST" action="" id="addform">
            <div class="input">
            <label>Obects name</label>
            <input type="text" name="name">
            </div>
          </form>
        </div>
        <?php include("includes/rightside.php"); ?>
      </div>
    </div>
  </body>
</html>