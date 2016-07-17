$(document).ready(function() {

    $('a.main').on('click', function(){
        if($(this).hasClass('open')){
            $('nav').removeClass('open-menu');
            $(this).removeClass('open');
            $('body').removeClass('fixed-body');
        }
        else{
            $('nav').addClass('open-menu');
            $(this).addClass('open');
            $('body').addClass('fixed-body');
        }
    });

    $('.double-btn-container a.arrow-btn').on('click', function(e){
        e.preventDefault();
        var slider_id = $(this).attr('data-slider');
        $('.team-area').hide();
        $("#"+slider_id).fadeIn();
        $(this).addClass('open');
    });

    jQuery(document).on('change','#selectlocation',function() {
        var latlngzoom = jQuery(this).val().split('|');
        var newzoom = 1*latlngzoom[2],
            newlat = 1*latlngzoom[0],
            newlng = 1*latlngzoom[1];
        map.setZoom(newzoom);
        map.setCenter({lat:newlat, lng:newlng});
    });


    $(".owl-carousel").owlCarousel({
        items : 9, //10 items above 1000px browser width
        itemsDesktop : [1000,9], //5 items between 1000px and 901px
        itemsDesktopSmall : [900,8], // betweem 900px and 601px
        itemsTablet: [600,4], //2 items between 600 and 0
        itemsMobile : [600,3], // itemsMobile disabled - inherit from itemsTablet option
        pagination: true
    });

    $('.equipo .full-equipo .item a').click(function(e){
        e.preventDefault();
        var tab_id = $(this).attr('data-tab');
        $('.equipo .full-equipo ul li a').removeClass('current');
        $(this).parents('.equipo').find('.team').hide();
        $(this).parents('.owl-carousel').find('.item').find('a').removeClass('current');
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