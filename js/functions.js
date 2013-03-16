<!-- Variables for javascript -->
var base = 'http://localhost/digdig/';
<!-- End -->
$(document).ready(function () {
    $('#featured-objects .object-small p').text(function(index, text) {
        return text.substr(0, 200);
    });

    $('#featured-objects .object-small p:empty' ).remove();
    $('#featured-objects .object-small p').append('...');
    console.log( $('#featured-objects .object-small p').text());

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
        height:'400',
        editor_selector:"mceEditor",
        theme:'advanced'
    });
    //end
    $('.addPhotosLink').click(function () {
        var dummie = $(this);
        $.post("objectsaver.php", $('#addObjectForm').serialize(), function (data) {
            console.log(data);
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
                //    $.post("cleaner.php?deletesession=gallery_id");
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

    function sendAjax() {
        $.post('ajax_return.php', { name:'true' }, function (data) {
            $('.result').html(data);
        });
    }
    
