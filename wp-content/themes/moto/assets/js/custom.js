(function ($) {

        //(Global variables)
        var $window = $(window),
        $body = $('body'),
		$windowHeight = $window.height(),
		$documentHeight = $(document).height(),
		$windowWidth = $window.width(),
        ua = window.navigator.userAgent,
        msie = ua.indexOf("MSIE "),
        // Blog page number
		blogPageNum,
        //Header
        $epHeader = $("#epHeader"),
	    $checkFixed = $epHeader.attr("data-fixed"), // Check menu fixed option is enable (1) or disable (0)
        $scrolingToSection = false,
        $externalClicked = false,
        $scrolId, // this value Save Value of specific id From top
        $enableScrollId,
        //menu
        menuArray = [],
		//portfolio Options
		pageRefresh = true,
		content = false,
		ajaxLoading = false,
		portfolioGrid = $('#isotopePortfolio'),
		wrapperHeight,
		folderName = 'portfolio-detail',
        hash = $(window.location).attr('hash'),
        root = '#!' + folderName + '/',
        rootLength = root.length,
        // Djax
        djax,
        // Slider out of screen flag
        sliderStatus = "visible",
        //--------------------------
        scrollpals = $("html, body"),
        isTouchDevice = (Modernizr.touch) ? true : false;

    /*-----------------------------------------------------------------------------------*/
    /*	Wave Menu
    /*-----------------------------------------------------------------------------------*/

    if ($('.wave-menu').length) {

        var $content = $('#main-content'),
        $openbtn = $('#open-button'),
        $isOpen = false,
        $wave_logo = $('.wave-menu .logo'),
        $morphEl = $('#morph-shape'),
        s = Snap(('#morph-shape svg'));
        $path = s.select('path');
        $initialPath = this.$path.attr('d'),
        $pathOpen = $morphEl.attr('data-morph-open'),
        $isAnimating = false;
  
    }

    function wave_menu() {

        if ($('.wave-menu').length) {
            initEvents();
        }
    }

    function initEvents() {

        $openbtn.click(function () {
            toggleMenu();
        });

        $(document).on('click', $content, function (e) {
		    if ($isOpen) {
		        toggleMenu();
		    }
		});

        $('.wave-menu .menu-wrap').click(function(e){
            e.stopPropagation();
        });

    }

    function toggleMenu() {
        if ($isAnimating) return false;
        $isAnimating = true;
        if ($isOpen) {

            $openbtn.removeClass('wavemenu_active');
            $wave_logo.removeClass('show_wave_menu_logo');
            

            $body.removeClass("show-wave-menu");
            // animate path
            setTimeout(function () {
                // reset path
                $path.attr('d', $initialPath);
                $isAnimating = false;
            }, 300);
        }
        else {

            $openbtn.addClass('wavemenu_active');
            $wave_logo.addClass('show_wave_menu_logo');


            $body.addClass('show-wave-menu');
            // animate path
            $path.animate({ 'path': $pathOpen }, 400, mina.easeinout, function () { $isAnimating = false; });
        }
        $isOpen = !$isOpen;
    }

    function closeToggleMenu() {
        if ($isAnimating) return false;
        $isAnimating = true;
        $openbtn.removeClass('wavemenu_active');
        $wave_logo.removeClass('show_wave_menu_logo');
        

        $body.removeClass("show-wave-menu");
        // animate path
        setTimeout(function () {
            // reset path
            $path.attr('d', $initialPath);
            $isAnimating = false;
        }, 300);
        $isOpen = false;
    }

    /*-----------------------------------------------------------------------------------*/
    /*  disable djax on woocommerce pagination links
    /*-----------------------------------------------------------------------------------*/

    function disable_djax_on_woocommerce_pagination()
    {
        $('.woocommerce-pagination li a').removeClass('dJAX_internal').addClass('no_djax');
    }


    /*-----------------------------------------------------------------------------------*/
    /*  select2 For Restyle SELECT OPTION 
    /*-----------------------------------------------------------------------------------*/

    function initSelect2() {

        if ($('.woocommercepage').length != 0) {

            if ($('.woocommerce-ordering .orderby').length) {
                $('.woocommerce-ordering .orderby').select2({
                    minimumResultsForSearch: -1
                });
            }


        } 
    }

    /*-----------------------------------------------------------------------------------*/
    /*	woocommerce social links 
    /*-----------------------------------------------------------------------------------*/

    function woocommerce_socials() {

        if ($('.product .social_share_toggle').length) {
            $('.social_share_toggle').addClass('opened');
            $('.social_links_list').addClass('openToggle');
        }

    }

    /*-----------------------------------------------------------------------------------*/
    /*  woocomerce -  product quantity input
    /*-----------------------------------------------------------------------------------*/
    function product_quantity() {

        var $quantityButtons = $('.quantity .quantity-button');
       
        $quantityButtons.on("click", function() {

            var $button = $(this);
            var $quantityInput = $(this).siblings('.woocommerce .quantity input[type="number"]');


            var oldValue = $quantityInput.val();

            if ($button.hasClass("plus")) {
              var newVal = parseFloat(oldValue) + 1;
            }
            else {
                if (oldValue > 0) {
                  var newVal = parseFloat(oldValue) - 1;
                } else {
                  newVal = 0;
                }
            }

          $quantityInput.val(newVal);

        });
    }

    /*-----------------------------------------------------------------------------------*/
    /*  product  detail - Add to cart button 
    /*-----------------------------------------------------------------------------------*/

    function product_add_to_cart() {
        $(".woocommerce div.product form.cart a.button").click(function(e){
            e.preventDefault();
            $(this).parents('form.cart').submit();
        });
    }

    /*-----------------------------------------------------------------------------------*/
    /*  product card widget
    /*-----------------------------------------------------------------------------------*/

    function card_widget_update() {
        $(document).on("click",".woocommerce table.cart a.remove", function() {
            var $productId = $(this).data("productid");

            setTimeout(function() { 
                $.ajax({
                    url: ajax_var.url,
                    data: {
                        'action' : 'get_card_quantity',
                        'ajax_nonce' : ajax_var.nonce
                    },
                    success:function(data) {
                        //update quantity of products
                        $(".widget.widget_woocommerce-dropdown-cart .header_cart .header_cart_span").html(data['card_count_products']);
                        //update list of products in card
                        $(".widget.widget_woocommerce-dropdown-cart .product_list_widget li[data-productid="+ $productId +"]").remove();
                    }
                });
            }, 2000);
        });
    }

    /*-----------------------------------------------------------------------------------*/
    /*  product  wishlist widget
    /*-----------------------------------------------------------------------------------*/

    function wishlist_widget_update() {
        $(document).on("click","a.add_to_wishlist, #yith-wcwl-form td.product-remove a.remove_from_wishlist", function() {
            setTimeout(function() { 
                $.ajax({
                    url: ajax_var.url,
                    data: {
                        'action' : 'get_wishlist_quantity',
                        'ajax_nonce' : ajax_var.nonce
                    },
                    success:function(data) {
                        $(".widget_woocommerce-wishlist a span.wishlist_items_number").html(data['wishlist_count_products']);
                    }
                });
            }, 2000);
            
            if($(this).hasClass('shop_wishlist_button'))
            {
                $(this).fadeOut(400).siblings('.shop_wishlist_button').fadeIn(400);
            }
        });
    }

    /*-----------------------------------------------------------------------------------*/
    /*  product  detail - zoom effect 
    /*-----------------------------------------------------------------------------------*/

    function product_image_zoom() {
        if($windowWidth <= 979 && isTouchDevice)
            return;
        
        var $easyzoom = $('.easyzoom').easyZoom();
    }

    /*-----------------------------------------------------------------------------------*/
    /*	product  detail - gallery 
    /*-----------------------------------------------------------------------------------*/

    function product_thumbnails() {
        if($("#product-thumbs").length > 0 )
        {
            var $thumbnails = $("#product-thumbs");
            var $fullview = $("#product-fullview-thumbs");
            var $thumbnailsHeight = $fullview.height();
            var $slideNum = $thumbnails.find('.swiper-slide').length;
            var $visibleNum = Math.floor($thumbnailsHeight/97);
            var $productThumb = $("#product-thumbs .swiper-container");
            var $activeIndex = 0;

            if($windowWidth > 979 && !isTouchDevice)
            {
                $("#product-thumbs").css("height",$thumbnailsHeight);         

                var $productThumbsSwiper = new Swiper('#product-thumbs .swiper-container' , {
                    speed:700,
                    longSwipesMs:800,
                    touchAngle:90,
                    grabCursor:true,
                    touchRatio : 3,
                    slidesPerView : 'auto',
                    preventClicks : false,
                    slideToClickedSlide : true,
                    spaceBetween : 12,
                    direction : 'vertical',
                    centeredSlides : true,
                   onSetTranslate : function(swiper, translate) {
                        
                        if(swiper.activeIndex >= $visibleNum-1) //move up next item after visibile items
                        {
                            var $translateValue = 420;

                            $("#product-thumbs").find(".swiper-wrapper").css("transform","translate3d(0px, -" + $translateValue + "px, 0px)"); 
                            $("#product-thumbs").find(".swiper-wrapper").css("-webkit-transform","translate3d(0px, -" + $translateValue + "px, 0px)"); 
                        }
                        else
                        {
                            $("#product-thumbs").find(".swiper-wrapper").css("transform","translate3d(0px, 0px, 0px)");
                            $("#product-thumbs").find(".swiper-wrapper").css("-webkit-transform","translate3d(0px, 0px, 0px)");
                        }  
                    },
                    onSlideChangeStart : function(swiper){
                        if($("#product-thumbs").length > 0 )
                            $('#product-fullview-thumbs .swiper-container')[0].swiper.slideTo(swiper.activeIndex);
                    }
                });

            }

            $isLoop = false;
            if($windowWidth < 768)
            {
                $fullview.find(".swiper-slide").css("height",$windowHeight-200);
                $isLoop = true;
            }

            var $productThumbsFullviewSwiper = new Swiper('#product-fullview-thumbs .swiper-container' , {
                autoplay: 6500,
                autoplayDisableOnInteraction : false,
                speed:600,
                longSwipesMs:700,
                touchAngle : 30,
                loop:$isLoop,
                spaceBetween : 0,
                followFinger:false,
                onSlideChangeStart : function(swiper){
                    if($windowWidth > 979 && !isTouchDevice)
                    {
                        if(!swiper.isBeginning)
                        {
                            $productThumbsSwiper.slideTo(swiper.activeIndex);
                        }
                    }
                        
                },
                onReachBeginning : function(swiper) {
                    if($windowWidth > 979 && !isTouchDevice) {
                        $productThumbsSwiper.slideTo(0);
                    }
                }

            });

            if($windowWidth > 979 && !isTouchDevice)
            {
                //stop and start slider on hover in product detail
                $('#product-fullview-thumbs .swiper-container').hover(function () {

                    $productThumbsFullviewSwiper.stopAutoplay();

                },function() {

                    $productThumbsFullviewSwiper.startAutoplay();

                });
            }

        }
    }

    /*-----------------------------------------------------------------------------------*/
    /*	carousel Shortcode
    /*-----------------------------------------------------------------------------------*/

    function image_carousel() {

        "use strict";

        if ($('.carousel').length) {

            // FullWidth Carousel remove col12 paddings
            $('.carousel').parents('.fullWidth').find('.vc_col-sm-12').css({
                'padding-right': '0px',
                'padding-left': '0px',
            });

            $('.carousel').each(function () {
               
                var $craouselid = $(this).attr('data-id');//get the carousel id that save in Data-id


                if ($windowWidth < 768) {

                    var $visibleItems = 2; // in mobile Device visible items is 3

                } else {
                
                    var $visibleItems = parseInt($(this).find('.swiper-container').attr('data-visibleitems'));//get the visible itemes that save in Data-visibleitems

                }

                var $nextbtn = $(this).find('.arrows-button-next' + $craouselid);
                var $prevbtn = $(this).find('.arrows-button-prev' + $craouselid);
                var swiper = new Swiper('.swiper-container' + $craouselid , {
                    autoplay: 2500,
                    touchAngle: 45,
                    speed:600,
                    longSwipesMs:800,
                    loop:true,
                    pagination: '.swiper-pagination',
                    nextButton: $nextbtn,
                    prevButton: $prevbtn,
                    slidesPerView: $visibleItems,
                    loopedSlides :$visibleItems+1,
                    paginationClickable: true,
                    spaceBetween: 1
                });

            });

        }
  
    }

    /*-----------------------------------------------------------------------------------*/
    /*	progress bar with animation Function
    /*-----------------------------------------------------------------------------------*/
    
    function progressbar() { // progressbar run in document ready and call after Ajax

        "use strict";

        if ($windowWidth > 1024) {

            var $progressbar = $('.progress_bar').not('.progressbarWithAnimation');

        } else {

            var $progressbar = $('.progress_bar');

        }

        if (!$progressbar.length) return;

        $progressbar.each(function () {

            var $progressbarpercent = $(this).find('.progressbar_percent').attr('data-percentage');
            $progressbarpercent = $progressbarpercent / 100;
            var $add_width = ($progressbarpercent * $(this).width()) + 'px';

            $(this).find('.progress_percent_value').addClass("complete");
            $(this).find('.progressbar_percent').animate({
                'width': $add_width
            }
            , {
                easing: 'easeInOutCubic',
                duration: 2000
            });

        });
    }

    /* progress bar With Animation*/
    function progressbarAnimate() { // call in appear function - run when element come to screen view

        "use strict";

        var $progressbar = $('.progressbarWithAnimation');
        if (!$progressbar.length) return;
        $progressbar.each(function () {

            var $progressbarpercent = $(this).find('.progressbar_percent').attr('data-percentage');
            $progressbarpercent = $progressbarpercent / 100;
            var $add_width = ($progressbarpercent * $(this).width()) + 'px';

            $(this).find('.progress_percent_value').addClass("complete");
            $(this).find('.progressbar_percent').animate({
                'width': $add_width,
            }
            , {
                easing: 'easeInOutCubic',
                duration: 2000
            });

        });
    }

    /*-----------------------------------------------------------------------------------*/
    /*	Easy Pie Chart Function
    /*-----------------------------------------------------------------------------------*/

    function piechart() { // piechart run in document ready and call after Ajax

        "use strict";

        if ($windowWidth > 1024) {

            var $pieChartBox = $('.pieChartBox').not('.pieChartWithAnimation');

        } else {

            var $pieChartBox = $('.pieChartBox');

        }

        if (!$pieChartBox.length) return;

        $pieChartBox.each(function () {
            var $dot = $(this).find('.dot-container');
            $(this).find('.easyPieChart').easyPieChart({
                scaleColor: false,
                barColor: $(this).attr('data-barColor'),
                lineWidth: 1,
                trackColor: 'rgba(0, 0, 0, 0)',
                lineCap: 'round',
                easing: 'easeOutQuint',
                animate: { duration: 2500,  easing :'easeOutCubic', enabled: true },
                size: 145,
                onStep: function(from, to, percent) {
                    $dot.css({ transform: 'rotate(' + (percent*3.6 +6) + 'deg)' });
                }
            });


        });
    }

    /* PieChart With Animation*/
    function piechartAnimate() { // call in appear function - run when element come to screen view

        "use strict";

        var $pieChartBox = $('.pieChartWithAnimation');
        if (!$pieChartBox.length) return;
        $pieChartBox.each(function () {
            var $dot = $(this).find('.dot-container');
            $(this).find('.easyPieChart').easyPieChart({
                scaleColor: false,
                barColor: $(this).attr('data-barColor'),
                lineWidth: 2,
                trackColor: 'rgba(0,0,0,0)',
                lineCap: 'round',
                easing: 'easeOutQuint',
                animate: { duration: 2500, enabled: true },
                size: 145,
                onStep: function(from, to, percent) {
                    $dot.css({ transform: 'rotate(' + (percent*3.6 +6) + 'deg)' });
                }
            });
        });
    }

    /*-----------------------------------------------------------------------------------*/
    /*  Counter Box
    /*-----------------------------------------------------------------------------------*/

    function counterBox() {
        "use strict";

        var $counterBoxContainers = $('.counterBox');

        if (!$counterBoxContainers.length) return;
      
        $counterBoxContainers.each(function () {
            var countNmber = $(this).attr('data-countNmber');
            $(this).find('.counterBoxNumber').countTo({
                from: 0,
                to: countNmber,
                speed: 1000,
                refreshInterval: 10,
            });
        });
    }

    /* Counter Box With Animation */
    function counterBoxAnimate() {

        "use strict";

        var $counterBoxContainers = $('.counterWithAnimation');
        
        if (!$counterBoxContainers.length) return;

        $counterBoxContainers.each(function () {
            var countNmber = $(this).attr('data-countNmber');
            $(this).find('.counterBoxNumber').countTo({
                from: 0,
                to: countNmber,
                speed: 2500,
                refreshInterval: 10,
            });
        });
    }

    /*-----------------------------------------------------------------------------------*/
    /*  Animation For Image & Text Shortcode
    /*-----------------------------------------------------------------------------------*/

    function shortcodeAnimation() {

        "use strict";

        if ($windowWidth > 1024) {

            $('.imgWithAnimation').add('.textWithAnimation').add('.iconWithAnimation').add('.teamWithAnimation').add('.counterWithAnimation').add('.pieChartWithAnimation').add('.progressbarWithAnimation').add('.testimonialWithAnimation').each(function () {

                var $daly = $(this).attr('data-delay');

                $(this).appear(function () {

                    if ($(this).attr('data-animation') == 'fade-in-left') {

                        var item = this;
                        setTimeout((function () {

                            $(item).animate({
                avoidTransforms: true,
                // avoidCSSTransitions:true,
                useTranslate3d: true,
                                'opacity': 1,
                                'left': '-80px',
                                'right': '0px'
            }
                            , {
                complete: function () {
                                    $(this).css({
                                        'right': '0px',
                                        'left': '0px'
            });

                                    $(this).addClass('notransitionleft');
            },
                easing: 'easeOutSine',
                duration: 900

            });

            }), $daly);

                //Run Counter Box Animation
                        if ($(item).hasClass("counterBox")) {
                            counterBoxAnimate();
            }
                //Run Pie Chart  Animation 
                        if ($(item).hasClass("pieChartBox")) {
                            piechartAnimate();
            }
                //Run Progress bar  Animation 
                        if ($(this).hasClass("progress_bar")) {
                            progressbarAnimate();
            }

            }

            else if ($(this).attr('data-animation') == 'fade-in-right') {

                        var item = this;
                        setTimeout((function () {
                            $(item).animate({
                                'opacity': 1,
                                'right': '-80px'
            }
                           , {
                complete: function () {
                                   $(this).css({ 'left': '0px' });

            },
                easing: 'easeOutSine',
                duration: 900
            });
            }), $daly);

                //Run Counter Box Animation
                        if ($(item).hasClass("counterBox")) {
                            counterBoxAnimate();
            }
                //Run Pie Chart  Animation 
                        if ($(item).hasClass("pieChartBox")) {
                            piechartAnimate();
            }
                //Run Progress bar  Animation 
                        if ($(this).hasClass("progress_bar")) {
                            progressbarAnimate();
            }

            }

            else if ($(this).attr('data-animation') == 'fade-in-bottom') {

                        var item = this;
                        setTimeout((function () {

                            $(item).animate({
                                'opacity': 1,
                                'left': '0px'
            }, 800, 'easeOutSine');


                            $(item).animate({
                                'opacity': 1,
                                'bottom': '-70px'
            }
                            , {
                complete: function () {
                                    $(this).css({ 'top': '0px' });
                                    $(this).addClass('notransition');
            },
                easing: 'easeOutSine',
                duration: 900
            });

            }), $daly);

                //Run Counter Box Animation
                        if ($(this).hasClass("counterBox")) {
                            counterBoxAnimate();
            }
                //Run Pie Chart  Animation 
                        if ($(this).hasClass("pieChartBox")) {
                            piechartAnimate();
            }
                //Run Progress bar  Animation 
                        if ($(this).hasClass("progress_bar")) {
                            progressbarAnimate();
            }

            }

            else if ($(this).attr('data-animation') == 'fade-in-top') {

                        var item = this;
                        setTimeout((function () {

                            $(item).animate({
                                'opacity': 1,
                                'top': '0px'
            }, 900, 'easeOutSine');

                //Run Counter Box Animation
                            if ($(item).hasClass("counterBox")) {
                                counterBoxAnimate();
            }
                //Run Pie Chart  Animation 
                            if ($(item).hasClass("pieChartBox")) {
                                piechartAnimate();
            }
                //Run Progress bar  Animation 
                            if ($(this).hasClass("progress_bar")) {
                                progressbarAnimate();
            }
            }), $daly);

            }

            else if ($(this).attr('data-animation') == 'fade-in') {

                        var item = this;
                        setTimeout((function () {

                            $(item).animate({
                                'opacity': 1
            }, 900, 'easeOutSine');

            }), $daly);


                //Run Counter Box Animation
                        if ($(item).hasClass("counterBox")) {
                            counterBoxAnimate();
            }
                //Run Pie Chart  Animation 
                        if ($(item).hasClass("pieChartBox")) {
                            piechartAnimate();
            }
                //Run Progress bar  Animation 
                        if ($(this).hasClass("progress_bar")) {
                            progressbarAnimate();
            }
            }

            else if ($(this).attr('data-animation') == 'grow-in') {
                        var item = $(this);

                        setTimeout(function () {
                            item.transition({ scale: 1, 'opacity': 1 }, 1000, 'cubic-bezier(0.15, 0.84, 0.35, 1.25)');
            }, $daly);

                //Run Counter Box Animation
                        if ($(this).hasClass("counterBox")) {
                            counterBoxAnimate();
            }
                //Run Pie Chart  Animation 
                        if ($(item).hasClass("pieChartBox")) {
                            piechartAnimate();
            }
                //Run Progress bar  Animation 
                        if ($(this).hasClass("progress_bar")) {
                            progressbarAnimate();
            }

            }

            else if ($(this).attr('data-animation') == 'none') {

                //Run Counter Box Animation
                        if ($(this).hasClass("counterBox")) {
                            counterBoxAnimate();
            }
                //Run Pie Chart  Animation 
                        if ($(this).hasClass("pieChartBox")) {
                            piechartAnimate();
            }

                //Run Progress bar  Animation 
                        if ($(this).hasClass("progress_bar")) {
                            progressbarAnimate();
            }

            }


            }, { accX: 0, accY: -100 }, 'easeInCubic');



                                    $(this).appear(function () {

                                        if ($(this).attr('data-animation') == 'fade-in-top') {

                                            var item = this;
                                            setTimeout((function () {

                                                $(item).animate({
                                                    'opacity': 1,
                                                    'top': '0px'
            }, 900, 'easeOutSine');

                //Run Counter Box Animation
                                                if ($(item).hasClass("counterBox")) {
                                                    counterBoxAnimate();
            }

                //Run Pie Chart  Animation 
                                                if ($(item).hasClass("pieChartBox")) {
                                                    piechartAnimate();
            }

                //Run Progress bar  Animation 
                                                if ($(this).hasClass("progress_bar")) {
                                                    progressbarAnimate();
            }

            }), $daly);

            }

            }, { accX: 0, accY: 100 }, 'easeInCubic');




            });

        }
    }

    /*----------------------------------------------------*/
    /* full Width colorize section 
    /*----------------------------------------------------*/

    function fullWidthSection() {

        "use strict";

        var $containerWidth = $('.container').width(),
        $offset_block = (($windowWidth - parseInt($containerWidth)) / 2);
        $('.fullWidth').each(function () {
            if ($windowWidth < 768) {
                $(this).css({
                    'margin-left': -($offset_block + 60),
                    'padding-left': ($offset_block + 60),
                    'padding-right': ($offset_block + 60)
                });
            } else {
                $(this).css({
                    'margin-left': -$offset_block,
                    'padding-left': $offset_block,
                    'padding-right': $offset_block
                });
            }
        });
    }

    /*-----------------------------------------------------------------------------------*/
    /*  tabs
    /*-----------------------------------------------------------------------------------*/

    function tabs() {

        "use strict";

        var $tabContainers = $('.tabs');

        if (!$tabContainers.length) return;

        $tabContainers.each(function () {
            var $container = $(this),
				$titles = $container.find('.head li'),
				$contents = $container.find('.tab-content');

            //Hide all contents except the first one
            $contents.not(':first-child').hide();

            //Mark the first tab as current one
            $titles.eq(0).addClass('current');

            $titles.click(function (e) {
                var $title = $(this),
					index = $title.index(),
					$curTitle = $titles.filter('.current');

                if ($title.hasClass('current'))
                    return;

                $contents.eq($curTitle.index()).stop().fadeOut({
                    complete: function () {
                        $curTitle.removeClass('current');
                        $title.addClass('current');
                        $contents.eq(index).fadeIn();
                    }
                });

            });
        });
    }

    /*-----------------------------------------------------------------------------------*/
    /*	google map
    /*-----------------------------------------------------------------------------------*/

    //Footer Google Map
    function googleMap() {
        "use strict";

        if (typeof google === 'object' && typeof google.maps === 'object') { // check if Google Maps API is loaded
            
            if ($("#googleMap").length) {

                $("#googleMap").gmap3({
                    map: {
                        options: {
                            zoom: parseInt(epicoJsMap.zoomLevel),
                            disableDefaultUI: true, //  disabling zoom in touch devices
                            disableDoubleClickZoom: true, //  disabling zoom by double click on map 
                            center: new google.maps.LatLng(epicoJsMap.cityMapCenterLat, epicoJsMap.cityMapCenterLng),
                            draggable: false, //  disable map dragging 
                            mapTypeControl: true,
                            navigationControl: false,
                            scrollwheel: false,
                            streetViewControl: false,
                            panControl: false,
                            zoomControl: false,
                            mapTypeId: google.maps.MapTypeId.ROADMAP,
                            mapTypeControlOptions: {
                                mapTypeIds: [google.maps.MapTypeId.ROADMAP, "Gray"]
                            }
                        }
                    },
                    styledmaptype: {
                        id: "Gray",
                        options: {
                            name: "Gray"
                        },

                    styles: [
                    {
                        "featureType": "administrative",
                                    "elementType": "labels.text.fill",
                                    "stylers": [
                                        {
                                            "color": "#444444"
                                        }
                                    ]
                                },
                            {
                        "featureType": "landscape",
                                "elementType": "all",
                                "stylers": [
                                    {
                                        "color": "#ebebeb"
                                    }
                                ]
                            },
                    {
                        "featureType": "poi",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "all",
                        "stylers": [
                            {
                                "saturation": -100
                            },
                            {
                                "lightness": 45
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "simplified"
                            }
                        ]
                    },
                    {
                        "featureType": "road.arterial",
                        "elementType": "labels.icon",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "transit",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "all",
                        "stylers": [
                            {
                                "color": "#81c4de"
                            },
                            {
                                "visibility": "on"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "visibility": "on"
                            },
                            {
                                "color": "#a3daf1"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "labels.text",
                        "stylers": [
                            {
                                "color": "#a3daf1"
                            }
                        ]
                    }
                ]
                    },
                    marker: {
                        values: [{
                            'latLng': [epicoJsMap.cityMapCenterLat, epicoJsMap.cityMapCenterLng]
                        }],
                        options: {
                            'icon': new google.maps.MarkerImage(epicoJsMap.iconMap)
                        }
                    }
                });

                if ((parseInt(epicoJsMap.customMap)) == 1) {
                    $('#googleMap').gmap3('get').setMapTypeId("Gray");//Display Gray Map On Load  if we don't have this line map loads in default
                }

            }
        
        }
    }

    //home Google Map	
    function homegoogleMap() {
        "use strict";
        
        homeSlideButton();

        if (typeof google === 'object' && typeof google.maps === 'object') { // check if Google Maps API is loaded

            if ($("#homeGoogleMap").length) {

                $("#homeGoogleMap").gmap3({
                    map: {
                        options: {
                            zoom: parseInt(epicoJsMap.homeZoomLevel),
                            disableDefaultUI: true, //  disabling zoom in touch devices 
                            disableDoubleClickZoom: true, //  disabling zoom by double click on map  
                            center: new google.maps.LatLng(epicoJsMap.homeCityMapCenterLat, epicoJsMap.homeCityMapCenterLng),
                            draggable: false, //  disable map dragging 
                            mapTypeControl: true,
                            navigationControl: false,
                            scrollwheel: false,
                            streetViewControl: false,
                            panControl: false,
                            zoomControl: false,
                            mapTypeId: google.maps.MapTypeId.ROADMAP,
                            mapTypeControlOptions: {
                                mapTypeIds: [google.maps.MapTypeId.ROADMAP, "Gray"]
                            }
                        }
                    },
                    styledmaptype: {
                        id: "Gray",
                        options: {
                            name: "Gray"
                        },
                        styles: [
                        {
                            "featureType": "administrative",
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "color": "#444444"
                                }
                            ]
                        },
                                {
                                    "featureType": "landscape",
                                    "elementType": "all",
                                    "stylers": [
                                        {
                                            "color": "#ebebeb"
                                        }
                                    ]
                                },
                        {
                            "featureType": "poi",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "saturation": -100
                                },
                                {
                                    "lightness": 45
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "visibility": "simplified"
                                }
                            ]
                        },
                        {
                            "featureType": "road.arterial",
                            "elementType": "labels.icon",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "transit",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "color": "#81c4de"
                                },
                                {
                                    "visibility": "on"
                                }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "geometry.fill",
                            "stylers": [
                                {
                                    "visibility": "on"
                                },
                                {
                                    "color": "#a3daf1"
                                }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "labels.text",
                            "stylers": [
                                {
                                    "color": "#a3daf1"
                                }
                            ]
                        }
                        ]
                    },
                    marker: {
                        values: [{
                            'latLng': [epicoJsMap.homeCityMapCenterLat, epicoJsMap.homeCityMapCenterLng]
                        }],
                        options: {
                            'icon': new google.maps.MarkerImage(epicoJsMap.homeIconMap)
                        }
                    }
                });


                if ((parseInt(epicoJsMap.homeCustomMap)) == 1) {
                    $('#homeGoogleMap').gmap3('get').setMapTypeId("Gray");//Display Gray Map On Load  if we don't have this line map loads in default
                }
            }

        }
    }

    /*-----------------------------------------------------------------------------------*/
    /*	Navigation
    /*-----------------------------------------------------------------------------------*/

    function nav() {

        "use strict";

        //Superfish Effect
        $('.navigation > ul').superfish({
            animation: { opacity: 'show', height: 'show' },
            delay: 100,
            disableHI: true,
            speed: 150,
            onShow: function () {

                $(this).css({
                    opacity: 1
                });
            }
        });


        //woocomerce drop down cart Widget
        $('.wc_cart_outer').superfish({
            animation: { opacity: 'show', height: 'show' },
            delay: 0,
            disableHI: true,
            speed: 150,
            onShow: function () {

                $(this).css({
                    opacity: 1
                });
            }
        });


        if ($("#hideMenuFirst").size() != 0 && $documentHeight > 500 && $checkFixed === 'scroll-sticky' && $windowWidth > 1024) {

            var $window_y = $window.scrollTop();
            if ($window_y > 500) {

                $epHeader.css({
                    'opacity': "1",
                });

            } else {

                $epHeader.css({
                    'opacity': "0",
                });

            }

        } else if ($("#hideMenuFirst").size() != 0 && $documentHeight > 500 && $checkFixed === 'epico-menu' && $windowWidth > 1024) {
            $window_y = $window.scrollTop();

            if ($window_y > 500) {

                $("#headerSecondState").css({
                    'opacity': "1",
                    'z-index': "5",
                    'top' : "0"
                });

                $("#headerFirstState").css({
                    'opacity': "0",
                    'z-index': "4",
                });

                $epHeader.removeClass('hideHeaderShadow');

            } else {

                $("#headerFirstState").css({
                    'opacity': "1",
                    'z-index': "5",
                    'top' : '25px'
                });
                
                $("#headerSecondState").css({
                    'opacity': "0",
                    'z-index': "4",
                });

                $epHeader.addClass('hideHeaderShadow');

            }

        } else {
            $epHeader.fadeIn(300);
        };

    }

    /*-----------------------------------------------------------------------------------*/
    /* FullScreen Slider
    /*-----------------------------------------------------------------------------------*/
    var $sliderWidth,
        $imagePosition;

    function fullScreenSliderInit() {

        "use strict";

        if (msie > 0 || navigator.userAgent.match(/Trident.*rv\:11\./)) { // Change home slider position if browser be ie
            $("#home").css('position', 'static');
        }

        var $startButtonOffset = 0;

        if($('#caption-start').length)
            $startButtonOffset = 10;

        $('#fullScreenSlider .swiper-container').css('height',$windowHeight);
        $('#fullScreenSlider .caption').each(function(i) {
            //get height of its childeren as height of caption ( becouse caption is absolute, we need height of chideren to centralize it)
            var $captionHeight = 0;
            $(this).children('.caption-container').each(function(){
                $captionHeight = $captionHeight + $(this).outerHeight();
            });
            $(this).css('padding-top', ($windowHeight - $captionHeight - $startButtonOffset )/2 + 'px');
        });

        homeSlideButton();

        //set appropriate width of slider
        $sliderWidth = parseInt($windowWidth);
        if($body.hasClass('vertical_menu_enabled') && $windowWidth > 979)
        {
            $sliderWidth = $sliderWidth - $('aside.vertical_menu_area').outerWidth();
        }
        $imagePosition = $sliderWidth -170;

    }

    function fullScreenImageInit() {
        "use strict";

        var $startButtonOffset = 0;

        if($('#caption-start').length)
            $startButtonOffset = 10;
        //set caption position when have just one slide
        var $caption = $('#fullScreenImage .caption');
        //get height of its childeren as height of caption ( becouse caption is absolute, we need height of chideren to centralize it)
        var $captionHeight = 0;
        $caption.children('.caption-container').each(function(){
            $captionHeight = $captionHeight + $(this).outerHeight();
        });
        
        $caption.css('padding-top', ($windowHeight - $captionHeight - $startButtonOffset )/2 + 'px');

        homeSlideButton();
    }

     function fullScreenSlider() {

        "use strict";

        var $slider = $('#fullScreenSlider');
        var $slides,
            $second_slide,
            $first_slide,
            $firstDuplicateSlide,
            $secondDuplicateSlide;

        if ( $slider.hasClass('epico')) {
        
            var $slideNum =   $slider.find('.swiper-slide').length +2,
                $initiated = false;

            var swiper = new Swiper( '#fullScreenSlider .swiper-container', {
                loop:true,
                speed :700,
                initialSlide :0,
                keyboardControl:true,
                autoplay:4500,
                autoplayDisableOnInteraction : false,
                effect:'fade',
                simulateTouch:false,
                onlyExternal: true,//Add this to disable touch behavior in touch devices
                slidesPerView: 1,
                onInit : function() {
                    $initiated = true;
                    $slides = $slider.find('.swiper-slide');
                    $second_slide = $slides.eq(2);
                    $first_slide = $slides.eq(1);
                    $firstDuplicateSlide = $slides.filter('.swiper-slide-duplicate').eq(0);
                    $secondDuplicateSlide = $slides.filter('.swiper-slide-duplicate').eq(1);
                    //Trick for set appropriate position of mejs-container of video
                    $slider.find('.mejs-container').css("position", "fixed");
                    setTimeout(function () {
                        $slider.find('.mejs-container').css("position", "relative");
                    }, 10);

                    //remove video of first(duplicate) slide
                    if ($firstDuplicateSlide.hasClass('has-duplicate-video')) {
                        $firstDuplicateSlide.find('.swiper-slide-image').remove();
                    }

                    //remove video of last(duplicate) slide
                    if($secondDuplicateSlide.hasClass('has-duplicate-video'))
                    {
                        $secondDuplicateSlide.find('.swiper-slide-image').remove();
                    }

                    if($.browser.mozilla == true)
                    {
                        $slider.find('.swiper-wrapper').add($slides).css("top" , "-0.1px");
                    }


                },
                onSetTranslate : function(swiper, translate) {
                    if($initiated) // check it becouse onSetTranslate fire before onInit
                    {
                        //Reset
                        $slides.filter('.swiper-slide-prev2').removeClass('swiper-slide-prev2');
                        $slides.filter('.swiper-slide-next2').removeClass('swiper-slide-next2');
                        $slides.filter('.fake-active').removeClass('fake-active');
                        $first_slide.removeClass('have-transition');
                        $slides.eq($slideNum-2).css('z-index', '').removeClass('have-transition');

                        if($secondDuplicateSlide.hasClass('swiper-slide-active'))//at end of slider
                        {
                            if(!$second_slide.hasClass('swiper-slide-prev'))
                            {
                                $second_slide.addClass('swiper-slide-next2');
                                $first_slide.addClass('swiper-slide-active fake-active');
                                if($secondDuplicateSlide.hasClass('has-duplicate-video'))
                                    $first_slide.addClass('have-transition');
                            }
                            if(!$firstDuplicateSlide.hasClass('has-duplicate-video'))
                                $firstDuplicateSlide.addClass('swiper-slide-prev2');
                        }
                        else if($firstDuplicateSlide.hasClass('swiper-slide-active'))
                        {
                            $slides.eq($slideNum-3).addClass('swiper-slide-prev2');
                            $slides.eq($slideNum-2).addClass('swiper-slide-active fake-active');
                            if($firstDuplicateSlide.hasClass('has-duplicate-video'))
                                $slides.eq($slideNum-2).addClass('have-transition');

                            if(!$secondDuplicateSlide.hasClass('has-duplicate-video'))
                                $secondDuplicateSlide.addClass('swiper-slide-next2');
                        }

                        //correct position of slide when we have video at end slide
                        if($firstDuplicateSlide.hasClass('has-duplicate-video'))
                        {
                            if($firstDuplicateSlide.hasClass('swiper-slide-prev'))
                                $slides.eq($slideNum-2).addClass('swiper-slide-prev2');

                            //Correct an exception when have 3slide( just happen in left-side sliding)
                            if($slideNum == 5 && $slides.eq($slideNum-3).hasClass('swiper-slide-active') && swiper.activeIndex > swiper.previousIndex )
                                $slides.eq($slideNum-2).css('cssText','z-index: 1 !important;'); // Hide it ( send it to back)

                        }

                        //set posiitons after starting slider
                        $slides.css("-webkit-transform", "");
                        $slides.filter('.swiper-slide-duplicate.has-duplicate-video').css("transform", "");

                        $slides.not('.swiper-slide-prev,.swiper-slide-prev2,.swiper-slide-next,.swiper-slide-next2,.swiper-slide-active,.swiper-slide-duplicate.has-duplicate-video').css("transform", "matrix(1,0,0,1," + $sliderWidth + ",0) !important");
                        $slides.not('.swiper-slide-prev,.swiper-slide-prev2,.swiper-slide-next,.swiper-slide-next2,.swiper-slide-active,.swiper-slide-duplicate.has-duplicate-video').find('.swiper-slide-image').css("transform", "matrix(1,0,0,1,-" + $imagePosition + ",0) !important");

                        $slides.filter('.swiper-slide-prev').css("transform", "matrix(1,0,0,1,-" + $sliderWidth + ",0) !important");
                        $slides.filter('.swiper-slide-prev2').css("transform", "matrix(1,0,0,1,-" + $sliderWidth + ",0) !important");
                        $slides.filter('.swiper-slide-prev').find('.swiper-slide-image').css("transform", "matrix(1,0,0,1," + $imagePosition + ",0) !important");
                        $slides.filter('.swiper-slide-prev2').find('.swiper-slide-image').css("transform", "matrix(1,0,0,1," + $imagePosition + ",0) !important");
                        $slides.filter('.swiper-slide-next').css("transform", "matrix(1,0,0,1," + $sliderWidth + ",0) !important");
                        $slides.filter('.swiper-slide-next2').css("transform", "matrix(1,0,0,1," + $sliderWidth + ",0) !important");
                        $slides.filter('.swiper-slide-next').find('.swiper-slide-image').css("transform", "matrix(1,0,0,1,-" + $imagePosition + ",0) !important");
                        $slides.filter('.swiper-slide-next2').find('.swiper-slide-image').css("transform", "matrix(1,0,0,1,-" + $imagePosition + ",0) !important");
                        $slides.filter('.swiper-slide-active').css("transform", "matrix(1,0,0,1,0,0) !important");
                        $slides.filter('.swiper-slide-active').find('.swiper-slide-image').css("transform", "matrix(1,0,0,1,0,0) !important");

                    }
                    else
                    {
                        //set posiitons before starting slider(we seperate it because of $slides is not initiated at this time and we should use $slider object)
                        $slider.find('.swiper-slide').css("-webkit-transform", "");
                        $slider.find('.swiper-slide').not('.swiper-slide-prev,.swiper-slide-prev2,.swiper-slide-next,.swiper-slide-next2,.swiper-slide-active').css("transform", "matrix(1,0,0,1," + $sliderWidth + ",0) !important");
                        $slider.find('.swiper-slide').not('.swiper-slide-prev,.swiper-slide-prev2,.swiper-slide-next,.swiper-slide-next2,.swiper-slide-active').find('.swiper-slide-image').css("transform", "matrix(1,0,0,1,-" + $imagePosition + ",0) !important");

                        $slider.find('.swiper-slide-prev').css("transform", "matrix(1,0,0,1,-" + $sliderWidth + ",0) !important");
                        $slider.find('.swiper-slide-prev2').css("transform", "matrix(1,0,0,1,-" + $sliderWidth + ",0) !important");
                        $slider.find('.swiper-slide-prev .swiper-slide-image').css("transform", "matrix(1,0,0,1," + $imagePosition + ",0) !important");
                        $slider.find('.swiper-slide-prev2 .swiper-slide-image').css("transform", "matrix(1,0,0,1," + $imagePosition + ",0) !important");
                        $slider.find('.swiper-slide-next').css("transform", "matrix(1,0,0,1," + $sliderWidth + ",0) !important");
                        $slider.find('.swiper-slide-next2').css("transform", "matrix(1,0,0,1," + $sliderWidth + ",0) !important");
                        $slider.find('.swiper-slide-next .swiper-slide-image').css("transform", "matrix(1,0,0,1,-" + $imagePosition + ",0) !important");
                        $slider.find('.swiper-slide-next2 .swiper-slide-image').css("transform", "matrix(1,0,0,1,-" + $imagePosition + ",0) !important");
                        $slider.find('.swiper-slide-active').css("transform", "matrix(1,0,0,1,0,0) !important");
                        $slider.find('.swiper-slide-active .swiper-slide-image').css("transform", "matrix(1,0,0,1,0,0) !important");
                    }

                }
            });

            $slider.find('.swiper-button-next').add('#fullScreenSlider .arrows-button-next').bind('click', function (e) {
                e.preventDefault();
                swiper.slideNext();
            });

            $slider.find('.swiper-button-prev').add('#fullScreenSlider .arrows-button-prev').bind('click', function (e) {
                e.preventDefault();
                swiper.slidePrev();
            });
            

            swiper.off('onClick');
            swiper.off('onTouchStart');
            swiper.off('onTouchEnd');
            swiper.off('onTouchMove');
            swiper.off('onTouchMoveOpposite');

        }
        else
        {

            var $slideNum =   $slider.find('.swiper-slide').length +2,
                $initiated = false;

            var swiper = new Swiper( '#fullScreenSlider .swiper-container', {
                loop: true,
                loopedSlides: 0,
                speed :1050,
                initialSlide :0,
                keyboardControl:true,
                autoplay:4500,
                followFinger : true,
                longSwipesMs : 600,
                autoplayDisableOnInteraction : false,
                nextButton: '#fullScreenSlider .arrows-button-next',
                prevButton: '#fullScreenSlider .arrows-button-prev',
                slidesPerView: 1,
                onInit: function () {
                    $initiated = true;
                    $first_slide = $slider.find('.swiper-slide').eq(1);
                    $firstDuplicateSlide = $slider.find('.swiper-slide-duplicate').eq(0);
                    $secondDuplicateSlide = $slider.find('.swiper-slide-duplicate').eq(1);

                    //Trick for set appropriate position of mejs-container of video
                    $slider.find('.mejs-container').css("position", "fixed");
                    setTimeout(function () {
                        $slider.find('.mejs-container').css("position", "relative");
                    }, 10);

                    //remove video of first(duplicate) slide
                    if ($firstDuplicateSlide.hasClass('has-duplicate-video')) {
                        $firstDuplicateSlide.find('.swiper-slide-image').remove();
                    }

                    //remove video of last(duplicate) slide
                    if ($secondDuplicateSlide.hasClass('has-duplicate-video')) {
                        $secondDuplicateSlide.find('.swiper-slide-image').remove();
                    }

                },
                onTouchStart : function(swiper){
                    if ( $secondDuplicateSlide.hasClass('has-duplicate-video')) {
                        //get back first slide to initial position
                        if (swiper.activeIndex == 2)
                            $first_slide.css('transform', "");
                    }


                    if ( $firstDuplicateSlide.hasClass('has-duplicate-video')) {
                        //get back last slide to initial position
                        if (swiper.activeIndex == 2)
                            $slider.find('.swiper-slide').eq($slideNum-2).css('transform', '');
                    }
                },
                onSetTranslate: function (swiper, translate) {
                    if($initiated) // check it becouse onSetTranslate fire before onInit
                    {
                        
                        if ( $secondDuplicateSlide.hasClass('has-duplicate-video')) {

                            //send first slide to last slide position to be as a duplicate slide
                            if ( swiper.activeIndex == $slideNum-2) {
                                
                                $first_slide.css('transform', 'translate3d(' + ( (swiper.activeIndex) * $sliderWidth) + 'px,0,0)');
                            }
                            else if (swiper.activeIndex == 1)
                            {
                                $first_slide.css('transform', ""); //get back first slide to initial position
                            }
                        }
                        
                        if ( $firstDuplicateSlide.hasClass('has-duplicate-video')) {

                            //send last slide to first slide position to be as a duplicate slide
                            if ( swiper.activeIndex == 1)
                            {
                                $slider.find('.swiper-slide').eq($slideNum-2).css('transform', 'translate3d(-' + ( ($slideNum-2) * $sliderWidth) + 'px,0,0)')
                            }
                            else if ( swiper.activeIndex == $slideNum-2)//get back last slide to initial position
                            {
                                $slider.find('.swiper-slide').eq($slideNum-2).css('transform', '');
                            }
                                
                        }

                         if( $secondDuplicateSlide.hasClass('swiper-slide-active'))
                        {
                            $first_slide.addClass('swiper-slide-active');
                                
                        }else if($firstDuplicateSlide.hasClass('swiper-slide-active'))
                        {
                            $slider.find('.swiper-slide').eq($slideNum-2).addClass('swiper-slide-active');
                        }
                    }
                },

            });
        }

    }

    function homeSlideButton()
    {
        "use strict";

        $("#caption-start").on('click',function(){
            var $next_section = $(this).parents('section#home').next('#startHere');

            scroll_to($next_section, 1);         
        });

    }

    function stopSliderOutOfScreen()
    {
        var $slider = $('#fullScreenSlider');

        if ( $slider.length <= 0)
            return;

        var docViewTop = $window.scrollTop();

        var swiper = $slider.find(".swiper-container")[0].swiper;

        //Check if it is out of screen
        if((docViewTop <= $windowHeight + 10))
        {
            if(sliderStatus == "hide")
            {
                swiper.startAutoplay();
                $slider.css("visibility","");
                sliderStatus = "visible";
            }
        }
        else
        {
            if(sliderStatus == "visible")
            {
                swiper.stopAutoplay();
                $slider.css("visibility","hidden");
                sliderStatus = "hide";
            }
        }

    }

    function sliderHidingInit()
    {

        //Check if it is out of screen
        if(($window.scrollTop() > $windowHeight + 10))
        {
            sliderStatus = "visible";
        }
    }


    /*-----------------------------------------------------------------------------------*/
    /*	blog toggle & blog toggle load more 
    /*-----------------------------------------------------------------------------------*/

    // blog toggle click 
    function blogToggleClick(postVar) {

        "use strict";

        var $toggleMode = parseInt(postVar.$accordion.attr("data-value"));

        if ($toggleMode === 0) {

            var $accordionHeight = "350px";
            if($windowWidth > 480 )
                $accordionHeight = "520px";


            // toggle Close Mode To Open Mode 
            postVar.$accordion.css({
                height: $accordionHeight,
            });

            postVar.$accordion_box10.add(postVar.$accordionBox).animate(
				{ height: postVar.$imgHeight },
				{
				    queue: false,
				    duration: 500,
				    complete: function () {
				        postVar.$content.fadeIn();
				        parallaxImg();
				    }
				}
			),

            postVar.$frameTitle.css({
                opacity: 0.3,
                'background-color': '#fff',
                height: '160px'
            }),

            //post title And Date animation css
            postVar.$monthTitle.css({
                'border-left-color': '#fff',
                left:'-90px'
            });


            if ($windowWidth < 768) {

                postVar.$monthTitle.find('.monthYear').css({
                    left: '30px',
                });

                postVar.$monthTitle.find('.blogTitle').css({
                    left: '30px',
                });

            } else {

                postVar.$monthTitle.find('.monthYear').css({
                    left: '0',
                });

                postVar.$monthTitle.find('.blogTitle').css({
                    left: '0',
                });

            }


            postVar.$titleImage.toggleClass('accordion_closed'),
			postVar.$accordion.toggleClass('accordionClosed'),

			postVar.$minus.css("display", 'block'),
			postVar.$plus.css("display", 'none');

            // change data Value 
            postVar.$accordion.attr("data-value", "1");

        } else if ($toggleMode === 1 || isNaN($toggleMode)) {

            // toggle Open Mode To Close Mode   
            postVar.$accordion.add(postVar.$accordionBox).animate(
				{ height: "160px" },
				{
				    queue: false,
				    duration: 500,
				    complete: function () {
				        parallaxImg();
				    }
				}
			),

			postVar.$content.fadeOut('fast');
            postVar.$frameTitle.css({
                opacity: 1,
                'background-color': 'transparent',
                height: '100%'
            })

            //post title And Date animation css
            postVar.$day.css({
                width:'130px'
            }),

            postVar.$monthTitle.css({
                'border-left-color': '#fff',
                left: '0px'
            }),

            postVar.$monthTitle.find('.monthYear').css({
                left: '0px',
            }),

            postVar.$monthTitle.find('.blogTitle').css({
                left: '0px',
            });


            if ($windowWidth < 768) {

                postVar.$monthTitle.find('.monthYear').css({
                    left: '-55px',
                });

                postVar.$monthTitle.find('.blogTitle').css({
                    left: '-55px',
                });

            } else {

                postVar.$monthTitle.find('.monthYear').css({
                    left: '0',
                });

                postVar.$monthTitle.find('.blogTitle').css({
                    left: '0',
                });
            }


            postVar.$titleImage.toggleClass('accordion_closed');
            postVar.$accordion.toggleClass('accordionClosed'),

			postVar.$minus.css("display", 'none');
            postVar.$plus.css("display", 'block'),

            // change data Value 	
			postVar.$accordion.attr("data-value", "0");
        }

        reInitDjax();

    };

    // blog toggle default set 
    function blogToggleSet(postVar) {

        "use strict";

        if (postVar.$flag === 0) {
            // Set Close Mode 
            postVar.$content.slideUp(function () {
                parallaxImg();
            });
            postVar.$accordion_box10.add(postVar.$accordionBox).animate(
				{ height: "160px" },
				{
				    queue: false,
				    duration: 500
				}
			),

            postVar.$titleImage.toggleClass('accordion_closed');

            postVar.$minus.css("display", 'none');
            postVar.$plus.css("display", 'block');

        } else if (postVar.$flag === 1 || isNaN(postVar.$flag)) {

            postVar.$accordion.css({
                height: "520px",
            });

            if (postVar.$noImage.length !== 0) {
                postVar.$imgHeight = "160px";
            } else if (postVar.$noImage.length !== 0) {
                postVar.$imgHeight = "520px";
            }

            postVar.$accordion_box10.add(postVar.$accordionBox).animate(
				{ height: postVar.$imgHeight },
				{
				    queue: false,
				    duration: 500
				})

            postVar.$frameTitle.css({
                opacity: 0.3,
                'background-color': '#fff',
                height: '160px'
            })

            postVar.$minus.css("display", 'block'),
            postVar.$plus.css("display", 'none');

        }

    };

    function blogToggleArray($thisAccordion) {

        "use strict";

        var $accordion = $thisAccordion,
		$titleImage = $accordion.find('.image'),
		$imgH = $titleImage.find('img'),
		$noImage = $titleImage.find('.noImage'),
		$content = $accordion.find('.accordion_content'),
		$accordion_box2 = $accordion.find('.accordion_box2'),
		$accordion_box10 = $accordion.find('.accordion_box10'),
		$flag = parseInt($accordion.attr("data-value")),
		$blogClose = $accordion.find('.blogClose'),
		$minus = $accordion.find('.minus'),
		$plus = $accordion.find('.plus'),
		$accordionBox = $accordion.find('.accordionBox'),
		$frameTitle = $accordion.find('.frameTitle'),
        $day = $accordion.find('.accordion_title'),
        $monthTitle = $accordion.find('.leftBorder');


        var postVar = {
            $accordion: $accordion,
            $titleImage: $titleImage,
            $imgH: $imgH,
            $noImage: $noImage,
            $content: $content,
            $accordion_box2: $accordion_box2,
            $accordion_box10: $accordion_box10,
            $flag: $flag,
            $minus: $minus,
            $plus: $plus,
            $accordionBox: $accordionBox,
            $frameTitle: $frameTitle,
            $day: $day,
            $monthTitle: $monthTitle,
        };

        return postVar;
    }

    // blog toggle
    function blogToggle() {

        "use strict";

        $('.blogAccordion').each(function () {

            var $accordion = $(this),
				$titleImage = $accordion.find('.image'),
				$imgH = $titleImage.find('img'),
				$noImage = $titleImage.find('.noImage'),
				$content = $accordion.find('.accordion_content'),
				$accordion_box2 = $accordion.find('.accordion_box2'),
				$accordion_box10 = $accordion.find('.accordion_box10'),
				$flag = parseInt($accordion.attr("data-value")),
				$blogClose = $accordion.find('.blogClose'),
				$minus = $accordion.find('.minus'),
				$plus = $accordion.find('.plus'),
				$accordionBox = $accordion.find('.accordionBox'),
                $frameTitle = $accordion.find('.frameTitle'),
                $day = $accordion.find('.accordion_title'),
                $monthTitle = $accordion.find('.leftBorder');

            var postVar = {
                $accordion: $accordion,
                $titleImage: $titleImage,
                $imgH: $imgH,
                $noImage: $noImage,
                $content: $content,
                $accordion_box2: $accordion_box2,
                $accordion_box10: $accordion_box10,
                $flag: $flag,
                $minus: $minus,
                $plus: $plus,
                $accordionBox: $accordionBox,
                $frameTitle: $frameTitle,
                $day: $day,
                $monthTitle: $monthTitle,
            };

            // set toggle mode When Page Loaded
            blogToggleSet(postVar);

            $minus.add($plus).add($blogClose).click(function () {
                // toggle Post When Click Event Occur 
                blogToggleClick(postVar);
            });

        });

    }

    /* blog toggle loadmore */
    function blogToggleLoadmore() {

        "use strict";

        $(".posts-page-" + blogPageNum).find('.blogAccordion').each(function () {
            var $accordion = $(this),
                $title = $accordion.find('.accordion_title'),
                $titleImage = $accordion.find('.image'),
                $imgH = $titleImage.find('img'),
                $noImage = $titleImage.find('.noImage'),
                $content = $accordion.find('.accordion_content'),
                $accordion_box2 = $accordion.find('.accordion_box2'),
                $accordion_box10 = $accordion.find('.accordion_box10'),
                $flag = parseInt($accordion.attr("data-value")),
                $blogClose = $accordion.find('.blogClose'),
                $minus = $accordion.find('.minus'),
                $plus = $accordion.find('.plus'),
                $accordionBox = $accordion.find('.accordionBox'),
                $frameTitle = $accordion.find('.frameTitle'),
                $day = $accordion.find('.accordion_title'),
                $monthTitle = $accordion.find('.leftBorder');

            var postLoadVar = {
                $accordion: $accordion,
                $titleImage: $titleImage,
                $imgH: $imgH,
                $noImage: $noImage,
                $content: $content,
                $accordion_box2: $accordion_box2,
                $accordion_box10: $accordion_box10,
                $flag: $flag,
                $minus: $minus,
                $plus: $plus,
                $accordionBox: $accordionBox,
                $frameTitle: $frameTitle,
                $day: $day,
                $monthTitle: $monthTitle,
            };

            // set toggle mode When Page Loaded
            blogToggleSet(postLoadVar);

            $minus.add($plus).add($blogClose).click(function () {
                // toggle Post When Click Event Occur 
                blogToggleClick(postLoadVar);
            });

        });
    }

    /*-----------------------------------------------------------------------------------*/
    /*  Blog Load More Function 
    /*-----------------------------------------------------------------------------------*/

    function blogLoadMore() {

        "use strict";

        var $loadBTN = $('.pageNavigation'),
            $blog = $('#blogLoop');

        if (typeof paged_data == 'undefined' || $loadBTN.length < 1)
            return;

        var startPage = parseInt(paged_data.startPage),
            nextPage = startPage + 1,
            max = parseInt(paged_data.maxPages),
            isLoading = false;

        if (max < 2) return;

        //Replace links with load more button
        $loadBTN.html('<div class="readmore clearfix"><div class="loadMore loadmoreactive"><span class="text load-more-text">'+ paged_data.loadMoreText +'</span><span class="text loading-text">'+ paged_data.loadingText +'</span><span class="text no-more-text">'+ paged_data.noMorePostsText +'</span></div></div>');

        var $btn = $loadBTN.find('.loadMore');

        //Active loadmore button 
        if (nextPage > max)
            $btn.removeClass('loadingactive').addClass('loadmoreactive');

        $btn.click(function () {
            if (nextPage > max || isLoading)
                return;

            isLoading = true;

            //Set loading text
            $btn.removeClass('loadmoreactive').addClass('loadingactive');

            var $pageContainer = $('<div class="posts-page-' + nextPage + '"></div>');

            paged_data.nextLink = paged_data.nextLink.replace(/\/page\/[0-9]+/, '/?postpage=' + nextPage);
            paged_data.nextLink = paged_data.nextLink.replace(/paged=[0-9]+/, 'postpage=' + nextPage);

            $pageContainer.load(paged_data.nextLink + ' .post', function () {

                //Insert the posts container before the load more button
                $pageContainer.waitForImages(function () {

                    $pageContainer.hide().appendTo($blog).fadeIn('slow', function () {

                        parallaxImg();

                    });

                    // Update page number and nextLink.
                    nextPage++;

                    if (/\/page\/[0-9]+/.test(paged_data.nextLink))
                        paged_data.nextLink = paged_data.nextLink.replace(/\/page\/[0-9]+/, '/page/' + nextPage);
                    else
                        paged_data.nextLink = paged_data.nextLink.replace(/postpage=[0-9]+/, 'postpage=' + nextPage);

                    if (nextPage <= max) {
                        $btn.removeClass('loadingactive').addClass('loadmoreactive');
                    } else if (nextPage > max) {
                        $btn.removeClass('loadingactive loadmoreactive').addClass('nomoreactive');
                    }

                    isLoading = false;

                    blogPageNum = nextPage;
                    blogPageNum--;

                    blogToggleLoadmore();
                    blogPostSlider();
                    fitVideo();

                });


            });

        });

        reInitDjax();
    }

    /*-----------------------------------------------------------------------------------*/
    /*	Home Height 
    /*-----------------------------------------------------------------------------------*/

    function homeHeight(callback) {

        "use strict";

        var $wpAdminBarHeight = $('#wpadminbar').height();

        //Wordpress Admin Bar Height
        function checkWpBar() {
            var $HSlMHeight = $windowHeight;
            if (!isNaN($wpAdminBarHeight)) {
                $HSlMHeight = $HSlMHeight - $wpAdminBarHeight;
            }
            return $HSlMHeight;
        }

        var $HSlMVal = checkWpBar();

        // Portfolio detail swiperslider Fullscreen 
        if ( $('.portfolio_detail_full_width .pDHeader-gallery').length > 0 || $('.portfolio_detail_boxed .pDHeader-gallery').length > 0 ) {
            
            var $marginHeader = 75,
                $marginSwiper = 75;

            if($('.portfolio_detail_boxed .pDHeader-gallery').length >0)
            {
                $marginHeader = 95;
                $marginSwiper = 55;
            }
                

            $(".pDHeader-gallery").css({ height: ($HSlMVal-$marginHeader) + 'px' });
            $(".pDHeader-gallery .swiper-container").css({ height: ($HSlMVal-$marginSwiper) + 'px' });

            // Add buttom Padding For Portfolio Fullwidth and Portfolio boxed when Page Not Scroll Defualt
            //Set it for tablet devices and desktops
            if ($body.height() < $windowHeight && $windowWidth > 1024) {

                var $bodyheight = $body.height();
                var $windowsHeight = $windowHeight;
                var $calc = $windowsHeight - $bodyheight;

                $calc = $calc + 5;

                $("#PDetail .pDcontent").css({ "padding-bottom": $calc });

            }

        }

        // Image Fullscreen 
        if ($('.fullScreenImage').length !== 0) {
            $("#fullScreenImage").css({ height: $HSlMVal + 'px' });
        }

        if ($windowWidth > 1024) {

            // Revolution Slider
            if ($('#homeHeight').height() > 0) {

                var $LHeight = $('#homeHeight').height();
                $LHeight = $LHeight - 6;

                if (!isNaN($wpAdminBarHeight)) {
                    $LHeight = $LHeight - $wpAdminBarHeight;
                }

                if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) { // If Internet Explorer, Margin-top 0
                    $("#main").css({ marginTop: $HSlMVal + 'px' });


                } else {
                    $("#main").css({ marginTop: $LHeight + 'px' });
                }

                $LHeight = 0;
                // FullScreen Slider -- FullScreen Video  -- FullScreen GoolgeMap 
            } else if ($('#fullScreenSlider').length !== 0 || $('#fullScreenImage').length !== 0 || $('#homeGoogleMap').length !== 0 || $('#homeVideoHeight').length !== 0) {
                if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) { // If Internet Explorer, Margin-top 0

                    if ($('#fullScreenImage').length !== 0) {
                        $("#main").css({ marginTop: $HSlMVal + 'px' });
                    } else {
                        $("#main").css({ marginTop: 0 + 'px' });
                    }

                } else {
                    $("#main").css({ marginTop: $HSlMVal + 'px' });
                }

                if ($('#fullScreenImage').length !== 0) {

                          
                    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) { // If Internet Explorer
                        $('#home .homeWrap .fullScreenImage').css({ position:'static'})
                    }
                }
                  
                //parallaxImg();
                $HSlMVal = 0;
            }
            else{//Reset the top margin for pages without intro
                    
                $("#main").css({ marginTop: 0 + 'px' });
            }

        } else {
            $('#main').css({ marginTop: 0 });
            // FullScreen GoolgeMap 
            if ($('#homeGoogleMap').length !== 0) {

                $("#home").css({ height: $HSlMVal + 'px' });
                $("#homeGoogleMap").css({ height: $HSlMVal + 'px' });
                $HSlMVal = 0;

            } else if ($('#homeVideoHeight').length !== 0) {

                $("#home").css({ height: $HSlMVal + 'px' });
                $("#homeVideoHeight").css({ height: $HSlMVal + 'px' });
                $HSlMVal = 0;

            }
        }

        return true;

    }

    /*------------------------------------------------------------------------------*/
    /*  phone Navigation 
    /*------------------------------------------------------------------------------*/

    function phoneNav() {

        "use strict";

        var $phoneNavBtn = $('#phoneNav');
        $(document).click(
			function (e) {
			    var $phoneNavIcon = $('#phoneNavIcon');
			    if (e.target != $phoneNavIcon.get(0) && e.target != $phoneNavBtn.get(0) && $phoneNavBtn.hasClass('active'))
			        $phoneNavBtn.click();
			}
		)

        $phoneNavBtn.click(function (e) {
            var $this = $(this),
				$menu = $('#phoneNavItems');

            if ($this.hasClass('active')) {
                $menu.slideUp('fast');
                $this.removeClass('active');
            }
            else {
                $menu.slideDown('fast');
                $this.addClass('active');
            }

            e.preventDefault();
        });
        
    
        phoneNavContainerHeight();

    }

    function phoneNavContainerHeight() {

        // This Code Use When Menu Item Height Higher than Device Height
         var nav_new_height = $window.outerHeight();

        $("#phoneNavItems").height(nav_new_height);
        $(".phone_menu_container").height(nav_new_height);

    }

    /*-----------------------------------------------------------------------------------*/
    /*	parallax  
    /*-----------------------------------------------------------------------------------*/

    function parallaxImg() {

        "use strict";

        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) { // If Internet Explorer, Disale Parallax

            var $parallaxContainers = $('.parallax');
            $parallaxContainers.each(function () {
                var $parallax = $(this);
                $parallax.addClass('noparallaxie');
            });

        } else { // If another browser , run Parallax 

            if ($windowWidth > 1024 && !isTouchDevice) {
                var $parallaxContainers = $('.parallax');
                $parallaxContainers.each(function () {
                    var $parallax = $(this);
                    var $pSpeed = parseInt($(this).attr('data-speed')) / 100;
                    //Run parallax script
                    $parallax.parallax("50%", $pSpeed);
                });
            }
        }
    }

    function parallaxHomeImg() {

        "use strict";

        if($('.homeParallax').length <= 0 )
            return;

        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) { // If Internet Explorer, Disale Parallax

            $('.homeParallax').addClass('noparallaxie');

        } else { // If another browser , run Parallax 

            if ($windowWidth > 1024 && !isTouchDevice) {

                // Home Parallax When we have One Slide
                $('.homeParallax').parallax("50%", ".25");
            }
        }
    }

    /*-----------------------------------------------------------------------------------*/
    /* 	Blog Post Slider 
    /*-----------------------------------------------------------------------------------*/

    function blogPostSlider() {

        // blog post slider - swoper slider
        $('.bpSwiper').each(function () {

            var $bd_s_nextbtn = $('.bpSwiper .arrows-button-next'); // Next btns
            var $bd_s_prevbtn = $('.bpSwiper .arrows-button-prev');// Previous Btns

            var swiper = new Swiper($(this), {

                loop: true,
                speed: 650,
                nextButton: $bd_s_nextbtn,
                prevButton: $bd_s_prevbtn,
                onSlideChangeStart: function (swiper) {

                    //Unset height
                    $('.bpSwiper .swiper-wrapper').css({ height: '' });
                    
                    //Calc Height
                    $bpSwiperWidth = $('.bpSwiper').width(); // Container Width
                    $imgeWidth = $(swiper.slides[swiper.activeIndex]).find('img').attr('width'); // initial Images Width
                    $imgeHidth = $(swiper.slides[swiper.activeIndex]).find('img').attr('height'); // initial image width
                    $imgeNewHeight = ($bpSwiperWidth * $imgeHidth) / $imgeWidth ; // Calc image height in container

                    $('.bpSwiper .swiper-wrapper').css({ height: $imgeNewHeight });
                    $('.bpSwiper').css({ height: $imgeNewHeight });
                        
                },

              
            });
        });

    }

    /*-----------------------------------------------------------------------------------*/
    /* 	portfolio feature Images Slider 
    /*-----------------------------------------------------------------------------------*/

    function portfolioSlider() {

        "use strict";

        //wait for calculate correct width of portfolio item
        setTimeout(function(){
            //portfolio feature images slider
            $('.portfolioswiper').each(function () {
                var $slider = $(this);

                //Don't load flex slider for less than two slides usefull For Not Flex Slider In Ipad!
                if ($(this).find('.pSlide').length < 2) {
                    return;
                }

                //generate random value for slide show Speed
                var $autoplayDuration = 5000 + Math.floor(Math.random() * 4000);

                var portfolioSwiper = new Swiper($slider , {
                    autoplay:$autoplayDuration,
                    speed:1000,
                    loop:true,
                    effect: 'fade',
                    onInit:function() {
                        $slider.find('.pSlide').css('width',$slider.width());
                    }
                });
            });         
        },100)

    }

    /*-----------------------------------------------------------------------------------*/
    /*  portfolio Detail
    /*-----------------------------------------------------------------------------------*/

    function portfolio_detail_header_parallax() {

        var $window_y = $window.scrollTop();

        // Portfolio detail swiperslider Fullscreen 
        if ($('.portfolio_detail_full_width .pDHeader-gallery').length > 0 || $('.portfolio_detail_boxed .pDHeader-gallery').length > 0 )
        {
            var $element = $('#pDSwiper');
            var $elementHeight = $element.height();
            var $opacity = 1 - 0.04 * ($window_y / ( $windowHeight - $elementHeight));

            //Portfolio header parallax
            $element.css({
                'transform': "translateY(" + ($window_y * 0.5) + "px)"
            });

            $element.css({
                'opacity':  $opacity
            });
        }

    }

    function portfolio_detail_title() {

        "use strict";

        if ($('.pDHeader-title').length < 1 )
            return

        var $title = $('.pDHeader-title');
        $title.addClass('bg-animated active');

    }

    function remove_footer_creative_portfolio_detail() {

        "use strict";

        //Hide footer in portfolio detail
         if ($('.portfolio_detail_boxed').length || $('.portfolio_detail_full_width').length || $('.portfolio_detail_full_width').length || $('.portfolio_detail_ default').length) {

            $('footer').css('display', 'block');
            $('#googleMap').css('display', 'none');
            $('.footer-widgetized').css('display', 'none');

        } else if ($('.portfolio_detail_creative').length) {

            $('footer').css('display', 'none');
            $('#googleMap').css('display', 'none');
            $('.footer-widgetized').css('display', 'none');

        } else {

            $('footer').css('display', 'block');
            $('#googleMap').css('display', 'block');
            $('.footer-widgetized').css('display', 'block');

        }

    }

    function remove_top_menu_creative_portfolio_detail() {
        "use strict";
        if($windowWidth <= 979)
            return;

        if ($('.portfolio_detail_creative').length) {
            $epHeader.addClass('hide_menu');
        }
        else
        {
            $epHeader.removeClass('hide_menu');
        } 
    }

    function remove_left_right_menu_creative_portfolio_detail() {
        "use strict";

        if ($('.portfolio_detail_creative').length) {
            $('.vertical_menu_area').addClass('hide_menu');
            $body.addClass('removePadding');
        }
        else
        {
            $('.vertical_menu_area').removeClass('hide_menu');
            $body.removeClass('removePadding');
        }
    }


    function set_margin_creative_portfolio_detail() {

        "use strict";

        if ($('.portfolio_detail_creative').length && $windowWidth >768) {

            var $portfolio_detail_creative_height = $('.pd_creative_fixed_content').height();

            var $portfolio_detail_creative_space = ($windowHeight - $portfolio_detail_creative_height) / 2;

            if ($portfolio_detail_creative_space < 0) {

                $portfolio_detail_creative_space = 0;

            }

            $('.portfolio_detail_creative').css({
                'margin-top': $portfolio_detail_creative_space,
            });

        }
    }

    /* Portfolio Details swiper Slider */
    function pDSwiper() {

        "use strict";

        if ($('#pDSwiper').length < 1)
            return;
        

        if ($('.portfolio_detail_creative').length) {

            if(('#pDSwiper').length)
            {
                if($windowWidth <= 979)
                {
                    var $nextbtn = $('#pDSwiper').find('.pd-arrows-button-next'),
                    $prevbtn = $('#pDSwiper').find('.pd-arrows-button-prev');

                    var swiper = new Swiper('#pDSwiper', {
                        slidesPerView: 'auto',
                        autoplay:5000,
                        loopedSlides:2,
                        paginationClickable: true,
                        spaceBetween: 0,
                        loop: true,
                        nextButton: $nextbtn,
                        prevButton: $prevbtn,
                    });
                }
                else
                {
                    var swiper = new Swiper('#pDSwiper', {
                        slidesPerView: 'auto',
                        paginationClickable: true,
                        spaceBetween: 15,
                    });
                }

            }

        } else {

            var $nextbtn = $('#pDSwiper').find('.arrows-button-next');
            var $prevbtn = $('#pDSwiper').find('.arrows-button-prev');
            //portfolio detail swiper slider
            var swiper = new Swiper('#pDSwiper' , {
                autoplay:5000,
                autoplayDisableOnInteraction :false,
                speed:700,
                longSwipesMs:600,
                keyboardControl : true,
                loop:true,
                slidesPerView :1,
                nextButton: $nextbtn,
                prevButton: $prevbtn,
                spaceBetween: 0
            });

        }
    }

    /*-----------------------------------------------------------------------------------*/
    /*  testimonial
    /*-----------------------------------------------------------------------------------*/

    function testimonial() {

        "use strict";

        var $testimonials = $('.testimonials'); //Slide testimonial

        if (!$testimonials.length) return;

        $testimonials.each(function () {
           
            var $testimonialid = $(this).attr('data-id');//get the carousel id that save in Data-id
            var $nextbtn = $(this).find('.arrows-button-next-' + $testimonialid);
            var $prevbtn = $(this).find('.arrows-button-prev-' + $testimonialid);
            var swiper = new Swiper('.swiper-container-' + $testimonialid , {
                autoplay:5000,
                autoplayDisableOnInteraction :false,
                effect: 'fade',
                fade: {
                  crossFade: true
                },
                speed:1200,
                loop:true,
                slidesPerView :1,
                simulateTouch : false,
                nextButton: $nextbtn,
                prevButton: $prevbtn,
                spaceBetween: 0
            });

        });

        $('.quote blockquote').mCustomScrollbar({
            theme: "dark-thick",
            autoHideScrollbar: true
        });

  
    }

    /*-----------------------------------------------------------------------------------*/
    /* 	Comment Respond
    /*-----------------------------------------------------------------------------------*/

    function commentRespond() {

        "use strict";

        var $respond = $('#respond'), $respondWrap = $('#respond-wrap'),
			$cancelCommentReply = $respond.find('#cancel-comment-reply-link'),
			$commentParent = $respond.find('input[name="comment_parent"]');

        $('.comment-reply-link').each(function () {
            var $this = $(this),
                $parent = $this.parents().eq(2);

            $this.click(function () {
                var commId = $this.parents('.comment').attr('data-id');

                $commentParent.val(commId);
                $respond.insertAfter($parent);
                $cancelCommentReply.show();

                return false;
            });
        });

        $cancelCommentReply.click(function (e) {
            e.preventDefault();

            $cancelCommentReply.hide();

            $respond.appendTo($respondWrap);
            $commentParent.val(0);
        });
    }//End commentRespond

    /*-----------------------------------------------------------------------------------*/
    /*	Forms 
    /*-----------------------------------------------------------------------------------*/

    function Forms() {

        "use strict";

        var $respond = $('#respond'), $respondWrap = $('#respond-wrap'), $cancelCommentReply = $respond.find('#cancel-comment-reply-link'),
            $commentParent = $respond.find('input[name="comment_parent"]');

        $('.comment-reply-link').each(function () {
            var $this = $(this),
                $parent = $this.parent().parent();

            $this.click(function () {
                var commId = $this.parents('.comment').find('.comment_id').html();

                $commentParent.val(commId);
                $respond.insertAfter($parent);
                $cancelCommentReply.show();

                return false;
            });
        });

        $cancelCommentReply.click(function (e) {
            $cancelCommentReply.hide();

            $respond.appendTo($respondWrap);
            $commentParent.val(0);

            e.preventDefault();
        });

        ContactForm('#respond');

    }//End Forms()

    /*-----------------------------------------------------------------------------------*/
    /*	Scrolling function 
    /*-----------------------------------------------------------------------------------*/

    function scroll_to( location, introCheck) {

        "use strict";

        //exit if url is detail of portfolio inner
        if(location.toString().indexOf("#!portfolio-detail/") != -1)
        {
            return;
        }
          
        if (location !== "#") {

            var scrollto;

            // introCheck 3 is for go to top Page ( top Button )
            // introCheck 2 is for logo
            //introcheck 5 is for next button in showcase 
            if (introCheck == 1 || introCheck == 2 || introCheck == 4 || introCheck == 5) { 

                if(introCheck !== 4  && introCheck !== 5) { // this code run when link from external to internal
                    // get internal id ( hash ) From Query string 
                    var sPageURL = window.location.search.substring(1);
                    var sURLVariables = sPageURL.split('&');
                    for (var i = 0; i < sURLVariables.length; i++) {
                        var sParameterName = sURLVariables[i].split('=');
                        if (sParameterName[0] == 'sectionid') {
                            location = '#'.concat(sParameterName[1]);
                        }
                    }
                }     

                if ($(location).length) {
                    var offsetTop = $(location).offset().top;
                    var done = $(location).closest('.layout').offset().top;
                    var offsetTop = offsetTop - done;
                    if ($('#main .homeWrap').length !== 0 && $windowWidth > 1024) {

                        if ($("#homeHeight.revolutionSlider").length) {

                            var $revolutionsliderHeight = $("#homeHeight").height();

                            if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) { // if ie - in ie Home Is not Parallax 
                            
                                scrollto = offsetTop - 58; // 58 is Menu Height

                            } else {

                                scrollto = ($revolutionsliderHeight + offsetTop) - 58; // 58 is Menu Height

                            }

                        } else {

                            if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) { // if ie - in ie Home Is not Parallax 

                                if ($('.vertical_menu_area').length || $('.wave-menu_enabled').length) { // When iuntro is Enable and wave_menu Or vertical_menu is Enable
                                    scrollto = offsetTop; // 58 is Menu Height ;
                                } else { 
                                    scrollto = offsetTop - 58; // 58 is Menu Height ;
                                }

                            } else { // not ie 

                                if ($('.vertical_menu_area').length || $('.wave-menu_enabled').length) {
                                    scrollto = $windowHeight + offsetTop; // 58 is Menu Height ;

                                } else {
                                    scrollto = ($windowHeight + offsetTop) - 58; // 58 is Menu Height ;
                                }

                            }
                        
                        }
                       
                    } else { // if intero is disable

                        if ($('.vertical_menu_area').length || $('.wave-menu_enabled').length ) { // When iuntro is Disbale and wave_menu Or vertical_menu is Enable
                            scrollto = offsetTop ;
                        } else {
                            scrollto = (offsetTop - 56); // menu height is 56px and this scpace cause the content shows completely
                        }

                    }
                }

            }


            if ( introCheck === 1 || introCheck === 4 || introCheck === 5 ) {
                if($checkFixed === 'epico-menu')
                {

                    var $hideMeunScrollHeight = $windowHeight * 0.08;
                    if(scrollto <=  $hideMeunScrollHeight)
                    {
                        $("#headerSecondState").removeClass('disabletransition');
                        $("#headerFirstState").removeClass('disabletransition');
                    }
                }

                //scroll to inside id 
                scrollpals.animate(
                    {
                        scrollTop: scrollto
                    }, {
                        duration: parseInt(epicoJsSpeed.scrolling_speed),
                        easing: epicoJsSpeed.scrolling_easing,
                        complete: function(){
                            $scrolingToSection = false;
                            $externalClicked = false;
                            $("#headerSecondState").removeClass('disabletransition');
                            $("#headerFirstState").removeClass('disabletransition');
                        },
                        queue: false
                    }
                );

            } else if (introCheck === 2 || introCheck === 3) {
                //scroll to top of page
                scrollpals.animate(
                    {
                        scrollTop: 0
                    }, {
                        duration: 2500,
                        easing: epicoJsSpeed.scrolling_easing,
                        queue: false
                    }
                );
            }
        }
    }

    /*-----------------------------------------------------------------------------------*/
    /*	fitvid 
    /*-----------------------------------------------------------------------------------*/

    function fitVideo() {
        $(".container").fitVids();
    }

    /*-----------------------------------------------------------------------------------*/
    /*	portfolio Isotope function
    /*-----------------------------------------------------------------------------------*/

    function portfolioIsotope($pIsotopeContainer) {

        "use strict";

        var $firstTimeLoad = true;

        if ($pIsotopeContainer === 0) { // id 0 for First Load

            // first load 
            $pIsotopeContainer = $('.isotope'); 
             
        } else if ($pIsotopeContainer === 1) { // id 1 for Resizing

            // resizing
            $firstTimeLoad = false;
            $pIsotopeContainer = $('.isotope');

        } else {
			
            // when click load more button
            $firstTimeLoad = false;
            $pIsotopeContainer = $($pIsotopeContainer);


        }

        $pIsotopeContainer.each(function () {

            var $this = $(this);

            // Check Portfolio is FullWidth Or not
            if ($this.parents('.fullWidth').length) {
                var $portfolio_fullwidth = true;

                // If Fullwidth Padding right and left Must be 0
                $this.parents('.fullWidth').find('.vc_col-sm-12').css({
                    'padding-right': '0px',
                    'padding-left': '0px',
                });

            }

			var $uniqueId = parseInt($(this).closest('.portfolioSection').attr('data-id')),
			$portfolioId = '#portfolio_'.concat($uniqueId),
			isotopeItem = $('.isotope-item');
            
            //Portfolio Style
			var $portfoliostyle = $this.parents('.portfolioSection').attr('data-portfolio-type');

            // Remove margins
            isotopeItem.css({
                'margin-left': 0,
                'margin-right': 0
            });

            // Sets column number depending on window width  
            function setColNum() {
                var columnNum = 1;

                if ($portfolio_fullwidth == true) {

                    if ($windowWidth > 1360) {
                       columnNum = 6; // portfolio Fullwidth - 6 col
                    } else if ($windowWidth > 999) {
                        columnNum = 4;
                    } else {
                        columnNum = 2;
                    }

                } else {

					    if ($windowWidth > 1200) {
					        columnNum = 4;// portfolio in Container - 4 col
					    } else if ($windowWidth > 999) {
					        columnNum = 4;
					    } else {
					        columnNum = 2;
					    }

                }


                return columnNum;
            }

            var getColWidthValue;

            // Gets column number and divides to get column width 
            function getColWidth() {

                if ($portfolio_fullwidth == true) { //fullwidth
                
                    var $device_width = $window.width();

                    if ($body.hasClass('vertical_menu_enabled') && $windowWidth > 1024) {
                        $device_width = $device_width - 255;
                    }
                   
                } else {  // in Container
                    var $device_width = $this.parents('.container').width();
                }
               
                // body width based on horizonal scroolbar Enable or Disable .
                if ($body.height() > $windowHeight) {
                    var w = $device_width;
                } else {
                    if ($windowWidth > 1024) {

                        //var w = $device_width - 17;
                        var w = $device_width;

                    } else {
                        var w = $device_width;
                    }
                }

                if ($portfoliostyle == 'portfolio_space' || $portfoliostyle == 'portfolio_text') {

                    if ($($this.parents('.fullWidth')).length) {
                      w = w - 13;
                    }

                }

                var columnNum = setColNum(),
					colWidth = Math.floor(w / columnNum);

                return colWidth;
            }

            getColWidthValue = getColWidth();

            // Run isotope plugin
            function callIsotope() {
                var colWidth = getColWidthValue;

                // text portfolio 
                var $textPortfolioMetaHeight = 0;
                var $portfoliostyle = $this.parents('.portfolioSection').attr('data-portfolio-type');
                if ($portfoliostyle == 'portfolio_text' ) {
                    //Item meta Height ( For text Portfolio )
                    $textPortfolioMetaHeight = 77;
                }

                var $layoutMode = 'masonry';
                if($windowWidth >= 768)
                    $layoutMode = 'perfectMasonry';

                $this.isotope({
                    itemSelector: '.isotope-item',
                    layoutMode: $layoutMode,
                    liquid: true,
                    perfectMasonry: {
                        layout: 'vertical',
                        columnWidth: colWidth,
                        gutterWidth: 20,
                        rowHeight: colWidth + $textPortfolioMetaHeight ,
                    },
                });
            }

            // Sets dynamic size of isotope brick 
            function setBrickSize($isotopeItem) {
                var colWidth = getColWidthValue;
                var gutterpadding = 0;

                if ($portfoliostyle == 'portfolio_space' || $portfoliostyle == 'portfolio_text') {

                    // Padding For Space Portfolio
                    gutterpadding = 15;

                }
                var $textPortfolioMetaHeight = 0;
                if ($portfoliostyle == 'portfolio_text')
                    $textPortfolioMetaHeight = 77;
                
                var columnNum = setColNum();
                // Set width of each brick
                $this.find('.isotope-item').each(function () {
                    var $brick = $(this),
						$brickphoto = $brick.find('.postphoto');

                    if ($brick.hasClass('big')) {
                        if ($windowWidth > 979) {
                            $brickphoto.css({
                                'width': ((colWidth * 2) - gutterpadding ) + 'px',
                                'height': ((colWidth * 2) - gutterpadding + $textPortfolioMetaHeight ) + 'px'
                            });
                        }
                        else if($windowWidth >=768)
                        {
                            $brickphoto.css({
                                'width': (colWidth - gutterpadding ) + 'px',
                                'height': (colWidth - gutterpadding ) + 'px'
                            });

                        }
                        else
                        {
                            $brickphoto.css({
                                'width': ((colWidth * 2) - gutterpadding ) + 'px',
                                'height': ((colWidth * 2) - gutterpadding ) + 'px'
                            }); 
                        }

                    }
                    else if ($brick.hasClass('wide')) {

                        $brickphoto.css({
                            'width': ((colWidth * columnNum) - gutterpadding ) + 'px',
                            'height': ((colWidth * 1) - gutterpadding  ) + 'px'
                        });

                    } else if ($brick.hasClass('slim')) {

                        if ($windowWidth > 979) {

                            $brickphoto.css({
                                'width': (colWidth - gutterpadding) + 'px',
                                'height': (((colWidth) * 2) - gutterpadding + $textPortfolioMetaHeight ) + 'px'
                            });

                        }
                        else if ($windowWidth >= 768) {
                            $brickphoto.css({
                                'width': (colWidth - gutterpadding) + 'px',
                                'height': (((colWidth) * 2) - gutterpadding + $textPortfolioMetaHeight ) + 'px'
                            });
                        }
                        else {

                            $brickphoto.css({
                                'width': ((colWidth * 2) - gutterpadding ) + 'px',
                                'height': (((colWidth) * 3) - gutterpadding ) + 'px'
                            });

                        }

                    } else if ($brick.hasClass('hslim')) {

                        $brickphoto.css({
                            'width': ((colWidth * 2) - gutterpadding ) + 'px',
                            'height': ((colWidth) - gutterpadding) + 'px'
                        });

                    } else {

                        if ($windowWidth >= 768) {

                            $brickphoto.css({
                                'width': ( colWidth - gutterpadding ) + 'px',
                                'height': ((colWidth) - gutterpadding ) + 'px'
                            });

                        } else {

                            $brickphoto.css({
                                'width': ((colWidth * 2) - gutterpadding )  + 'px',
                                'height': (((colWidth * 2) - gutterpadding ) ) + 'px',
                            });

                        }

                    }
                });
            }

            // Call isotope functions in correct order
            function runIsotope() {

                setBrickSize($this.find('.isotope-item'));
                callIsotope();

            }

            // Run Isotope on load
            runIsotope();

            if ( $firstTimeLoad === true ) { // This Part Of Code Obnly Load When Page Load not In Resizeing and Resize id 0 for first load

                //portfolio Filter
                if ($windowWidth > 979) { // if Desktop
                    var $pFilterItem = $portfolioId.concat(' .filters a');
                } else {
                    var $pFilterItem = $portfolioId.concat(' .filterstablet a');
                }


                var $pThis = $portfolioId.concat(' .isotope');

                var $pFilterToggle = $portfolioId.concat(' .filterToggle');
                var $pFilter = $portfolioId.concat(' .filters');
                var i = 0;

                $($pFilterToggle).click(function () {
                    $(this).toggleClass('closed');
                    $($pFilter).removeClass('toggleClicked').addClass('toggleClicked');
                    $($pFilter).toggleClass('openToggle');
                    i++;

                });

                $($pFilterItem).click(function (e) {
					
                    e.preventDefault();
                    $($pFilter).removeClass('toggleClicked');
					

                    var $pFilterText = $portfolioId.concat(' .portfolio-filter span.text');
                    $($pFilterItem).removeClass("active");

                    var $selector = $(this).attr('data-filter');

                    $($pFilterItem).each(function () {
                        var $filterselect = $(this).attr('data-filter');
                        if ($filterselect == $selector) {
                            $(this).addClass("active");
                        }
                    });

                    $this.isotope({ filter: $selector });
                    $($pFilterText).html($(this).html());
                    parallaxImg();
                    return false;

                });

            }

        });

    }


    /*-----------------------------------------------------------------------------------*/
    /*	initialize portfolio functions
    /*-----------------------------------------------------------------------------------*/

    var projectContainer,
        loader,
        pDError = $('#pDError'),
        pDetailNav = $('.navWrap');

    function portfolioDHashChange() {

        $window.bind('hashchange', function () {
            pDInitialize();
            pageRefresh = false;

        });
    };

    function pDInitialize() {
        projectContainer = $('#portfolioDetailAjax');

        if(!projectContainer.length)
            return;

        loader = $('.portfolioSection #loader');
        pDError = $('#pDError');
        pDetailNav = $('.navWrap');

        hash = $(window.location).attr('hash');
        var href = location.href.replace(location.hash, "");
        root = '#!' + folderName + '/';
        var rootLength = root.length;


        if (hash.substr(0, rootLength) != root) {

            return;

        } else {

            hash = $(window.location).attr('hash');
            var url = hash.replace(/[#\!]/g, '');

            portfolioGrid.find('.ajaxPDetail .isotope-item.current').removeClass('current');

            // if Url has Portfolio Detail Address
            if (pageRefresh == true && hash.substr(0, rootLength) == root) {

                $('html,body').stop().animate(
                    { scrollTop: (projectContainer.offset().top) + 'px' },
                    800,
                    'easeOutExpo',
                    function () {
                        loadPortfolioDetail(url, href);
                        pDetailNav.fadeOut('100');
                    }
                );

                // open Portfolio Detail When Click On Portfolio Items or trough portfolio navigation
            } else if (pageRefresh == false && hash.substr(0, rootLength) == root) {

                $('html,body').stop().animate(
                    { scrollTop: (projectContainer.offset().top) + 'px' },
                    800,
                    'easeOutExpo',
                    function () {
                        if (content == false) {
                            loadPortfolioDetail(url, href);
                        } else {
                            projectContainer.animate({ opacity: 0, height: wrapperHeight }, function () {
                                loadPortfolioDetail(url, href);
                            });
                        }
                        pDetailNav.fadeOut('100');
                    }
                );

            }


            // ADD ACTIVE CLASS TO CURRENTLY CLICKED PROJECT 
            portfolioGrid.find('.ajaxPDetail .isotope-item a[href$="' + hash + '"]').parents('.isotope-item').addClass('current');

        }

    }

    // load portfolio detail 
    function loadPortfolioDetail(url, href) {
        if ($('#portfolioDetailAjax').height() < 500) {

            projectContainer.animate(
                    { height: '500px' },
                    {
                        queue: false,
                        duration: 250
                    }
		    );
        }

        loader.css("top", ($windowHeight/2)+"px").fadeIn();

        url = url.replace("portfolio-detail/", "");
        url = site_url.url + '?portfolio=' + url + '&inner=1 #portfoliSingle';

        if (!ajaxLoading) {
            ajaxLoading = true;
            projectContainer.load(url, function (xhr, statusText, request) {
                if (statusText == "success") {

                    ajaxLoading = false;
                    pDError.hide();
                    $('#portfoliSingle').waitForImages(function () {
                        pDSwiper();// Call swiper Slider
                        hideLoader();
                        Social_link();

                    });

                    fitVideo();

                    //shortcodes
                    ep_shortcode();
                    shortcodeAnimation();
                    social_share_pop_up();

                }

                if (statusText == "error") {

                    pDError.show();
                    hideLoader();

                }

            });

        }
    }

    var $portfolioID,
    $portfolioBackLink,
    $skills;

    function portfolioDetailNavigationLoading(response) {

        if(response.indexOf('id="portfoliSingle') >= 0)
        {
            var $requestActionName = 'load_pd_navigation';

            if(response.indexOf('portfolio_detail_creative"') >= 0)
            {
                $requestActionName = 'load_cpd_navigation';
            }

            $.ajax({
                url:ajax_var.url,
                data: {
                   action: $requestActionName,
                   pid : $portfolioID,
                   skill_ids : $skills,
                   back_url : $portfolioBackLink,
                   ajax_nonce : ajax_var.nonce
                },
                async:false,
                success: function(data) {
                    response = response.replace('class="home"','class="home hide-home"');
                    response = response.replace('id="PDnavigation">','id="PDnavigation" style="display: block">'+ data);
                }
            });
        }

        return response;
    }

    function hideLoader() {
        loader.delay(400).fadeOut('fast', function () {
            showProject();
        });
    }


    function showProject() {

        if (content == false) {

            //load  portfolio detail by click on portfolio items
            wrapperHeight = projectContainer.children('#portfoliSingle').outerHeight() + 'px';
            projectContainer.animate({ opacity: 1, height: wrapperHeight }, function () {

                var scrollPostition = $('html,body').scrollTop();
                pDetailNav.fadeIn(400);
                content = true;

                parallaxImg();

            });

        } else {
            //load next and prev portfolio detail by Click navigation 
            wrapperHeight = projectContainer.children('#portfoliSingle').outerHeight() + 'px';
            projectContainer.animate({ opacity: 1, height: wrapperHeight }, function () {

                var scrollPostition = $('html,body').scrollTop();
                pDetailNav.fadeIn(400);

                parallaxImg();

            });
        }


        var portfolioIndex = portfolioGrid.find('.ajaxPDetail .isotope-item.current').index();
        var portfolioLength = $('.ajaxPDetail .isotope-item').length - 1;


        if (portfolioIndex == portfolioLength) {

            $('.pDNavigation .next').css('display', 'none');
            $('.pDNavigation .previous').css('display', 'block');

        } else if (portfolioIndex == 0) {

            $('.pDNavigation .previous').css('display', 'none');
            $('.pDNavigation .next').css('display', 'block');

        } else {

            $('.pDNavigation .next,.pDNavigation .previous').css('display', 'block');

        }

        
        //showing the title
        $('.pDHeader-title').addClass('bg-animated active');

    }

    function deletePortfolioDetail() {

        projectContainer.animate(
			{ height: '0px' },
			{
			    queue: false,
			    duration: 1000,
			    complete: function () {
			        projectContainer.empty();
			        parallaxImg();// reset parallax image positions
			    }
			}
		);

        projectContainer.animate(
			{ opacity: 0 },
			{
			    queue: false,
			    duration: 600
			}
		);

        pDetailNav.fadeOut(600);
        parallaxImg();

        location = '#_'; // remove URL hash 
        portfolioGrid.find('.ajaxPDetail .isotope-item.current').removeClass('current');

    }

    // linking to Next Portfolio Detail 
    function pDNavigationNext() {

        $('.pDNavigation .next').click(function (e) {

            var current = portfolioGrid.find('.ajaxPDetail .isotope-item.current');
            var next = current.next('.ajaxPDetail .isotope-item');
            var target = $(next).find('a.overlay').attr('href');
            $(this).attr('href', target);

            location = target;

            if (next.length === 0) {
                return false;
            }

            current.removeClass('current');
            next.addClass('current');
            //e.preventDefault();

        });

    }

    // linking to previous Portfolio Detail 
    function Social_link() {
        if($('.woocommercepage').length == 0)
        {
            $('.social_share_toggle').hover(function (e) {

                $(this).find('.social_links_list').toggleClass('openToggle');

            },function() {

                $(this).find('.social_links_list').removeClass('openToggle');

            });
        }
    }

    // linking to previous Portfolio Detail 
    function pDNavigationPrevious() {

        $('.pDNavigation .previous').click(function (e) {
            var current = portfolioGrid.find('.ajaxPDetail .isotope-item.current');
            var prev = current.prev('.ajaxPDetail .isotope-item');
            var target = $(prev).find('a.overlay').attr('href');
            $(this).attr('href', target);

            location = target;

            if (prev.length === 0) {
                return false;
            }

            current.removeClass('current');
            prev.addClass('current');

            e.preventDefault();

        });

    }

    // Closing the Portfolio detail 
    function pDCloseProject() {

        $('#PDclosePortfolio').click(function (e) {
            deletePortfolioDetail();
            loader.fadeOut();
            e.preventDefault();
        });

    }

    /*-----------------------------------------------------------------------------------*/
    /*	Portfolio Load More Function 
    /*-----------------------------------------------------------------------------------*/

    function portfolioLoadMore() {

        "use strict";

        var $index = 0;
        var $nextPageIndex = []; // array for save for each portfolio index
        var $maxPPgae = [];// array for save maximum pages For each portfolio sextions

        $('.portfolioSection').each(function () {

            $(this).attr('data-index', $index);
            var $portfolioId = $(this).attr('data-value'),
			$uniqueId = $(this).attr('data-id'),
			$pLoadMore = '.pLoadMore_'.concat($uniqueId),
			$pLoadMoreBtnWrap = $(this).find($pLoadMore),
            $startPage = $(this).attr('data-startPage'),
            $maxPages = $(this).attr('data-maxPages'),
            $nextLink = $(this).attr('data-nextLink');

            if ($pLoadMoreBtnWrap.length < 1)
                return;

            var startPage = parseInt($startPage);
            $nextPageIndex[$index] = startPage + 1;

            $maxPPgae[$index] = parseInt($maxPages);

            var isLoading = false;

            var $pLoadMoreBtn = $pLoadMoreBtnWrap.find('.loadMore');

            if (parseInt($maxPPgae[$index].toString()) < 2) {

                $pLoadMoreBtnWrap.fadeOut('fast');

                return;
            };

            //Active loadmore button 
            $pLoadMoreBtn.removeClass('loadingactive').addClass('loadmoreactive');


            if (parseInt($nextPageIndex[$index].toString()) > parseInt($maxPPgae[$index].toString())) {
                $pLoadMoreBtn.closest('.pLoadMore').fadeOut('fast');
            }

            var resTimer = 0;

            $pLoadMoreBtn.click(function () {

                var $dataIndex = parseInt($(this).closest('.portfolioSection').attr('data-index'));

                if (parseInt($nextPageIndex[$dataIndex].toString()) > parseInt($maxPPgae[$dataIndex].toString()) || isLoading)
                    return;

                isLoading = true;
                $uniqueId = $(this).attr('data-id');
                var $portfolioLoop = '#pLoop_'.concat($uniqueId);
                var $pagedNum = 'paged_'.concat($uniqueId);
                var $pItemsWrap = $portfolioLoop;

                //active loading state
                $pLoadMoreBtn.removeClass('loadmoreactive').addClass('loadingactive');

                var $pageContainer = $('<div class="loadItemsWrap"></div>');

                $nextLink = $nextLink.replace(/\/page\/[0-9]+/, '/?' + $pagedNum + '=' + parseInt($nextPageIndex[$dataIndex].toString()));
                $nextLink = $nextLink.replace(/paged=[0-9]+/, $pagedNum + '=' + parseInt($nextPageIndex[$dataIndex].toString()));
                $nextLink = $nextLink.replace(/paged_[0-9]+=[0-9]+/, $pagedNum + '=' + parseInt($nextPageIndex[$dataIndex].toString()));

                $pageContainer.load($nextLink + ' ' + $portfolioLoop + ' .isotope-item', function () {

                    // remove loadItemsWrap div From Loaded items 
                    $pageContainer = $pageContainer.find('.isotope-item').unwrap();

                    //Insert the posts container before the load more button
                    $pageContainer.appendTo($pItemsWrap);

                    // Update page number and nextLink.
                    $nextPageIndex[$dataIndex]++;

                    if (/\/page\/[0-9]+/.test($nextLink))
                        $nextLink = $nextLink.replace(/\/page\/[0-9]+/, '/page/' + parseInt($nextPageIndex[$dataIndex].toString()));
                    else {

                        var str1 = $pagedNum.concat('=[0-9]+');
                        var re = new RegExp(str1);

                        $nextLink = $nextLink.replace(re, $pagedNum + '=' + parseInt($nextPageIndex[$dataIndex].toString()));

                    }
                    if (parseInt($nextPageIndex[$dataIndex].toString()) <= parseInt($maxPPgae[$dataIndex].toString()))
                        $pLoadMoreBtn.removeClass('loadingactive').addClass('loadmoreactive');
                    else if (parseInt($nextPageIndex[$dataIndex].toString()) > parseInt($maxPPgae[$dataIndex].toString())) {
                        $pLoadMoreBtn.closest('.pLoadMore').fadeOut('fast');
                    }

                    isLoading = false;

                    blogPageNum = parseInt($nextPageIndex[$dataIndex].toString());
                    blogPageNum--;

                    var $items = $($pItemsWrap).find('.isotope-item');
                    var $container = $($pItemsWrap).closest('.isotope');

                    $container.isotope('appended', $items, function () {
                        $container.isotope('reLayout');
                    });

                    var $pIsotopeContainer = '#portfolio_'.concat($uniqueId).concat(' .isotope');
                    portfolioIsotope($pIsotopeContainer);
                    parallaxImg(); // reset parallax image positions
                    portfolioSlider();//feature image slider
                    social_share_pop_up();
                    reInitDjax();
					//First destroy previous gallery then rerun it once more
					$(document).find(".ep_lightGallery").each(function(){	
	                  	$(this).data('lightGallery').destroy(true);
	                  });

		            galleryStart();
                });
            });

            $index++;

        });
    }

    /*-----------------------------------------------------------------------------------*/
    /*	portfolio filter - tablet & mibilesize
    /*-----------------------------------------------------------------------------------*/

    function pfilter() {

        "use strict";

        if ($windowWidth <= 1024 ) {
            
            $('ul.portfolio-filter').superfish({
                delay: 100,               // one second delay on mouseout
                animation: { height: 'show' },  	// fade-in and slide-down animation
                animationOut: { height: 'hide' },
                speed: 'fast',            // faster animation speed
                autoArrows: false              // disable generation of arrow mark-up
            });

        }

    }

    /*----------------------------------------------------------------------------------*/
    /*	call Shortcode functions
    /*-----------------------------------------------------------------------------------*/

    function ep_shortcode() {
        testimonial();
        piechart();
        counterBox();
        fullWidthSection();
        tabs();
        progressbar();
        showcase();
    }


    /*----------------------------------------------------------------------------------*/
    /*	Video background
    /*-----------------------------------------------------------------------------------*/

    function initVideoBackground() {

        "use strict";

        $('.video').mediaelementplayer({
            enableKeyboard: false,
            iPadUseNativeControls: false,
            pauseOtherPlayers: false,
            iPhoneUseNativeControls: false,
            AndroidUseNativeControls: false
        });


        //mobile check
        if (navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)) {
            videoBackgroundSize();
            $('.videoHomePreload').show();
            $('.videoWrap').remove();
        }
    }

    /*----------------------------------------------------------------------------------*/
    /*	Video background size
    /*-----------------------------------------------------------------------------------*/

    function videoBackgroundSize() {

        "use strict";

        $('.videoWrap').each(function (i) {

            var $sectionWidth = $(this).closest('.videoHome ').outerWidth();
            var $vcVideoWrap = $(this).parents('.vc_videowrap');

            if ($vcVideoWrap.length) {

                var $sectionHeight = $vcVideoWrap.find('.vc_videocontent').outerHeight();

                $(this).width($sectionWidth);
                $vcVideoWrap.height($sectionHeight);

            } else {

                var $sectionHeight = $(this).closest('.videoHome').outerHeight();
                $(this).width($sectionWidth);
                $(this).height($sectionHeight);

            }

            // calculate scale ratio
            var videoWidthOriginal = 1280,  // original video dimensions
            videoHeightOriginal = 720,
            vidRatio = 1280 / 720,
            scale_h = $sectionWidth / videoWidthOriginal,
            scale_v = ($sectionHeight) / videoHeightOriginal,
            scale = scale_h > scale_v ? scale_h : scale_v;

            // limit minimum width
            var minVideoWidth = vidRatio * ($sectionHeight + 20);

            if (scale * videoWidthOriginal < minVideoWidth) { scale = minVideoWidth / videoWidthOriginal; }

            $(this).find('video').width(Math.ceil(scale * videoWidthOriginal + 2));
            $(this).find('video').height(Math.ceil(scale * videoHeightOriginal + 2));

            $(this).scrollLeft(($(this).find('video').width() - $sectionWidth) / 2);
            $(this).find('.mejs-overlay, .mejs-poster').scrollTop(($(this).find('video').height() - ($sectionHeight)) / 2);
            $(this).scrollTop(($(this).find('video').height() - ($sectionHeight)) / 2);

        });

    }

    /*----------------------------------------------------------------------------------*/
    /*	 top space for blog and portfolio in main page
    /*-----------------------------------------------------------------------------------*/

    function mainTopSpace() {

        "use strict";
        if ($windowWidth > 1024) {

            if (!($('.homeWrap').length) && $('.page-template-main-page-php').length) {

                var variable = $('.epicoSection');
                variable = variable.first();
                if (variable.hasClass('blogSection') || variable.hasClass('customSection')) {
                    if (!($epHeader.hasClass('wave-menu-header'))) {

                        if (($('.vertical_menu_navigation').length)) {
                            // when left or right menu is enable
                        } else {
                            // when left or right menu is disable
                            variable.css('padding-top', '58px');
                        }
                    }
                }
            }
        }

    }

    /*----------------------------------------------------------------------------------*/
    /*	set min-height For Blog and blog Detail 
    /*-----------------------------------------------------------------------------------*/

    function minPageHeightSet() {

        if ($windowWidth > 1024) {

            $pageFooterHeight = $('.footer-bottom').height();

            // Add Google Map Height  too fooret height
            if ($('#googleMap').length) {
                $pageFooterHeight = $pageFooterHeight + $('#googleMap').height();
            }

            // Add Footer Widget section height too Footer height
            if ($('.footer-widgetized').length) {
                $pageFooterHeight = $pageFooterHeight + $('.footer-widgetized').height();
            }

            //check if is in home and it is without slider, set a min-height for page
            if ($('#main').length && $('#fullScreenSlider').length <= 0) {

                $pageMainHeight = $('#main').height();
                $wholePageHeight = $pageMainHeight + $pageFooterHeight;
                $pageMainHeight2 = $windowHeight - $pageFooterHeight;

                if ($windowHeight > $wholePageHeight) {
                    $('#main').css({
                        'min-height': $pageMainHeight2 + "px",
                    });
                }


            } else if ($('#blogSingle').length) {

                $pageMainHeight = $('#blogSingle').height();
                $wholePageHeight = $pageMainHeight + $pageFooterHeight;
                $pageMainHeight2 = $windowHeight - $pageFooterHeight;



                if ($windowHeight > $wholePageHeight) {
                    $('#blogSingle').css({
                        'min-height': $pageMainHeight2 + "px"
                    });
                }

            } else if ($('#pageHeight').length) {

                $pageMainHeight = $('#pageHeight').height();
                $wholePageHeight = $pageMainHeight + $pageFooterHeight + 68;
                $pageMainHeight2 = $windowHeight - $pageFooterHeight - 68;

                if ($windowHeight > $wholePageHeight) {
                    $('#pageHeight').css({
                        'min-height': $pageMainHeight2 + "px"
                    });
                }

            }

        }
    }

    /*----------------------------------------------------------------------------------*/
    /*	socail share icon
    /*-----------------------------------------------------------------------------------*/

    function socailshare() {
        // Google Plus like button
        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
        po.src = 'https://apis.google.com/js/plusone.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
    }

    /*-----------------------------------------------------------------------------------*/
    /*	social share's pop up 
    /*-----------------------------------------------------------------------------------*/

    function social_share_pop_up() {

        $(".social_links a").click(function (e) {

            $url = $(this).attr('href');;
            $title = $(this).attr('title');;

            newwindow = window.open($url, $title, 'height=300,width=600');
            if (window.focus) { newwindow.focus() }
            return false;
        });
    }

    /*----------------------------------------------------------------------------------*/
    /*	WPML
    /*-----------------------------------------------------------------------------------*/

    function wpml_menu() {

        if ($('.headerWrap .menu-item-language').length) {
            $('.headerWrap .menu-item-language').append($("<span class='spanHover'></span>"));
        }
    }


    /*----------------------------------------------------------------------------------*/
    /*   Showcase
    /*-----------------------------------------------------------------------------------*/

    // Set Showcase Height
    function showcase_height() {
        var $showcase_wrapper = $('.showcase').not('.showcase-mobile').find('.showcase-content-wrapper');
        var $empty_space = $windowHeight - $showcase_wrapper.height();

        //set showcase height
        $('.showcase').not('.showcase-mobile').css({ height: $windowHeight });

        //set center align vertically
        if($empty_space>=0)
        {
            $showcase_wrapper.css({ "margin-top": ($empty_space/2) + "px" });
        }

    }

    function showcase_appear() {
        $('.showcase').not('.showcase-mobile').each(function(){
            //tablet
            if($windowWidth <= 1024)
            {
                $(this).find('.showcase-bg').removeClass('bg-animated active');
                $(this).find('.showcase-item').removeClass('active');
                $(this).find('.item-list h6').removeClass('active');

                //activate and animate
                $(this).find('.showcase-bg').first().addClass('bg-animated active');
                $(this).find('.showcase-item').first().addClass('active');
                $(this).find('.item-list h6').first().addClass('active');

            }
            else
            {
                $(this).appear(function () {
                    //reset
                    $(this).find('.showcase-bg').removeClass('bg-animated active');
                    $(this).find('.showcase-item').removeClass('active');
                    $(this).find('.item-list h6').removeClass('active');

                    //activate and animate
                    $(this).find('.showcase-bg').first().addClass('bg-animated active');
                    $(this).find('.showcase-item').first().addClass('active');
                    $(this).find('.item-list h6').first().addClass('active');
                });
            }
        });
    }
    
    function set_showcase_fullwidth() {

        "use strict";

        $('.showcase').not('.showcase-mobile').each(function () {
            
            $(this).parent().parent().css({
                'padding-right': '0px',
                'padding-left': '0px',
            });
            var $removeclass = $(this).closest("div[class*='vc_col-sm-']");
            $removeclass.removeClass($removeclass.attr('class'));
            $(this).closest('.container').removeClass('container');
        });

    }

    function showcase() {

        "use strict";
        
        // Next button in Showcase
        if (!$('.showcase').length) return;

        // Set showcase as a full width container
        set_showcase_fullwidth();

        if($windowWidth>=768)
        {

            // Set showcase height when the page loaded
            showcase_height();

            //active showcases
            showcase_appear();

            $('.showcase').not('.showcase-mobile').find('.item-content p').mCustomScrollbar({
                theme: "dark-thick",
                autoHideScrollbar: true
            });

            $(".showcase .next-showcase a").click(function (e) {
                e.preventDefault();
                
                var $next_section = $(this).parents('.showcase').nextAll('.showcase:not(.showcase-mobile)').first(); // if Two showcases are in One row

                if (!$next_section.length) {
                    $next_section = $(this).parents('.showcase').parent().parent().nextAll('div').first().find('.showcase:not(.showcase-mobile)'); // if two showcases are in one row (in same or different span)
                }

                if (!$next_section.length) {
                    $next_section = $(this).parents('.row_section').nextAll('.row_section').first(); // if two showcases are in different row
                }

                if (!$next_section.length) {
                    $next_section = $(this).parents('.customSection').nextAll('.customSection').first();// if two showcases are in different pages tandemly
                }

                if (!$next_section.length) return;

                scroll_to($next_section, 5);

            });

            $('.showcase').not('.showcase-mobile').find('.item-list h6').hover(function () {
                if (!$(this).hasClass('active')) {
                    var $backgrounds = $(this).parents('.container').siblings('.showcase-backgrounds');
                    var $contents = $(this).parents('.row').find('.showcase-items');
                    var $items_list = $(this).parent('.item-list');
                    var $direction = Array('left-top', 'left-bottom', 'right-top', 'right-bottom');
                    var $bgid = $(this).data('bg-id');

                    var $random_dir = $direction[Math.floor(Math.random() * $direction.length)];

                    //Activate hovered item
                    $items_list.find('h6').removeClass('active');
                    $(this).addClass('active');

                    //Activate background
                    var $prev_bg_item = $backgrounds.find('.active');
                    var $next_bg_item = $backgrounds.find('[data-bg-id="' + $bgid + '"]');
                    $prev_bg_item.removeClass('active');
                    setTimeout(function () {
                        $prev_bg_item.removeClass('bg-animated left-top left-bottom right-top right-bottom');
                    }, 500);
                    $next_bg_item.addClass('active bg-animated ' + $random_dir);

                    //Activate content
                    var $prev_content_item = $contents.find('.active');
                    var $next_content_item = $contents.find('[data-bg-id="' + $bgid + '"]');
                    $next_content_item.addClass('active');
                    $prev_content_item.removeClass('active');
                }

            },
            function () {
                //Nothing
            });

            $('.showcase').not('.showcase-mobile').find('.swiper-container').each(function(){
                var $swiper = new Swiper($(this), {
                    slidesPerView: 4,
                    paginationClickable: true,
                    spaceBetween: 0,
                    grabCursor: true
                });
            });

        }
        else
        {
            $('.showcase-mobile').find('.item-content p').mCustomScrollbar({
                theme: "dark-thick",
                autoHideScrollbar: true
            });

            $('.showcase-mobile .swiper-container').each(function(){
                var $swiper = new Swiper($(this), {
                    slidesPerView: 4,
                    spaceBetween: 0,
                    grabCursor: true
                });
            });
        }


    }

    /*----------------------------------------------------------------------------------*/
    /*   custom Textbox
    /*-----------------------------------------------------------------------------------*/

    function custom_textbox() {
        $('.custom-textbox').each(function(){
            $(this).appear(function () {
                $(this).addClass('bg-animated active');
            })
        });
    }

    /*----------------------------------------------------------------------------------*/
    /*   Custom title
    /*-----------------------------------------------------------------------------------*/

    function customTitleParallax() {

        "use strict";
        if ($windowWidth > 1024 && !isTouchDevice) {
            var $window_y = $window.scrollTop();
            $('.custom-title').each(function(){
                var $parallaxed_Shape = $(this).find('.shape-container');
                var $parallax_speed = .15;
                var $y_position =  ( $(this).offset().top -  $window_y - ($windowHeight/4));
                $y_position = $y_position * $parallax_speed;

                if(  $y_position > -10 )
                {
                    $parallaxed_Shape.css({ transform: 'translate3d(0,' + $y_position + 'px,0)' });
                }

            });
        }
    }

    /*----------------------------------------------------------------------------------*/
    /*   reInitialise the VC post grid
    /*-----------------------------------------------------------------------------------*/
    function vcGridReInit() {
        if($.fn.vcGrid)
            $.fn.vcGrid.call($('[data-vc-grid-settings]'));
    }

    /*----------------------------------------------------------------------------------*/
    /*   Ajax(djax) request handling
    /*-----------------------------------------------------------------------------------*/

    function page_transition($newElement, $scripts , $links, $styles) {

        // reference to the DOM element that is about to be replaced
        var $oldElement = this;
        //Hide the preloader
        preloader_hide();

        $newElement.fadeIn(400);

        var bodyelem = ($.browser.safari) ? bodyelem = $body : bodyelem = $("html,body");
        bodyelem.scrollTop(0);

        updateStyles($links, $styles);

        // Fadeout then slide in 
        $oldElement.fadeOut(50, function () {

            $oldElement.after($newElement);
            $newElement.hide();
            $newElement.fadeIn('fast',function(){
                updateScripts($scripts)
            });
            $oldElement.remove();

            reInitScripts();

        });

    }

    function reInitScripts(){

            homeHeight();

            //Initialise the VC post grid
            vcGridReInit();

            //close toggle menu after new page loading
            if ($('.wave-menu').length)
                closeToggleMenu();
           
            ep_singlePage();

            portfolioSlider();//portfolio Feature Image Slider

            //shortcodes
            ep_shortcode();

            //portfolio & portfolio details Functions
            var $pIsotopeContainer = 0; // id 0 for First Load
            portfolioIsotope($pIsotopeContainer);
            portfolioDHashChange();//Portfolio Detail Run When Hash Change functions
            portfolioLoadMore();//portfolio Load more Function
            pDNavigationNext();// linking to Next Portfolio Detail 
            pDNavigationPrevious(); // linking to Previous Portfolio Detail 
            Social_link(); // social links in Portfolio Detail 
            pDCloseProject(); // close Portfolio Detail
            pfilter();

            if (hash.substr(0, rootLength) == root) { // if URl Call portfolio Detail Run pDInitialize Function 
                pDInitialize();
            }

            minPageHeightSet();
            
            // gallery
            galleryStart();

            //blog Functions 
            blogLoadMore();//Blog Load More Function
            blogToggle();//Blog Toggle
            blogPostSlider(); // blog Single Slider

            parallaxHomeImg();
            parallaxImg();//section parallax

            initVideoBackground();
            videoBackgroundSize();

            fitVideo();//video Fit To All Screen
            commentRespond();

            // WPML MENU
            wpml_menu();

            image_carousel();
            shortcodeAnimation();

            //woocomerce
            disable_djax_on_woocommerce_pagination();
            initSelect2();
            product_thumbnails();
            product_add_to_cart();
            product_image_zoom();
            product_quantity();
            woocommerce_socials();
            wishlist_widget_update();
            card_widget_update();

            if ($('#fullScreenSlider').length )
            {
                fullScreenSliderInit();
                fullScreenSlider();
                sliderHidingInit();
            }

            if ($('#fullScreenImage').length )
            {
                fullScreenImageInit();
            }
                
            //top space For Blog And Portfolio In Main Page
            mainTopSpace();

            nav();

            //custom textbox
            custom_textbox();

            //Custom title
            customTitleParallax();

            //wpadminbar And Notification
            ep_notification();

            //User additional script
            ep_additionalScript();

            //Disable Parallax in touch devices   
            ep_disableParallaxInTouch();

            //social share's pop up 
            social_share_pop_up();

            //remove footer in creative portfolio detail
            remove_footer_creative_portfolio_detail();

            //remove top menu in creative portfolio detail
            remove_top_menu_creative_portfolio_detail();

            //remove left/right menu in creative portfolio detail
            remove_left_right_menu_creative_portfolio_detail();

            //portfolio detail title
            portfolio_detail_title();

            if ($enableScrollId == true) {
                if (!$('#portfoliSingle').length) {
                    scroll_to($scrolId, 1); //scroll to inside id  in Front Page
                } 
            }

            //contact form 7
            contactform7();

            //update wp-toolbar edit link
            updateToolbarEditLink();
        
            if ($('#googleMap').length)
                googleMap(); // Footer Google Map
            if ($('#homeGoogleMap').length)
                homegoogleMap(); // Home Google Map
		    
    }

    // Fix for updating head after djax
    window.assets = {
        script: [],
        css: []
    };

    function updateScripts($scripts) {

        //remove old plain scripts
        $('body script').each(function(){
            if($(this).attr("src") === undefined)
                $(this).remove();
        })

        //remove needless scripts for newly requested page
        var removedIdex = [];
        for (var i = 0; i < assets.script.length; i++) {
            var $elem = $(assets.script[i]);
            if($elem.attr("src") !== undefined)
            {

                if ($scripts.filter('script[src="' + $elem.attr("src") + '"]').length <= 0)
                {
                    removedIdex.push(i)
                    $body.find('script[src="' + $elem.attr("src") + '"]').remove();
                }

            }

        }
        for (var i = 0; i < removedIdex.length; i++) {
            assets.script.splice(removedIdex[i], 1);
        }
        
        //Adding scripts of newly requested page
        $scripts.each(function(index, val){
            if($(this).attr("src") === undefined)
            {
                var ele = document.createElement('script');
                ele.setAttribute("type", "text/javascript");
                ele.text = $(this).html();
                var first = document.body.getElementsByTagName('script')[0];
                first.parentNode.insertBefore(ele, first);
            }
            else if ($body.find('script[src="' + $(this).attr("src") + '"]').length <= 0)
            {
                var ele = document.createElement('script');
                ele.setAttribute("type", "text/javascript");
                ele.setAttribute("src", $(this).attr("src"));
                document.body.appendChild(ele);
                assets.script.push(ele);
                                                
            }                               
        });
    }


    function updateStyles($links, $styles) {
 
        //remove old style
        $('head style').each(function(){
            $(this).remove();
        });

        //remove needless styles for newly requested page
        var removedIdex = [];
        for (var i = 0; i < assets.css.length; i++) {
            var $elem = $(assets.css[i]);

            if ($links.filter('link[href="' + $elem.attr("href") + '"]').length <= 0)
            {
                removedIdex.push(i)
                $('head').find('link[href="' + $elem.attr("href") + '"]').remove();
            }

        }
        for (var i = 0; i < removedIdex.length; i++) {
            assets.css.splice(removedIdex[i], 1);
        }

        //Adding styles of newly requested page
        if(typeof $styles != 'undefined' )
        {
            $styles.each(function(index, val){
                document.head.appendChild(this);                           
            });
        }

        $links.filter('link').each(function(index, val){

            if ($('head').find('link[href="' + $(this).attr("href") + '"]').length <= 0)
            {

                var ele = document.createElement('link');
                ele.setAttribute("type", "text/css");
                ele.setAttribute("rel", "stylesheet");
                ele.setAttribute("media", $(this).attr('media'))
                ele.setAttribute("href", $(this).attr("href"));
                document.head.appendChild(ele);
                assets.css.push(ele);
                                                
            }                               
        });
    }



    function djaxifyRequests() {
        //active djax
        djax = $body.djax(
            '.main-content', // trackable container
            ['wp-login', '/wp-content/', 'admin', 'resources', 'remove_from_wishlist=' ,  'add_to_wishlist' , '#', 'wpml', '?locaklink', '?post_type=product&add-to-cart=', 'add-to-cart=', '#wpcf7-f4-o1'], // list of exception url fragments
            ['no_djax'], // list of exception body classes
            no_ajax_objects.no_ajax_pages, // list of exception urls
            page_transition, // replace block function
            preloader_show, // function that runs before proccessing blocks
            portfolioDetailNavigationLoading); // function that is sync with djax request

    }

    function reInitDjax() {
        djax.reInit();
    }

    $window.bind('djaxClick', function(e, data) {
        
        var link = $(data);
        //fetch data for ajax request of navigations
        if(link.hasClass('portfolioLink'))
        {
            $skills  = link.parents('.isotope').data('skills');
            $portfolioBackLink = $(location).attr('href');
            $portfolioID = link.data('pid');

        }
        else if(link.hasClass('portfolioDetailNavLink'))
        {
            $skills  = link.data('skills');
            $portfolioBackLink = $("#PDbackToPortfolio").attr('href');
            $portfolioID = link.data('pid');
        }
    });


    /*----------------------------------------------------------------------------------*/
    /*   Wordpress toolbar edit link update
    /*-----------------------------------------------------------------------------------*/
    function updateToolbarEditLink(content) {
        "use strict";
        
        if($("#wp-admin-bar-edit").length > 0){
            // set up edit link when wp toolbar is enabled
            var page_id = $body.data('pageid');
            var old_link = $('#wp-admin-bar-edit a').attr("href");
            var new_link = old_link.replace(/(post=).*?(&)/,'$1' + page_id + '$2');
            $('#wp-admin-bar-edit a').attr("href", new_link);
        }
    }

    /*----------------------------------------------------------------------------------*/
    /*   preloader
    /*-----------------------------------------------------------------------------------*/

    function preloader_show() {

        if($("#preloader").hasClass('firstload')) {
            $("#preloader").removeClass('firstload');
        }

        $("#preloader").css({'display':'block'});
        setTimeout(function(){
            $("#preloader").removeClass('hide-preloader creative').addClass('simple');
        }, 10);
        
    }

    function preloader_hide() {
        $("#preloader").addClass('hide-preloader');
        setTimeout(function(){
            $("#preloader").css({'display':'none'});
        }, 510);
    }


    /*----------------------------------------------------------------------------------*/
    /*   wpadminbar And Notification
    /*-----------------------------------------------------------------------------------*/

    function ep_notification() {
        if ($("#wpadminbar").size() != 0 && $windowWidth > 1024) {

            if ($("#notification").size() != 0 && $(".page-template-main-page-php").size() != 0) {

                if (!($epHeader.hasClass('closednotification'))) {
                    // notification bar Enable With wpadminbar 
                    $epHeader.add(".navigation-mobile").add("#homeHeight").addClass('menuSpaceWpNoti');
                    $("#notification").addClass('notificationSpaceWp');
                }

            } else {

                // notification bar disable With wpadminbar 
                $epHeader.add("#homeHeight").addClass('menuSpaceWp');

            }

        } else if ($("#notification").size() != 0 && $(".page-template-main-page-php").size() != 0 && !$("#notification").hasClass('closed-notification')) {

            // notification bar Enable
            $epHeader.add("#homeHeight").addClass('menuSpaceNoti');

        }

        //notification close
        $("#notification a.closebtn ").click(function (e) {

            $("#notification").slideUp('460').addClass("closed-notification");

            // wpadminbar And Notification
            if ($("#wpadminbar").size() != 0 && $windowWidth > 1024) {

                // notification bar Enable With wpadminbar 
                $epHeader.add("#homeHeight").removeClass('menuSpaceWpNoti').addClass('menuSpaceWp').addClass('closednotification');

            } else if ($("#notification").size() != 0) {

                // notification bar Enable
                $epHeader.add("#homeHeight").removeClass('menuSpaceNoti');
            }

            e.preventDefault();
        });


        if ($("#wpadminbar").size() != 0 && $(".vertical_menu_enabled").size() != 0) {

            $('#home .homeWrap .fullScreenImage').css({
                'margin-top': "32px",
            });

        }


    }


    /*----------------------------------------------------------------------------------*/
    /*   User additional script
    /*-----------------------------------------------------------------------------------*/
    
    function ep_additionalScript() {
        //Run extra scripts here
        if ('' != epicoAdditionalJs.additionaljs)
            eval(epicoAdditionalJs.additionaljs);
    }

    /*----------------------------------------------------------------------------------*/
    /*   Scrolling
    /*-----------------------------------------------------------------------------------*/
    
    function ep_scrolling() {
            var scroll;
            $(".navigation li a , #phoneNavItems li a , .vertical_menu_navigation li a").click(function (e) {

                $(".navigation li , #phoneNavItems li , .vertical_menu_navigation li").removeClass('active current_page_item');

                var hashAttr = $(this).attr('data-hash');
                if (typeof hashAttr === typeof undefined || hashAttr === false)
                {
                    $(this).parent().addClass('active');
                }
                else
                {
                    $('.navigation li a[data-hash="'+ $(this).attr('data-hash') +'"]').add('#phoneNavItems li a[data-hash="'+ $(this).attr('data-hash') +'"]').add('.vertical_menu_navigation li a[data-hash="'+ $(this).attr('data-hash') +'"]').parent().addClass('active');//Active item in all menus(Specially for epico-menu)
                }

                scroll = $(this).attr("data-hash");
                $scrollHash = '#';
                $scrollHash = $scrollHash.concat(scroll);

                if (!$(this).hasClass('locallink')) {
                    $externalClicked = true;
                }

                if ($(this).hasClass('externalLink')) {

                    scroll = $(this).attr("data-hash");
                    $scrollHash = '#';
                    $scrolId = $scrollHash.concat(scroll); // section id that scroll into From External Page in internal page
                    
                    if($checkFixed === 'epico-menu')
                    {
                        $("#headerSecondState").addClass('disabletransition');
                        $("#headerFirstState").addClass('disabletransition');
                    }

                } else if ($(this).hasClass('locallink')) {

                    e.preventDefault();
                    $scrolingToSection = true;
                    scroll_to($scrollHash, 4); //scroll to inside id  in Front Page
                }

                if ($(this).hasClass('externalLink')) {
                    $enableScrollId = true;
                } else {
                    $enableScrollId = false;
                }
               
            });

        $("header .locallink.logo , aside .locallink.logo,header .locallink.home , aside .locallink.home").click(function (e) {
            scroll = $(this).attr("href");
            scroll = scroll.substring(scroll.indexOf("#"), scroll.length);
            scroll_to(scroll, 2);  //scroll to top of page
            e.preventDefault();
        });

        var pathname = window.location.href;

        if (!window.location.origin) { // Internet Explorer Origion
            window.location.origin = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ':' + window.location.port : '');
        }

        var $originpathname = window.location.origin + window.location.pathname;

        if(pathname.search("#")>0)
        {
            pathname = pathname.substring(pathname.indexOf("#"), pathname.length);
            if ($originpathname !== pathname && pathname !== '#home') {
                if ($(".page-template-main-page-php").length) {
                    scroll_to(pathname, 1);
                }
            }       
        }
    }

    //Initial list of menu items
    function initialMenuArray(){
        var aChildren = $epHeader.find(".navigation li a").add(".vertical_menu_area .vertical_menu_navigation ul a"); // find the a children of the list items
        
        for (var i = 0; i < aChildren.length; i++) {

            var aChild = aChildren[i];
            if ($(aChild).hasClass('locallink')) {

                var ahref = $(aChild).attr("data-hash");
                if(menuArray.indexOf(ahref) == -1)
                    menuArray.push(ahref);

            }
        } // this for loop fills the menuArray with attribute href values
    }

    /* add active class for menu when page Scrolling */
    function updateMenuOnActiveSection(){

        //check navigating flag to know it is on scrolling to a section or not ( by click from user)
        if($scrolingToSection == false && $externalClicked == false)
        {

            var $window_y = $window.scrollTop(); // get the offset of the window from the top of page
            for (var i = 0; i < menuArray.length; i++) {
                var theID = "#" + menuArray[i];
                var theHash = menuArray[i];

                if ($(theID).length) {

                    var divPos = $(theID).offset().top; // get the offset of the div from the top of page
                    var divHeight = $(theID).height(); // get the height of the div in question
                    var menusize = 87;

                    if($(".vertical_menu_area").length)
                        menusize = 0;

                    if ($("#wpadminbar").size() != 0) { // wpadminbar 
                        menusize = menusize + 36;
                    }

                    //Set divPos to 0 becouse #home section is parallax and doesn not exist from page normally
                    if(theID == '#home')
                    {
                        divPos = 0;
                    }

                    if($body.hasClass('home'))
                    {
                        $epHeader.find(".navigation li.current_page_item").removeClass("current_page_item");
                        $("aside.vertical_menu_area .vertical_menu_navigation ul li.current_page_item").removeClass("current_page_item");
                    }

                    if ($window_y >= (divPos - menusize) && $window_y < (divPos + divHeight - menusize)) {
                        $epHeader.find(".navigation a[data-hash='" + theHash + "']").parent().addClass("active");
                        $("aside.vertical_menu_area nav.vertical_menu_navigation li a[data-hash='" + theHash + "']").parent().addClass("active");
                    } else {
                        $epHeader.find(".navigation a[data-hash='" + theHash + "']").parent().removeClass("active");
                        $("aside.vertical_menu_area nav.vertical_menu_navigation li a[data-hash='" + theHash + "']").parent().removeClass("active");
                    }
                }
            }            
        }
    }

    /*----------------------------------------------------------------------------------*/
    /*   Disable Parallax in touch devices
    /*-----------------------------------------------------------------------------------*/
    
    function ep_disableParallaxInTouch() {
        if (isTouchDevice) {

            $('#home, .footer-bottom').css('cssText', 'position: static !important');
            $('#main').css('cssText', 'margin-bottom: 0 !important');

        }
    }

    /*----------------------------------------------------------------------------------*/
    /*   Singlepages initialize
    /*-----------------------------------------------------------------------------------*/

    function ep_singlePage() {
        if ($('#portfoliSingle').length) {

            $('#portfoliSingle').waitForImages(function () {

                pDSwiper();// portfolio Detail swiper Slider

                if ($('.portfolio_detail_creative').length) {
                    
                    $('.portfolio_detail_creative .pd_creative_fixed_content .desc').mCustomScrollbar({
                        theme: "dark-thick",
                        autoHideScrollbar: true
                    });

                    // set margin for Creative portfolio detail
                    set_margin_creative_portfolio_detail();
                }
            });

        } else if ($('#blogSingle').length || $('.cblog').length) {
            blogPostSlider(); // Blog Post slider
            socailshare(); // socail share
        }
    }

    /*----------------------------------------------------------------------------------*/
    /*   Search form
    /*-----------------------------------------------------------------------------------*/

    function search_form() {
        
        var $searchButton = $('.search-button');
        if ($searchButton.length <= 0)
            return;

        var $searchForm = $('#search-form');
        var $searchInput= $searchForm.find('input[type="text"]');
        $searchButton.on('click',function () {
            $searchForm.toggleClass('showing');
            setTimeout(function(){
                $searchInput.focus();
                var tmpStr = $searchInput.val();
                $searchInput.val('');
                $searchInput.val(tmpStr);
            },100);



        });
        $searchForm.on('click',function (e) {
            if(!$(e.target).is('input'))
                $searchForm.removeClass('showing');

        });
    }

    /*----------------------------------------------------------------------------------*/
    /*  Contact form 7 - Restyles
    /*-----------------------------------------------------------------------------------*/

    function contactform7() {
        
        //contact form 7 
        if ($('.wpcf7').length) {

            $(".wpcf7 input").focus(function () {
                $(this).parent('.wpcf7-form-control-wrap').siblings('.label').addClass('inputfocus');
                $(this).parent('.wpcf7-form-control-wrap').siblings('.graylabel').addClass('inputfocus');
            });


            $(".wpcf7 input").focusout(function () {
                $(this).parent('.wpcf7-form-control-wrap').siblings('.label').removeClass('inputfocus');
                $(this).parent('.wpcf7-form-control-wrap').siblings('.graylabel').removeClass('inputfocus');
            });



            $(".wpcf7 textarea").focus(function () {
                $(this).parent('.wpcf7-form-control-wrap').siblings('.label').addClass('inputfocus');
                $(this).parent('.wpcf7-form-control-wrap').siblings('.graylabel').addClass('inputfocus');
            });


            $(".wpcf7 textarea").focusout(function () {
                $(this).parent('.wpcf7-form-control-wrap').siblings('.label').removeClass('inputfocus');
                $(this).parent('.wpcf7-form-control-wrap').siblings('.graylabel').removeClass('inputfocus');
            });


        }


        // blog detail
        if ($('.comment-respond').length) {

            $(".comment-respond input").focus(function () {
                $(this).siblings('.label').addClass('inputfocus');
                $(this).siblings('.graylabel').addClass('inputfocus');
            });


            $(".comment-respond input").focusout(function () {
                $(this).siblings('.label').removeClass('inputfocus');
                $(this).siblings('.graylabel').removeClass('inputfocus');
            });

            $(".comment-respond textarea").focus(function () {
                $(this).siblings('.label').addClass('inputfocus');
                $(this).siblings('.graylabel').addClass('inputfocus');
            });


            $(".comment-respond textarea").focusout(function () {
                $(this).siblings('.label').removeClass('inputfocus');
                $(this).siblings('.graylabel').removeClass('inputfocus');
            });

        }

        // product detail
        if ($('#review_form').length) {

          
            $("#review_form input").focus(function () {
                $(this).siblings('.label').addClass('inputfocus');
                $(this).siblings('.graylabel').addClass('inputfocus');
            });


            $("#review_form input").focusout(function () {
                $(this).siblings('.label').removeClass('inputfocus');
                $(this).siblings('.graylabel').removeClass('inputfocus');
            });

            $("#review_form textarea").focus(function () {
                $(this).siblings('.label').addClass('inputfocus');
                $(this).siblings('.graylabel').addClass('inputfocus');
            });


            $("#review_form textarea").focusout(function () {
                $(this).siblings('.label').removeClass('inputfocus');
                $(this).siblings('.graylabel').removeClass('inputfocus');
            });

        }


    }


    /*----------------------------------------------------------------------------------*/
    /*  Home parallax
    /*-----------------------------------------------------------------------------------*/

    function homeParallax() {

        var $window_y = $window.scrollTop();

        if ($("#hideMenuFirst").size() != 0 && $windowWidth > 1024) {

            //background home parallax
            $('#home').css({
                'top': ($window_y * -0.2) + "px"
            });

            // home caption slider parallax 
            $('.caption').css({
                'margin-top': ($window_y * -0.05) + "px",
                'opacity': (1 - ($window_y / 550))
            });

            // start here button parallax
            $('#caption-start').css({
                'margin-top': ($window_y * -0.5 + -120) + "px",
                'opacity': (1 - ($window_y / 500))
            });
        }

    }


    /*----------------------------------------------------------------------------------*/
    /*  Header transform
    /*-----------------------------------------------------------------------------------*/

    function headerTransform() {

        var $window_y = $window.scrollTop();

        if ($("#hideMenuFirst").size() != 0 && $window.width() > 1024) {
            if ($documentHeight > 500 && $checkFixed != 'fixed-menu') {

                var $hideMeunScrollHeight = $windowHeight * 0.08;

                if ($window_y > $hideMeunScrollHeight && $checkFixed === 'scroll-sticky') {

                    $epHeader.css({
                        'opacity': "1",
                    });


                } else if ($window_y > $hideMeunScrollHeight && $checkFixed === 'epico-menu') {
                    var $checkShowMenu = $epHeader.hasClass('hideHeaderShadow');
                    if ($checkShowMenu) {

                        $("#headerFirstState").css({
                            'top': '0px',
                            'opacity': "0",
                            'z-index': "4",
                        });

                        $("#headerSecondState").css({
                            'top': '0px',
                            'opacity': "1",
                            'display': "block",
                            'z-index': "5",
                        });

                        $epHeader.removeClass('hideHeaderShadow');

                    }


                } else {

                    if ($checkFixed === 'scroll-sticky') {

                        if ($(".page-template-main-page-php").size() !== 0) {
                            $epHeader.css({
                                'opacity': "0",
                            });
                        }

                    } else if ($checkFixed === 'epico-menu') {

                        var $checkShowMenu = $epHeader.hasClass('hideHeaderShadow');
                        if (!$checkShowMenu) {

                            $("#headerFirstState").css({
                                'top': '25px',
                                'opacity': "1",
                                'z-index': "5",
                            });


                            $("#headerSecondState").css({
                                'top': '25px',
                                'opacity': "0",
                                'display': "block",
                                'z-index': "4",
                            });

                            $epHeader.addClass('hideHeaderShadow');

                        }

                    }

                    /* slide up the menu List if open */
                    var $menu = $('#phoneNavItems');
                    var $phoneNavIcon = $('#phoneNavIcon');

                    $menu.slideUp('fast');
                    $phoneNavIcon.removeClass('active');

                }
            }
        }
    }

    /*----------------------------------------------------------------------------------*/
    /*  Footer fixed
    /*-----------------------------------------------------------------------------------*/

    function footerFixed() {

        var $window_y = $window.scrollTop();
        var $ffheight = $windowHeight + 700;
        var mainHeight = $body.height();

        if (mainHeight > $ffheight && $windowWidth > 768 && $(".page-template-main-page-php").size() != 0 && !isTouchDevice) {
            if ($window_y > $ffheight) {
                $("#main").css('margin-bottom', '115px');
                $('.footer-bottom').addClass('ffooter-bottom');
            } else {
                $('.footer-bottom').removeClass('ffooter-bottom');
            }
            
        } else if ($(".page-template-main-page-php").size() == 0) {
            if ($('.footer-bottom').hasClass('ffooter-bottom')) {
                $('.footer-bottom').removeClass('ffooter-bottom');
            }
        }
    }

    /*----------------------------------------------------------------------------------*/
    /*  "Go to top" button
    /*-----------------------------------------------------------------------------------*/

    function goToTopButton() {

        var $window_y = $window.scrollTop(); // get the offset of the window from the top of page

        /* scroll to top page  */
        if ($window_y > 2500 && !($("#scrollToTop").hasClass('visibleScrollTop'))) {
            $("#scrollToTop").fadeIn('fast');
            $("#scrollToTop").addClass('visibleScrollTop');

        } else if ($window_y < 2500 && $("#scrollToTop").hasClass('visibleScrollTop')) {
            $("#scrollToTop").fadeOut('fast');
            $("#scrollToTop").removeClass('visibleScrollTop');

        }
    }
	
    /*----------------------------------------------------------------------------------*/
    /*  Gallery
    /*-----------------------------------------------------------------------------------*/

    function galleryStart(){
	    $('.ep_lightGallery').lightGallery({
		    selector: '.galleryItem',
		    counter: true,
		    mode:'lg-fade',
		    speed: 400
	    });
		
	    $('.ep_lightGallery').on('onBeforeSlide.lg',function(event){
		    $('.lg-sub-html').children().css('opacity',0);
	    });
	
	    $('.ep_lightGallery').on('onAfterAppendSubHtml.lg',function(event){
	        $('.lg-sub-html').children().show('opacity', 1);
        });
	
	    $('.ep_lightGallery').on('onBeforeOpen.lg',function(event){
		    $(".isotope.darkStyle").click(function(){
                $('.lg').addClass('darkStyle');
			    $('.lg-backdrop.in').addClass('galleryBack');
	        });
        });
	}

    $(function () {

        djaxifyRequests();

        homeHeight();

        ep_singlePage();

        //portfolio Feature Image Slider
        portfolioSlider();
		
		//Run gallery
		galleryStart();

        //shortcodes
        ep_shortcode();

        //portfolio & portfolio details Functions
        var $pIsotopeContainer = 0; // id 0 for First Load
        portfolioIsotope($pIsotopeContainer);
        portfolioDHashChange();//Portfolio Detail Run When Hash Change functions
        portfolioLoadMore();//portfolio Load more Function
        pDNavigationNext();// linking to Next Portfolio Detail 
        pDNavigationPrevious();	// linking to Previous Portfolio Detail 
        Social_link(); // social links in Portfolio Detail 
        pDCloseProject(); // close Portfolio Detail
        pfilter();

        if (hash.substr(0, rootLength) == root) { // if URl Call portfolio Detail Run pDInitialize Function 
            pDInitialize();
        }

        minPageHeightSet();

        //blog Functions 
        blogLoadMore();//Blog Load More Function
        blogToggle();//Blog Toggle
        blogPostSlider();// Blog post Slider

        parallaxHomeImg();
        parallaxImg();//section parallax

        initVideoBackground();
        videoBackgroundSize();

        fitVideo();//video Fit To All Screen
        commentRespond();

        // WPML MENU
        wpml_menu();

        nav();

        initialMenuArray();
        updateMenuOnActiveSection();

        // wave menu
        wave_menu();

        image_carousel();
        shortcodeAnimation();

        //woocomerce
        disable_djax_on_woocommerce_pagination();
        initSelect2();
        product_thumbnails();
        product_add_to_cart();
        product_image_zoom();
        product_quantity();
        woocommerce_socials();
        wishlist_widget_update();
        card_widget_update();

        if ($('#fullScreenSlider').length)
        {
            fullScreenSliderInit();
            fullScreenSlider();
            sliderHidingInit();
        }

        if ($('#fullScreenImage').length )
        {
            fullScreenImageInit();
        }


        //top space For Blog And Portfolio In Main Page
        mainTopSpace();

        phoneNav();

        //custom textbox
        custom_textbox();

        //Custom title
        customTitleParallax();

        //wpadminbar And Notification
        ep_notification();

        //User additional script
        ep_additionalScript();

        //Scrolling  
        ep_scrolling();

        //Disable Parallax in touch devices   
        ep_disableParallaxInTouch();

        //social share's pop up 
        social_share_pop_up();

        //contact form 7
        contactform7();

        //remove footer in creative portfolio detail
        remove_footer_creative_portfolio_detail();

        //remove top menu in creative portfolio detail
        remove_top_menu_creative_portfolio_detail();

        //remove left/right menu in creative portfolio detail
        remove_left_right_menu_creative_portfolio_detail();

        //portfolio detail title
        portfolio_detail_title();

        //Search form
        search_form();

        if ($('#googleMap').length)
            googleMap(); // Footer Google Map
        if ($('#homeGoogleMap').length)
            homegoogleMap(); // Home Google Map

        //use unbind to prevent from multiple times click event
        $("#scrollToTop a").unbind().click(function (e) {
            scroll_to("top", 3);  //scroll to top of page
            e.preventDefault();
        });

    });
    //End $(document).ready

    $window.load(function () {

        //Hide the preloader
        preloader_hide();

    });

    $window.scroll(function () {

        //Stop and hide slider when it is out of screen
        stopSliderOutOfScreen();

        //Activate menu item
        updateMenuOnActiveSection();

        //Go to top button
        goToTopButton();

        //Header transform
        headerTransform();

        //Footer fixed
        footerFixed();

        //Home parallax
        homeParallax();
           
        //Portfolio detail header parallax
        portfolio_detail_header_parallax();

        //Custom title
        customTitleParallax();
    });

    $window.resize(function () {

        $windowHeight = $window.height();
        $windowWidth = $window.width();


        if ($('#fullScreenSlider').length)
            fullScreenSliderInit();

        if ($('#fullScreenImage').length)
            fullScreenImageInit()

        fullWidthSection(); // FullWidth colorize Section - shortcode

        homeHeight();

        // blog toggle
        $('.blogAccordion').each(function () {
            var postVar = blogToggleArray($(this));
            // set toggle mode When Page Loaded
            blogToggleSet(postVar);
        });

        nav();

        var $pIsotopeContainer = 1; // id 1 Portfolio Resize 
        portfolioIsotope($pIsotopeContainer);

        videoBackgroundSize();

        // Mobile Menu
        phoneNavContainerHeight();

        //Set showcases height
        showcase_height();

        // set margin for Creative portfolio detail
        set_margin_creative_portfolio_detail();
    });


})(jQuery);