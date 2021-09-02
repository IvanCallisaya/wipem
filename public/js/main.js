$(document).ready(function () {
    "use strict"; // Start of use strict

    // CIRCLE PROGRESSBAR
    $(".progress-circle").circliful({
        animation: 1,
        animationStep: 5,
        foregroundBorderWidth: 8,
        backgroundBorderWidth: 8,
        backgroundColor: '#ffffff',
        foregroundColor: '#1c57a1',
        percent: 50,
    });

    $(".progress-circle-2").circliful({
        animation: 1,
        animationStep: 5,
        foregroundBorderWidth: 6,
        backgroundBorderWidth: 6,
        backgroundColor: 'rgba(255,255,255,0.3)',
        foregroundColor: '#ffffff',
        percent: 50,
    });

    // QUOTE CAROUSEL
    $('.quote-carousel').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        prevArrow: "<div class='left'><i class='fa fa-angle-left'></i></div>",
        nextArrow: "<div class='right'><i class='fa fa-angle-right'></i></div>"
    });

    // INFO CAROUSEL
    $('.info-carousel').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        prevArrow: "<div class='ic-prev'>Prev</div>",
        nextArrow: "<div class='ic-next'>Next</div>"
    });

    // QUOTE CAROUSEL
    $('.home-slider').slick({
        arrows: false,
        dots: true,
        infinite: true,
        speed: 500,
        fade: true,
        autoplay: true,
        autoplaySpeed: 3000,
        pauseOnFocus: false,
        pauseOnHover: false,
        cssEase: 'linear'
    });

    // SPONSORS CAROUSEL
    $('.sponsors-carousel').slick({
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        dots: false,
        prevArrow: "<div class='left'><i class='fa fa-angle-left'></i></div>",
        nextArrow: "<div class='right'><i class='fa fa-angle-right'></i></div>",
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
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

    // RATINGS JS
    $('.js-star-rating').on('change', 'input', function () {
        $('.js-current-rating')
            .removeClass()
            .addClass('current-rating js-current-rating current-rating--' + this.value);
    });

    // ISOTOPE
    $('.grid').isotope({
        itemSelector: '.grid-item',
        masonry: {
            gutterWidth: 0,
            columnWidth: 1
        }
    });

    $('.filter-button-group').on('click', 'li', function () {
        var filterValue = $(this).attr('data-filter');
        $('.grid').isotope({
            filter: filterValue
        });

        $('.filter-button-group li').removeClass('active');
        $(this).addClass('active');
    });

    // COUNTDOWN TIMER
    $('.countdown').downCount({
        date: '06/06/2018 12:00:00',
        offset: +1
    });

    // FLICKRFEED
    $('#flickr').jflickrfeed({
        limit: 6,
        qstrings: {
            id: '52617155@N08'
        },
        itemTemplate: '<li><a href="{{image_b}}"><img src="{{image_s}}" alt="{{title}}" /></a></li>'
    });
});

// QUANTITY
$('.qty-inner >div').click(function (e) {
    e.preventDefault();

    fieldName = $(this).attr('data-field');
    type = $(this).attr('data-type');
    var input = $("input[name='" + fieldName + "']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if (type == 'minus') {

            if (currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            }
            if (parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if (type == 'plus') {

            if (currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if (parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function () {
    $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function () {

    minValue = parseInt($(this).attr('min'));
    maxValue = parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());

    name = $(this).attr('name');
    if (valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if (valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
});

$(".input-number").keydown(function (e) {
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
        (e.keyCode == 65 && e.ctrlKey === true) ||
        (e.keyCode >= 35 && e.keyCode <= 39)) {
        return;
    }
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
});