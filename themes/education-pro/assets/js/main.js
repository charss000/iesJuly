jQuery(document).ready(function($){'use strict';

/* ---------------------------------------------------------
    Preloader
------------------------------------------------------------ */ 
    $(window).on('load', function (e) {
        if ($(".pre-loader").length > 0)
        {
            $(".pre-loader").fadeOut("normal");
        }
    });

/* ---------------------------------------------------------
    Search
------------------------------------------------------------ */ 
    var $srcicon = $('.search-icon'),
        $srcfield = $('#search'),
        $window     = $(window);
    $srcicon.on('click', function(event){
        event.preventDefault();
        $srcfield.addClass('visible');
        event.stopPropagation();
    });
    $('.search-close').on('click', function(e){
        $srcfield.removeClass('visible');
    });
    $srcfield.on('click', function(event){
        event.stopPropagation();
    });
    $window.on('click', function(e){
        $srcfield.removeClass('visible');
    });


/* ---------------------------------------------------------
    mobile menu icon
------------------------------------------------------------ */       
        function tx_mob_menu_icon() {
            // Mobile Menu Dropdown Icon
            var hasChildren = $('.tx-res-menu li.menu-item-has-children');

            hasChildren.each( function() {
                var $btnToggle = $('<a class="mb-dropdown-icon" href="#"></a>');
                $( this ).append($btnToggle);
                $btnToggle.on( 'click', function(e) {
                    e.preventDefault();
                    $( this ).toggleClass('open');
                    $( this ).parent().children('ul').toggle('slow');
                } );
            } );

            // Hamburger icon click to display close icon
            $(".navbar-toggle").on("click", function(e){
                $(this).find($(".la")).toggleClass('la-navicon la-close');
            });

        }

        tx_mob_menu_icon();

/* ---------------------------------------------------------
   Gallery post format slider
------------------------------------------------------------ */         

    $('.posts-gallery-slider').each(function(i, e) {
      var id = 'posts-gallery-';
      $(e).attr('id', id+i);
      var selector = '#'+id+i;
       $(selector).lightSlider({
        adaptiveHeight:false,
        item:1,
        slideMargin:0,
        //speed:500, // slide speed, you can increase the value to slow down
        //pause:3000, // slide time, you can adjust slide time to increase / decrease value
        loop:true,
        auto:true,
        pager:false,
        pauseOnHover:true,
        onSliderLoad: function() {
            $('.posts-gallery-slider').removeClass('cS-hidden');
            }  

       });
    });

/* ---------------------------------------------------------
   LearnPress Course Single Page Slider
------------------------------------------------------------ */ 

            $('#course-gallery').lightSlider({
                gallery:true,
                galleryMargin:10,
                item:1,
                thumbItem:8,
                slideMargin: 100,
                speed:800, // slide speed, you can increase the value to slow down
                pause:3000, // slide time, you can adjust slide time to increase / decrease value
                auto:true,
                loop:true,
                pauseOnHover:true,
                onSliderLoad: function() {
            $('#course-gallery').removeClass('cS-hidden');
                    
                }  
            });
/* ---------------------------------------------------------
   related course
------------------------------------------------------------ */ 
    $('.related-course').owlCarousel({
        loop:false,
        margin:20,
        autoplay:false,
        slideSpeed: 200,
        paginationSpeed: 300,
        autoplayTimeout:2000,
        autoplayHoverPause:true,
        lazyLoad:true,
        nav: true,
        navText: ['<i class="la la-angle-left"></i>','<i class="la la-angle-right"></i>'], 
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            768:{
                items:2
            },
            1000:{
                items:3
            },
             1400:{
                items:3
            }
        }
    });

/* ---------------------------------------------------------
   Related Posts
------------------------------------------------------------ */ 
    $('.related-posts-loop').owlCarousel({
        loop:false,
        margin:20,
        autoplay:true,
        slideSpeed: 200,
        paginationSpeed: 300,
        autoplayTimeout:2000,
        autoplayHoverPause:true,
        lazyLoad:true,
        nav: true,
        navText: ['<i class="la la-angle-left"></i>','<i class="la la-angle-right"></i>'], 
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            768:{
                items:2
            },
            1000:{
                items:4
            },
             1400:{
                items:4
            }
        }
    });


/* ---------------------------------------------------------
   news-ticker
------------------------------------------------------------ */ 
    $('.news-ticker').owlCarousel({
        loop:true,
        autoplay:true,
        slideSpeed: 5000,
        paginationSpeed: 5000,
        autoplayTimeout:3000,
        autoplayHoverPause:true,
        nav: true,
        singleItem: true,
        items: 1,
        navText: ['<i class="la la-angle-left"></i>','<i class="la la-angle-right"></i>'], 
        
    });


/* ---------------------------------------------------------
    Scroll to top
------------------------------------------------------------ */ 
        function tx_back_top() {
            $('#back_top').on('click', function() {
                $('html,body').animate({
                    scrollTop: 0
                }, 400);
                return false;
            });

            if ($(window).scrollTop() > 300) {
                $('#back_top').addClass('back_top');
            } else {
                $('#back_top').removeClass('back_top');
            }

            $(window).on('scroll', function() {

                if ($(window).scrollTop() > 300) {
                    $('#back_top').addClass('back_top');
                } else {
                    $('#back_top').removeClass('back_top');
                }
            });
        }
        tx_back_top();



}); // End of jquery    

/* ---------------------------------------------------------
   EOF
------------------------------------------------------------ */
