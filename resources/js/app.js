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


$(document).ready(function ($) {
    // Banner Slider
    $('.banner-slider').slick({
        dots: true,
        arrows: false,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 5000,
        appendDots: $('#banner-dots-container'),
        pauseOnHover: false
    });

    // List Cars Slider
    $('.car-list-slider').slick({
        centerMode: true,
        centerPadding: '22%', // Shows partials of side cars
        slidesToShow: 1,
        infinite: false,
        arrows: true,
        dots: false,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    centerPadding: '10%',
                    slidesToShow: 1
                }
            }
        ]
    });
});