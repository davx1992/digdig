<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/jquery.jscrollpane.css"  media="all" />
<!-- Pievienoju skriptus  -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/plupload/plupload.full.js"></script>
<script type="text/javascript" src="js/jquery.jscrollpane.min.js"></script>
<!-- End -->

<!--   Google fonts -->
<link href='http://fonts.googleapis.com/css?family=BenchNine:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Ubuntu+Condensed&subset=latin,cyrillic-ext,cyrillic,latin-ext' rel='stylesheet' type='text/css'>
<!-- END -->

<script type="text/javascript">
//Inicializeeju plupload
$(function() {
    var uploader = new plupload.Uploader({
	runtimes : 'gears,html5,flash,silverlight,browserplus',
	browse_button : 'pickfiles',
	container : 'uploadContainer',
	max_file_size : '10mb',
	url : 'uploader.php',
	flash_swf_url : 'js/plupload/plupload.flash.swf',
	silverlight_xap_url : 'js/plupload/plupload.silverlight.xap',
	filters : [
		{title : "Image files", extensions : "jpg,gif,png"},
	]
    });

    uploader.bind('Init', function(up, params) {
	$('#filelist').html("<div>Current runtime: " + params.runtime + "</div>");
    });

    $('#uploadfiles').click(function(e) {
	uploader.start();
	e.preventDefault();
    });

    uploader.init();

    uploader.bind('FilesAdded', function(up, files) {
	    $.each(files, function(i, file) {
		$('#photoHolder').append(
			'<div id="' + file.id + '" class="addedPhoto"><div class="progressBar"><div class="bar"></div></div></div>');
	    });
	    
	    uploader.start();
	    //e.preventDefault();
	    up.refresh(); // Reposition Flash/Silverlight
    });

    uploader.bind('UploadProgress', function(up, file) {
	//$('#' + file.id + " b").html(file.percent + "%");
	$('#' + file.id).children('.progressBar').children('.bar').css('width',file.percent+'%');
    });

    uploader.bind('Error', function(up, err) {
	$('#filelist').append("<div>Error: " + err.code +
	    ", Message: " + err.message +
	    (err.file ? ", File: " + err.file.name : "") +
	    "</div>"
	);

	up.refresh(); // Reposition Flash/Silverlight
    });

    uploader.bind('FileUploaded', function(up, file, response) {
	//$('#' + file.id + " b").html("100%");
	$('#photoHolder').children('#' + file.id).append('<img  src="'+response.response+'" />');
    });
});

$(document).ready(function(){
    //Pievienoju jsscrollpane
    $('.scroll-pane').jScrollPane({
	autoReinitialise: true
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
		<input value="United gallery" type="text"></input>
	    </form>
	</div>
    </div>
    <div class="addWrapper">
	<a id="pickfiles" class="addGallery" href="#">Add photos</a>
    </div>
    <div id="photoHolderWrap" class="scroll-pane" style="width:960px;">
	<div id="photoHolder">
	</div>
    </div>
    <div class="fancyFooter">
	
    </div>
</div>
		    