$(document).ready(function() {

    $('.equipo .full-equipo ul li a').click(function(e){
        e.preventDefault();
        var tab_id = $(this).attr('data-tab');
        $('.equipo .full-equipo ul li a').removeClass('current');
        $('.team').hide();
        $(this).addClass('current');
        $("#"+tab_id).fadeIn();
    })

    $(window).scroll(function(){
        var sticky = $('header'),
            scroll = $(window).scrollTop();

        if (scroll >= 150) sticky.addClass('fixed');
        else sticky.removeClass('fixed');

    });


    var $animation_elements = $('.animated');
    var $window = $(window);

    function check_if_in_view() {
        var window_height = $window.height();
        var window_top_position = $window.scrollTop() - 150;
        var window_bottom_position = (window_top_position + window_height);

        $.each($animation_elements, function() {
            var $element = $(this);
            var element_height = $element.outerHeight();
            var element_top_position = $element.offset().top;
            var element_bottom_position = (element_top_position + element_height);

            //check to see if this current container is within viewport
            if ((element_bottom_position >= window_top_position) &&
                (element_top_position <= window_bottom_position)) {
                $element.addClass('show');
            } else {
                $element.removeClass('show');
            }
        });
    }

    $window.on('scroll resize', check_if_in_view);
    $window.trigger('scroll');


});