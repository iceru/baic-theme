window.addEventListener('load', function () {
    let mainNavigation = document.getElementById('primary-navigation')
    let mainNavigationToggle = document.getElementById('primary-menu-toggle')

    if (mainNavigation && mainNavigationToggle) {
        mainNavigationToggle.addEventListener('click', function (e) {
            e.preventDefault()
            mainNavigation.classList.toggle('hidden')
        })
    }
})


jQuery(document).ready(function ($) {
    // Banner Slider
    jQuery('.banner-slider').slick({
        dots: true,
        arrows: false,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 5000,
        appendDots: jQuery('#banner-dots-container'),
        pauseOnHover: false
    });

    // List Cars Slider
    jQuery('.car-list-slider').slick({
        centerMode: true,
        centerPadding: '30%', // Shows partials of side cars
        slidesToShow: 1,
        infinite: true,
        arrows: true,
        dots: false,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    centerPadding: '15%',
                    slidesToShow: 1
                }
            }
        ]
    });
});
