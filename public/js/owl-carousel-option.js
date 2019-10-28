$(document).ready(function() {
    $('.new-room-carousel').owlCarousel({
        loop: true,
        responsiveClass: true,
        dotsEach: true,
        margin: 20,
        responsive: {
            0: {
                items: 1,
                nav: true,
                loop: true
            },
            600: {
                items: 2,
                nav: true,
                loop: true
            },
            1000: {
                items: 3,
                nav: true,
                loop: true
            }
        }
    })

    $('.box-image-carousel').owlCarousel({
        loop: true,
        responsiveClass: true,
        dotsEach: true,
        items: 1
    })
});
