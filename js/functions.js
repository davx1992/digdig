<!-- Variables for javascript -->
var base = 'http://localhost/digdig/';
<!-- End -->
$(document).ready(function () {
    $('#featured-objects .object-small p:empty' ).remove();

    $('.rate-stars .star').mouseover(function(){
        var last = $('.rate-stars .star:last').index();
        var count = $(this).index();
        for (var i = count; i <= last; i++) {
            $('.rate-stars .star').eq(i).addClass('on');
        }
    }).mouseleave(function(){
        $('.rate-stars .star').removeClass('on');
    });

    $('.rate-stars .star').click(function(){
        if ($('.rated').length == 0) {
            var last = $('.rate-stars .star:last').index();
            var count = $(this).index();
            $('.rate-stars .star.on').each(function(){
                $(this).addClass('rated');
            });
            $.post(base + 'rate.php', { object_id: object_id, rate: Math.abs((count+1)-6) }, function(data){

            });
        }
        return false;
    });

    $('.user_menu').mouseenter(function(){
        $(this).children('ul').show();
    }).mouseleave(function(){
        $(this).children('ul').hide();
    });

    $('.user-information').click(function() {
        $('.user-menu-list li').removeClass('active');
        $(this).addClass('active');
        $.get(base + 'ajax_userform.php', function(data) {
            $('#user_map_canvas').hide();
            $('.maincol').append(data);
        });

    $('.your-objects').click(function(){
        $('.user-menu-list li').removeClass('active');
        $('#user-info-form').remove();
        $('#user_map_canvas').show();
        $(this).addClass('active');

    });
});

    //Grafiskie redaktori
    tinyMCE.init({
        mode:'textareas',
        width:'450',
        editor_selector:"mceEditorSimple",
        theme:'simple'
    });

    tinyMCE.init({
        mode:'textareas',
        width:'900',
        editor_selector:"mceEditorSimpleEdit",
        theme:'simple'
    });

    tinyMCE.init({
        mode:'textareas',
        width:'900',
        height:'400',
        editor_selector:"mceEditor",
        theme:'advanced'
    });

    //end
    $('#addPhotoLink').click(function () {
        var dummie = $(this);
        $.post("objectsaver.php", $('#addObjectForm').serialize(), function (data) {

        });
        $.fancybox.open({
            href:'addphotos.php',
            type:'iframe',
            padding:5,
            width:960,
            height:550,
            padding:0,
            margin:50,
            scrolling:'no',
            autoSize:false,
            afterClose:function () {
                $('.addObj').attr('onclick', '');
                dummie.remove();
            }
        });
        return false;
    });

    $('#editPhotoLink').click(function () {
        $.post("objectsaver.php?edit=true", $('#addObjectForm').serialize(), function (data) {

        });
        $.fancybox.open({
            href:'addphotos.php',
            type:'iframe',
            padding:5,
            width:960,
            height:550,
            padding:0,
            margin:50,
            scrolling:'no',
            autoSize:false,
            afterClose:function () {
                $('.editobject .addObj.first').removeClass('first');
            }
        });
        return false;
    });

    $(".object-small").mouseover(function () {
        $(this).children("a").fadeIn();
    }).mouseleave(function () {
            $(this).children("a").fadeOut();
        });


    //fancybokshi

    $('a.php').fancybox({
        'width':400,
        'height':240,
        'padding':0,
        'margin':50,
        'scrolling':'no',
        'autoSize':false,
        'type':'iframe'
    });

    $('.gallery').fancybox();
    //END

});

    function sendComment(){
        if($('textarea.comment').val() != '') {
            $.post(base + 'ajax_comments.php', $('#add_comment').serialize(), function(data){
                $('.comments-list').append(data);
                $('textarea.commenttext').val('');
                if ($('.no-comment').length != 0) $('.no-comment').remove();
                $('.comments-list .comment:last').fadeIn();
                $('.comments-count span').html(Number($('.comments-count span').text())+1);
            });
        }
    }

    function sendAjax() {
        $.post('ajax_return.php', { name:'true' }, function (data) {
            $('.result').html(data);
        });
    }

/* Form validation function */
(function($) {
    $.fn.validate = function() {
        $(this).find('input').focus(function(){
            $(this).siblings('.validation-error').fadeOut(500, function(){
                $(this).remove();
            });
        });
        var error = 0;
        $(this).find('input').each(function(){
            var rule =  $(this).attr('class');
            if (typeof rule != 'undefined'){
                if (rule.indexOf('required') >= 0){
                    if (!$(this).val()) {
                        if ($(this).siblings('.validation-error').length == 0){
                            $(this).parent('.input').append('<div class="validation-error"><span>This field id required.</span></div>');
                        }
                        error = 1;
                    }
                }
                if(rule.indexOf('email') >= 0) {
                    var emailReg = /^([\w-]+@([\w-]+\.)+[\w-]{2,4})?$/;
                    if ($(this).val()) {
                        if (!emailReg.test($(this).val())){
                            $(this).parent('.input').append('<div class="validation-error"><span>Enter valid Email address.</span></div>');
                            error = 1;
                        }
                    }
                }
            }
        });
        if (error == 1) {
            return false;
        } else {
            return true;
        }
    };
})(jQuery);
