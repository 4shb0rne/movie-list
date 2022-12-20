$(document).ready(function() {
    const property = {
        auto:true,
        item : 5,
        pauseOnHover: true,
        slideMargin : 30,
        addClass: '',
        mode: "slide",
        useCSS: true,
        cssEasing: 'ease',
        easing: 'linear',
    }

    $('.movie-slider').lightSlider(property);
    const updatedProperty = property
    updatedProperty.item = 8;
    $('.movie-genre-slider').lightSlider(updatedProperty);
});


