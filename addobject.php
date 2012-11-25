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
    <script type="text/javascript" src="js/tiny_mce/tiny_mce.js"></script>
    <!-- END -->
  
    <?php
    if(isset($_GET['object_id'])){
        $ob_id = $_GET['object_id'];
        ?>
        <!-- Adding clearing script -->
        <script type="text/javascript">
            var oid = '<?php echo $ob_id ?>'; 
            $(document).ready(function(){
                $('#addObjWrap').remove();
                $.get('upload.php',function(data){
                    $('#content').append(data);    
                });
            });
        </script>
        <?php
    }
    ?>
  
  </head>
  <body onload="initAddObject();">
    <div id="header-wrap">
        <?php include("includes/header.php"); ?>
    </div>
    <div id="cont-wrapper">
        <div id="content">
            <h2 class="home-heading main">
                <span>Add object</span>
            </h2>
            <div id="addObjWrap">
                <div id="canva-hider-addobject">
                    <div id="map_canvas_addobject"></div>
                </div>
            
                <div id="addObject">
                    <form id="addObjectForm"  action="objectsaver.php" method="POST">
                    <div class="fieldset">
                        <span class="legend">Main information</span>
                        <div class="input">
                            <input type="text" name="name" placeholder="Title" />
                        </div>
                        
                        <div class="input">
                            <input type="text" name="city" placeholder="City" />
                        </div>
                    </div>
                    
                    <br style="clear:both;"/>
                    <input type="submit" class="add_button addObj" value="Next">
                        
                    <div class="input text">
                        <label>Description</label>
                        <textarea class="mceEditorSimple" name="description" ></textarea>
                    </div>
                    
                    <div class="input text">
                        <label>Main text</label>
                        <textarea class="mceEditor" name="main_text" ></textarea>
                    </div>
                    
                    <!-- Hidden inputs -->
                    <input type="hidden" name="coordx" id="coordx" value=""/>
                    <input type="hidden" name="coordy" id="coordy" value=""/>
                    
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="footer-wrap">
        <div id="footer">
        
        </div>
    </div>
  </body>
</html>