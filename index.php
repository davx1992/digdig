<?php include("includes/db.php"); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>DigDig - Worlds Diggers club</title>
    
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAS7PxeiwdvgSKqknSSesBjqZk72Pf99Fo&sensor=false">
    </script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/functions.js"></script>
  
  </head>
  <body onload="initialize()">
    <div id="cont-wrapper">
      <div id="header">
        
      </div>
        <div id="map_canvas" style="width:100%; height:100%"></div>
    </div>
  </body>
</html>