<?php include("includes/db.php");?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>DigDig - Worlds Diggers and Archeologist club</title>
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
    
    <!--   Google fonts -->
    <link href='http://fonts.googleapis.com/css?family=BenchNine:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Ubuntu+Condensed&subset=latin,cyrillic-ext,cyrillic,latin-ext' rel='stylesheet' type='text/css'>
    <!-- END -->
    
    <!-- Funkcijas -->
    <script type="text/javascript" src="js/mapsInit.js"></script>
    <script type="text/javascript" src="js/functions.js"></script>
    <!-- END -->
  
  </head>
  <body onload="initialize();">
    <div id="header-wrap">
      <?php include("includes/header.php"); ?>
    </div>
    <div id="cont-wrapper">
      <div id="content">
        <div id="canva-hider">
          <div id="map_canvas"></div>
        </div>
        <div id="featured-wrap">
            <h2 class="home-heading">
              <span>Labākie objekti</span>
            </h2>
            <div id="featured-objects">
                <div class="object-small">
                  <img src="img/dummies/featured-1.jpg"/>
                  <a href="/">
                    <p>Grumpy wizards make toxic brew for the evil Queen and Jack.
                    One morning, when Gregor Samsa woke from troubled dreams,
                    His many legs, pitifully thin compared with the size of
                    the rest of him, waved about</p>
                  </a>
                </div>
                          <div class="object-small">
                  <img src="img/dummies/featured-1.jpg"/>
                  <a href="/">
                    <p>Grumpy wizards make toxic brew for the evil Queen and Jack.
                    One morning, when Gregor Samsa woke from troubled dreams,
                    His many legs, pitifully thin compared with the size of
                    the rest of him, waved about</p>
                  </a>
                </div>
                <div class="object-small">
                  <img src="img/dummies/featured-1.jpg"/>
                  <a href="/">
                    <p>Grumpy wizards make toxic brew for the evil Queen and Jack.
                    One morning, when Gregor Samsa woke from troubled dreams,
                    His many legs, pitifully thin compared with the size of
                    the rest of him, waved about</p>
                  </a>
                </div>
                <div class="object-small">
                  <img src="img/dummies/featured-1.jpg"/>
                  <a href="/">
                    <p>Grumpy wizards make toxic brew for the evil Queen and Jack.
                    One morning, when Gregor Samsa woke from troubled dreams,
                    His many legs, pitifully thin compared with the size of
                    the rest of him, waved about</p>
                  </a>
                </div>
                <div class="object-small">
                  <img src="img/dummies/featured-1.jpg"/>
                  <a href="/">
                    <p>Grumpy wizards make toxic brew for the evil Queen and Jack.
                    One morning, when Gregor Samsa woke from troubled dreams,
                    His many legs, pitifully thin compared with the size of
                    the rest of him, waved about</p>
                  </a>
                </div>
                <div class="object-small">
                  <img src="img/dummies/featured-1.jpg"/>
                  <a href="/">
                      <p>Grumpy wizards make toxic brew for the evil Queen and Jack.
                      One morning, when Gregor Samsa woke from troubled dreams,
                      His many legs, pitifully thin compared with the size of
                      the rest of him, waved about</p>
                  </a>
                </div>
            </div>
        </div>
        <div id="latest-wrapper">
          <h2 class="home-heading">
            <span>Latest objects</span>
          </h2>
            <div id="latest-objects">
                <div class="news-object object-small">
                    <img src="img/dummies/featured-1.jpg"/>
                    <a href="/">
                        <p>Grumpy wizards make toxic brew for the evil Queen and Jack.
                        One morning, when Gregor Samsa woke from troubled dreams,
                        His many legs, pitifully thin compared with the size of
                        the rest of him, waved about</p>
                    </a>
                </div>
                <div class="news-object object-small">
                    <img src="img/dummies/featured-1.jpg"/>
                    <a href="/">
                        <p>Grumpy wizards make toxic brew for the evil Queen and Jack.
                        One morning, when Gregor Samsa woke from troubled dreams,
                        His many legs, pitifully thin compared with the size of
                        the rest of him, waved about</p>
                    </a>
                </div>
                <div class="news-object object-small">
                    <img src="img/dummies/featured-1.jpg"/>
                    <a href="/">
                        <p>Grumpy wizards make toxic brew for the evil Queen and Jack.
                        One morning, when Gregor Samsa woke from troubled dreams,
                        His many legs, pitifully thin compared with the size of
                        the rest of him, waved about</p>
                    </a>
                </div>
                <div class="news-object object-small">
                    <img src="img/dummies/featured-1.jpg"/>
                    <a href="/">
                        <p>Grumpy wizards make toxic brew for the evil Queen and Jack.
                        One morning, when Gregor Samsa woke from troubled dreams,
                        His many legs, pitifully thin compared with the size of
                        the rest of him, waved about</p>
                    </a>
                </div>
        </div>
        </div>
        <?php //include("includes/rightside.php"); ?>
      </div>
    </div>
    <div id="footer-wrap">
      <div id="footer">
        
      </div>
    </div>
  </body>
</html>