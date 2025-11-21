/*  ---------------------------------------------------
Template Name: Ashion
Description: Ashion ecommerce template
Author: Colorib
Author URI: https://colorlib.com/
Version: 1.0
Created: Colorib
---------------------------------------------------------  */

'use strict';

(function (đ) {

    /*------------------
        Preloader
    --------------------*/
    đ(window).on('load', function () {
        đ(".loader").fadeOut();
        đ("#preloder").delay(200).fadeOut("slow");

        /*------------------
            Product filter
        --------------------*/
        đ('.filter__controls li').on('click', function () {
            đ('.filter__controls li').removeClass('active');
            đ(this).addClass('active');
        });
        if (đ('.property__gallery').length > 0) {
            var containerEl = document.querySelector('.property__gallery');
            var mixer = mixitup(containerEl);
        }
    });

    /*------------------
        Background Set
    --------------------*/
    đ('.set-bg').each(function () {
        var bg = đ(this).data('setbg');
        đ(this).css('background-image', 'url(' + bg + ')');
    });

    //Search Switch
    đ('.search-switch').on('click', function () {
        đ('.search-model').fadeIn(400);
    });

    đ('.search-close-switch').on('click', function () {
        đ('.search-model').fadeOut(400, function () {
            đ('#search-input').val('');
        });
    });

    //Canvas Menu
    đ(".canvas__open").on('click', function () {
        đ(".offcanvas-menu-wrapper").addClass("active");
        đ(".offcanvas-menu-overlay").addClass("active");
    });

    đ(".offcanvas-menu-overlay, .offcanvas__close").on('click', function () {
        đ(".offcanvas-menu-wrapper").removeClass("active");
        đ(".offcanvas-menu-overlay").removeClass("active");
    });

    /*------------------
		Navigation
	--------------------*/
    đ(".header__menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

    /*------------------
        Accordin Active
    --------------------*/
    đ('.collapse').on('shown.bs.collapse', function () {
        đ(this).prev().addClass('active');
    });

    đ('.collapse').on('hidden.bs.collapse', function () {
        đ(this).prev().removeClass('active');
    });

    /*--------------------------
        Banner Slider
    ----------------------------*/
    đ(".banner__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: true,
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true
    });

    /*--------------------------
        Product Details Slider
    ----------------------------*/
    đ(".product__details__pic__slider").owlCarousel({
        loop: false,
        margin: 0,
        items: 1,
        dots: false,
        nav: true,
        navText: ["<i class='arrow_carrot-left'></i>","<i class='arrow_carrot-right'></i>"],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: false,
        mouseDrag: false,
        startPosition: 'URLHash'
    }).on('changed.owl.carousel', function(event) {
        var indexNum = event.item.index + 1;
        product_thumbs(indexNum);
    });

    function product_thumbs (num) {
        var thumbs = document.querySelectorAll('.product__thumb a');
        thumbs.forEach(function (e) {
            e.classList.remove("active");
            if(e.hash.split("-")[1] == num) {
                e.classList.add("active");
            }
        })
    }


    /*------------------
		Magnific
    --------------------*/
    đ('.image-popup').magnificPopup({
        type: 'image'
    });


    đ(".nice-scroll").niceScroll({
        cursorborder:"",
        cursorcolor:"#dddddd",
        boxzoom:false,
        cursorwidth: 5,
        background: 'rgba(0, 0, 0, 0.2)',
        cursorborderradius:50,
        horizrailenabled: false
    });

    /*------------------
        CountDown
    --------------------*/
    // For demo preview start
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    if(mm == 12) {
        mm = '01';
        yyyy = yyyy + 1;
    } else {
        mm = parseInt(mm) + 1;
        mm = String(mm).padStart(2, '0');
    }
    var timerdate = mm + '/' + dd + '/' + yyyy;
    // For demo preview end


    // Uncomment below and use your date //

    /* var timerdate = "2020/12/30" */

	đ("#countdown-time").countdown(timerdate, function(event) {
        đ(this).html(event.strftime("<div class='countdown__item'><span>%D</span> <p>Day</p> </div>" + "<div class='countdown__item'><span>%H</span> <p>Hour</p> </div>" + "<div class='countdown__item'><span>%M</span> <p>Min</p> </div>" + "<div class='countdown__item'><span>%S</span> <p>Sec</p> </div>"));
    });

    /*-------------------
		Range Slider
	--------------------- */
	var rangeSlider = đ(".price-range"),
    minamount = đ("#minamount"),
    maxamount = đ("#maxamount"),
    minPrice = rangeSlider.data('min'),
    maxPrice = rangeSlider.data('max');
    rangeSlider.slider({
    range: true,
    min: minPrice,
    max: maxPrice,
    values: [minPrice, maxPrice],
    slide: function (event, ui) {
        minamount.val(ui.values[0] + 'đ');
        maxamount.val(ui.values[1] + 'đ');
        }
    });
    minamount.val(rangeSlider.slider("values", 0) + 'đ');
    maxamount.val(rangeSlider.slider("values", 1) + 'đ');

    /*------------------
		Single Product
	--------------------*/
	đ('.product__thumb .pt').on('click', function(){
		var imgurl = đ(this).data('imgbigurl');
		var bigImg = đ('.product__big__img').attr('src');
		if(imgurl != bigImg) {
			đ('.product__big__img').attr({src: imgurl});
		}
    });
    
    /*-------------------
		Quantity change
	--------------------- */
    var proQty = đ('.pro-qty');
	proQty.prepend('<span class="dec qtybtn">-</span>');
	proQty.append('<span class="inc qtybtn">+</span>');
	proQty.on('click', '.qtybtn', function () {
		var đbutton = đ(this);
		var oldValue = đbutton.parent().find('input').val();
		if (đbutton.hasClass('inc')) {
			var newVal = parseFloat(oldValue) + 1;
		} else {
			// Don't allow decrementing below zero
			if (oldValue > 0) {
				var newVal = parseFloat(oldValue) - 1;
			} else {
				newVal = 0;
			}
		}
		đbutton.parent().find('input').val(newVal);
    });
    
    /*-------------------
		Radio Btn
	--------------------- */
    đ(".size__btn label").on('click', function () {
        đ(".size__btn label").removeClass('active');
        đ(this).addClass('active');
    });

})(jQuery);
