$(document).ready(function() {
    //Grafiskie redaktori
    tinyMCE.init({
          mode : 'textareas',
          width: '450',
          editor_selector : "mceEditorSimple",
          theme: 'simple'
    });
    
    tinyMCE.init({
          mode : 'textareas',
          width: '900',
          height: '400',
          editor_selector : "mceEditor",
          theme: 'advanced'
    });
    
	$('.addPhotosLink').click(function(){
	    var dummie = $(this);
            $.post("objectsaver.php",$('#addObjectForm').serialize(),function(data){
                console.log(data);    
            });
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
		afterClose: function() {
                    $('.addObj').attr('onclick','');
                    dummie.remove();
		//    $.post("cleaner.php?deletesession=gallery_id");
		}
	    });
            return false;
        });

    $(".object-small").mouseover(function(){
          $(this).children("a").fadeIn();      
    }).mouseleave(function(){
          $(this).children("a").fadeOut();      
    });

     
    //fancybokshi
    
    $('a.php').fancybox({
          'width' : 400,
          'height' : 240,
          'padding'      : 0,
          'margin'        :50,
          'scrolling'   : 'no',
          'autoSize'     :   false,
          'type'         : 'iframe',
         });
    
    //END

});
    
    function sendAjax(){
           $.post('ajax_return.php',{ name: 'true' }, function(data) {
                  $('.result').html(data);
           });
    }
    
