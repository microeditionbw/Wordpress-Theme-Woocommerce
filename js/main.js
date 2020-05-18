$(document).ready(function() {
   /* $('.slide').slick({
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 5,
        slidesToScroll: 2,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    $(window).on('resize orientationchange', function() {
        $('.slide').slick('resize');
    });*/

    $('.navbar-collapse a').click(function() {
        $(".navbar-collapse").collapse('hide');
    });

    $(".anchor").on("click", function(event) {
        event.preventDefault();
        var id = $(this).attr('href'),
            top = $(id).offset().top;
        $('body,html').stop();
        $('body,html').animate({
            scrollTop: top
        }, 1000);
    });

});