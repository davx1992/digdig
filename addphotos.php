<link rel="stylesheet" type="text/css" href="css/main.css">
<!-- Pievienoju skriptus  -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/plupload/plupload.full.js"></script>
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
	url : 'upload.php',
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
	    $('#filelist').append(
		    '<div id="' + file.id + '">' +
		    file.name + ' (' + plupload.formatSize(file.size) + ') <b></b>' +
	    '</div>');
	});

	    up.refresh(); // Reposition Flash/Silverlight
    });

    uploader.bind('UploadProgress', function(up, file) {
	$('#' + file.id + " b").html(file.percent + "%");
    });

    uploader.bind('Error', function(up, err) {
	$('#filelist').append("<div>Error: " + err.code +
	    ", Message: " + err.message +
	    (err.file ? ", File: " + err.file.name : "") +
	    "</div>"
	);

	up.refresh(); // Reposition Flash/Silverlight
    });

    uploader.bind('FileUploaded', function(up, file) {
	$('#' + file.id + " b").html("100%");
    });
});
</script>

<div id="uploadContainer">
    <div class="fancyHead">
	<h3 class="fancyHeading">
            <span>Add photos</span>
        </h3>
    </div>
    <div class="addWrapper">
	<div id="filelist">No runtime found.</div>
	<br />
	<a id="pickfiles" href="#">[Select files]</a>
	<a id="uploadfiles" href="#">[Upload files]</a>
	</div>
</div>
		    