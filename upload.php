
<script type="text/javascript">
var gCounter = 0;  //Galeriju skaits

$(document).ready(function(){
    /* Galeriju un foto pievienoshana */
    $('.addGallery').click(function(){
	//$.post('uploader.php?action=addgallery',{object:oid}, function(data) { 
	//    console.log(data);
	//    $('.galleryHolder').append('<a href="#gallery/'+data+'" class="galleryDummy"></a>');
	//	$('.galleryDummy').click(function(){
	//	    $.fancybox.open({
	//		href : 'addphotos.php',
	//		type : 'iframe',
	//		padding : 5,
	//		width : 960,
	//		height : 420,
	//		padding : 0,
	//		margin  :50,
	//		scrolling : 'no',
	//		autoSize :   false,
	//	    });
	//	});
	//});
	gCounter++; //Palielinam skaitu;
	$('.galleryHolder').append('<a href="#gallery/'+gCounter+'" class="galleryDummy"></a>');
	$('.galleryDummy').click(function(){
	    $.fancybox.open({
		href : 'addphotos.php',
		type : 'iframe',
		padding : 5,
		width : 960,
		height : 550,
		padding : 0,
		margin  :50,
		scrolling : 'no',
		autoSize :   false,
	    });
	});
	
        return false;
    });
    
    /* End */    
});

</script>
<!-- Bilzhu augshuplades skripts -->

<h2 class="home-heading">
  <span>Pictures</span>
</h2>

<div id="uploadCont">
    <a class="addGallery" href="#">Add gallery</a>
    <div class="galleryHolder">
	
    </div>
</div>
			