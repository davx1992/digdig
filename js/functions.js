$(document).ready(function() {
      
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
      
      //login lietas
      $('#submitLogin').click(function(){
                  var form = $('#login').serialize();
                  $.post('loginer.php',form, function(data) {
                     if(data.response == false){
                        $('.error').html(data.error);
                     }else{
                        parent.$.fancybox.close();
                     }
                  });
                  
                  
            return false
      });
      
      
      //end
});
      
       function sendAjax(){
              $.post('ajax_return.php',{ name: 'true' }, function(data) {
                     $('.result').html(data);
              });
       }
       
