<?php
include("includes/db.php");
include("includes/authcheck.php");

    if (isset($_SESSION['edit'])) {
        $gallery = mysql_query("
            SELECT gallery.*
            FROM gallery
            WHERE gallery.object_id = '" . $_SESSION['object_id'] . "'");
        $gallery = mysql_fetch_array($gallery, MYSQL_ASSOC);
        $pictures = mysql_query("
            SELECT pictures.*
            FROM pictures
            WHERE pictures.gallery_id = '" . $gallery['id'] . "'");

        while ($picture = mysql_fetch_array($pictures, MYSQL_ASSOC)) {
            $images[] = $picture;
        }
    }
?>
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/jquery.jscrollpane.css" media="all"/>
<!-- Pievienoju skriptus  -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/plupload/plupload.full.js"></script>
<script type="text/javascript" src="js/jquery.jscrollpane.min.js"></script>
<!-- End -->

<!--   Google fonts -->
<link href='http://fonts.googleapis.com/css?family=BenchNine:400,700&subset=latin,latin-ext' rel='stylesheet'
      type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Ubuntu+Condensed&subset=latin,cyrillic-ext,cyrillic,latin-ext'
      rel='stylesheet' type='text/css'>
<!-- END -->
<script type="text/javascript">
    //Bilzu dzeshanas skripts
    function deleteImg(object_id, gallery_id, name, element) {
        name = name + '.jpg';
        $.post("deleter.php", { object_id: object_id, gallery_id: gallery_id, name: name }, function (data) {
            var response = JSON.parse(data);
            if (response.response == true) {
                if (typeof element == 'object') {
                    if ($(element).attr('class') == 'addedPhoto') {
                        $(element).remove();
                    } else {
                        $(element).parent('.addedPhoto').remove();
                    }
                } else {
                    $('#' + element).remove();
                }
            }
        });
    }
    //Inicializeeju plupload
    $(function () {
        var uploader = new plupload.Uploader({
            runtimes:'gears,html5,flash,silverlight,browserplus',
            browse_button:'pickfiles',
            container:'uploadContainer',
            max_file_size:'10mb',
            url:'uploader.php',
            flash_swf_url:'js/plupload/plupload.flash.swf',
            silverlight_xap_url:'js/plupload/plupload.silverlight.xap',
            filters:[
                {title:"Image files", extensions:"jpg,gif,png"}
            ]
        });

        uploader.bind('Init', function (up, params) {
            $('#filelist').html("<div>Current runtime: " + params.runtime + "</div>");
        });

        $('#uploadfiles').click(function (e) {
            uploader.start();
            e.preventDefault();
        });

        uploader.init();

        uploader.bind('FilesAdded', function (up, files) {
            $.each(files, function (i, file) {
                $('#photoHolder').append(
                        '<div id="' + file.id + '" class="addedPhoto"><div class="progressBar"><div class="bar"></div></div></div>');
            });

            uploader.start();
            //e.preventDefault();
            up.refresh(); // Reposition Flash/Silverlight
        });

        uploader.bind('UploadProgress', function (up, file) {
            $('#' + file.id).children('.progressBar').children('.bar').css('width', file.percent + '%');
        });

        uploader.bind('Error', function (up, err) {
            $('#filelist').append("<div>Error: " + err.code +
                    ", Message: " + err.message +
                    (err.file ? ", File: " + err.file.name : "") +
                    "</div>"
            );

            up.refresh(); // Reposition Flash/Silverlight
        });

        uploader.bind('FileUploaded', function (up, file, response) {
            var obj = JSON.parse(response.response);
            var name = obj.name;
            $('#photoHolder').children('#' + file.id).append('<a class="removeLink" onclick="deleteImg(' + obj.object_id + ',' + obj.gallery_id + ',' + name.replace('.jpg', '') + ',' + file.id + '); return false;" href="#"><a/>');
            $('#photoHolder').children('#' + file.id).append('<img  src="' + obj.path + '" />');
        });
    });

    $(document).ready(function () {
        //Pievienoju jsscrollpane
        $('.scroll-pane').jScrollPane({
            autoReinitialise:true
        });
    });

</script>

<div id="uploadContainer">
    <div class="fancyHead">
        <h3 class="fancyHeading">
            <span>Add photos</span>
        </h3>

        <div class="galleryNamer">
            <form method="post">
                <input value="United gallery" type="text" />
            </form>
        </div>
    </div>
    <div class="addWrapper">
        <a id="pickfiles" class="addGallery" href="#">Add photos</a>
    </div>
    <div id="photoHolderWrap" class="scroll-pane" style="width:960px;">
        <div id="photoHolder">
            <?php if (isset($images)): ?>
                <?php foreach ($images as $k=>$img): ?>
                    <div class="addedPhoto">
                        <a class="removeLink" onclick="deleteImg(<?php echo $_SESSION['object_id'] ?>, <?php echo $gallery['id'] ?>, '<?php echo strstr($img['name'], '.', true) ?>', this); return false;" href="#"><a/>
                        <img src="./uploads/objects/<?php echo $_SESSION['object_id'] ?>/<?php echo $gallery['id'] ?>/thumbnail/<?php echo $img['name'] ?>"/>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>
    <div class="fancyFooter">

    </div>
</div>
