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
    const carSlider = jQuery('.car-list-slider').slick({
        centerMode: true,
        centerPadding: '30%', // Shows partials of side cars
        slidesToShow: 1,
        infinite: true,
        arrows: true,
        dots: false,
        focusOnSelect: true,
        speed: 200,
        cssEase: 'cubic-bezier(0.23, 1, 0.32, 1)',
        useTransform: true,
        waitForAnimate: false,
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

    // Handle center class application more precisely
    carSlider.on('beforeChange', function (event, slick, currentSlide, nextSlide) {
        // Remove active state from all slides immediately
        jQuery('.car-list-slider .car-slide-item').removeClass('is-center');
    });

    carSlider.on('afterChange', function (event, slick, currentSlide) {
        // Add active state only to the actual center slide after transition completes
        jQuery('.car-list-slider .slick-center').find('.car-slide-item').addClass('is-center');
    });

    // Initialize the first slide as centered
    setTimeout(function () {
        jQuery('.car-list-slider .slick-center').find('.car-slide-item').addClass('is-center');
    }, 100);
});
