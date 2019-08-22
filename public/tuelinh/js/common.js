(function($){
    $(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
    var statusSearch = 0;
    var timeSearch = null;
    var delaySearch = 5000;
    var height_device = $(window).height();
    var width_device = $(window).width();
    var changeMenuMobile = function(){
        if($("body").hasClass("show-menu")){
            var padding_menu = 30;
            var height_menu = $("#menu-right .inner").height() + padding_menu;
            if(height_menu <= height_device){
                height_menu = height_device;
            }
            if(width_device < 991){
                $("#wrapper").css({height: height_menu});
                $("#overlay").css({display: "block"});
            }else{
                closeMenuMobile();
            }
        }
    };
    var setMenuMobile = function(){
        $("#btn-menu").on("click",function(){
            if($("body").hasClass("show-menu")){
                closeMenuMobile();
            }else{
                $("body").removeClass('hide-menu').addClass("show-menu");
                changeMenuMobile();
            }
        });
    };

    var styleItemFix = function(obj){
        var height_slide = $(obj).height();
        var set = $(obj).data('set');
        var space1 = 0;
        var space2 = 0;
        if($(obj).data('fix')){
            var fix = $(obj).data('fix');
            space1 = $('#'+fix).height();
        }
        if(width_device > 480){
            if($(obj).data('page')){
                var page = $(obj).data('page');
                space2 = $('#'+page).height();
            }
        }
        var space = space1 + space2;
        $('#'+set).css({height: height_slide});
        if(space != 0){
            $(obj).css({top: space});
        }
    };

    var resetMenuMobile = function(){
        $("#overlay").on("click",function(){
            closeMenuMobile();
        });
    };
    var closeMenuMobile = function(){
        $("body").removeClass("show-menu").addClass('hide-menu');
        $("#wrapper").removeAttr("style");
        $("#overlay").css({display: "none"});
    };

    var checkSearch = function(){
        if(statusSearch == 0){
            window.clearTimeout(timeSearch);
            timeSearch = window.setTimeout(function(){
                $("#search").removeClass('of-hide').addClass("of-show");
            },0);
        }else{
            window.clearTimeout(timeSearch);
            timeSearch = window.setTimeout(function(){
                $("#search").removeClass("of-show").addClass("of-hide");
            },delaySearch);
        }
    };

    var changeSearch = function(){
        $("#search").hover(function(){
            checkSearch();
            statusSearch = 1;
        },function(){
            checkSearch();
            statusSearch = 0;
        });
    };

    var closeSearch = function(){
        $(window).click(function(e){
            if(statusSearch == 0){
                if($(e.target).is("input")){
                    return;
                }else{
                    $("#search").removeClass("of-show").addClass("of-hide");
                    statusSearch == 1;
                }
            }
        });
    };
    var slideCup = function(){
        $('#slide-cup').owlCarousel({
            loop:true,
            margin:20,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                    nav:true,
                    dots: false
                },
                640:{
                    items:2,
                    nav:true,
                    dots: false
                },
                1000:{
                    items:5,
                    nav:true,
                    loop:true,
                    dots: false
                }
            }
        });
    };
    var slideActivity = function(){
        $('#slide-activity').owlCarousel({
            loop:true,
            margin:20,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                    nav:true,
                    dots: false
                },
                640:{
                    items:2,
                    nav:true,
                    dots: false
                },
                1000:{
                    items:4,
                    nav:true,
                    loop:true,
                    dots: false
                }
            }
        });
    };
    var slideNews = function(){
        $('#slide-news').owlCarousel({
            loop:true,
            margin:20,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                    nav:true,
                    dots: false
                },
                640:{
                    items:2,
                    nav:true,
                    dots: false
                },
                1000:{
                    items:4,
                    nav:true,
                    loop:true,
                    dots: false
                }
            }
        });
    };
    var slideGroup = function(){
        $('#slide-group').owlCarousel({
            loop:true,
            margin:20,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                    nav:true,
                    dots: false
                },
                640:{
                    items:2,
                    nav:true,
                    dots: false
                },
                1000:{
                    items:3,
                    nav:true,
                    loop:true,
                    dots: false
                }
            }
        });
    };
    var slideFoot = function(){
        $('#box-slide-foot').owlCarousel({
            loop:true,
            margin:20,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                    nav:true,
                    dots: false
                },
                640:{
                    items:2,
                    nav:true,
                    dots: false
                },
                1000:{
                    items:4,
                    nav:true,
                    loop:true,
                    dots: false
                }
            }
        });
    };
    var slideHome = function(){
        $('#slide-home').owlCarousel({
            loop: true,
            margin: 0,
            responsiveClass: true,
            responsive:{
                0:{
                    items: 1,
                    nav: false,
                    dots: false
                },
                640:{
                    items: 1,
                    nav: false,
                    dots: false
                },
                1000:{
                    items: 1,
                    nav: false,
                    dots: false
                }
            }
        });
    };

    var slideProject = function(){
        $('#slide-project').owlCarousel({
            loop: true,
            margin: 0,
            responsiveClass: true,
            responsive:{
                0:{
                    items: 1,
                    nav: true,
                    dots: false
                },
                640:{
                    items: 1,
                    nav: true,
                    dots: false
                },
                1000:{
                    items: 1,
                    nav: true,
                    dots: false
                }
            }
        });
    };

    var slideApartment = function(){
        try{
            $('#slide-apartment').owlCarousel({
                loop: false,
                margin: 0,
                responsiveClass: true,
                navText: ['Nhà Thông Minh Cho Căn Hộ', 'Nhà Thông Minh Cho Biệt Thự'],
                responsive:{
                    0:{
                        items: 1,
                        nav: true,
                        dots: false
                    },
                    640:{
                        items: 1,
                        nav: true,
                        dots: false
                    },
                    1000:{
                        items: 1,
                        nav: true,
                        dots: false
                    }
                }
            });
        }catch (e){

        }
    };

    var changeElementObject = function(){
      $('[data-change="true"]').click(function(e){
          var large = $(this).data('large');
          var desc = $(this).data('desc');
          var reset = $(this).data('reset');
          $('#'+reset+' .large').stop().hide();
          $('#'+reset+' .desc').stop().hide();
          $('#'+reset+' [data-change="true"]').removeClass('active');
          $('#'+large).stop().show();
          $('#'+desc).stop().show();
          $(this).addClass('active');
          e.preventDefault();
      });
    };

    var slideBrand = function(){
        $('#slide-brand').owlCarousel({
            loop: true,
            margin: 75,
            responsiveClass: true,
            autoWidth: true,
            responsive:{
                0:{
                    items: 1,
                    nav: false,
                    dots: false
                },
                320:{
                    items: 2,
                    margin: 40,
                    nav: false,
                    dots: false
                },
                640:{
                    items: 4,
                    nav: false,
                    margin: 40,
                    dots: false
                },
                1000:{
                    items: 6,
                    nav: false,
                    dots: false
                }
            }
        });
    };

    var tabSliderSolution = function(){
        if(width_device > 767){
            $('[data-carousel="true"] .owl-item:eq(0) .item a').addClass('active');
            $('#box-solution .article .text .desc-1').stop().show();
            $('a[data-tab="true"]').click(function(e){
                e.preventDefault();
                var article = $(this).data('article');
                var desc = $(this).data('desc');
                $('#'+article+' .desc').stop().hide();
                $('#'+article+' .'+desc).stop().show();
                $('#'+article+' a[data-tab="true"]').removeClass('active');
                $(this).addClass('active');
            });
        }else{
            $('#box-solution .article .text .desc').removeAttr('style');
            $('#box-solution a[data-tab="true"]').removeClass('active');
        }
    };

    var sliderSolution = function(){
        $('[data-carousel="true"]').owlCarousel({
            loop: false,
            margin: 7,
            responsiveClass: true,
            responsive:{
                0:{
                    items: 1,
                    nav: true,
                    dots: false
                },
                320:{
                    items: 1,
                    margin: 0,
                    nav: true,
                    dots: false
                },
                640:{
                    items: 2,
                    nav: true,
                    margin: 40,
                    dots: false
                },
                768:{
                    items: 3,
                    nav: true,
                    dots: false
                },
                1000:{
                    items: 4,
                    nav: true,
                    dots: false,
                    mouseDrag: false
                },
                1200:{
                    items: 5,
                    nav: true,
                    dots: false,
                    mouseDrag: false,
                    touchDrag: false
                }
            }
        });
    };
    var sliderDetail = function(){
        try{
            if(width_device < 768){
                $('#slide-detail').owlCarousel({
                    loop: true,
                    margin: 0,
                    responsiveClass: true,
                    responsive:{
                        0:{
                            items: 1,
                            nav: true,
                            dots: false
                        },
                        640:{
                            items: 1,
                            nav: true,
                            dots: false
                        }
                    }
                });
            }
        }catch (e){

        }
    };
    var slideGallery = function(){
        try{
            if(width_device > 767){
                $('[data-gallery="product"]').bxSlider({
                    mode: 'vertical',
                    slideWidth: 52,
                    minSlides: 4,
                    pager: false,
                    slideMargin: 10
                });
            }
        }catch (e){

        }
    };

    var equalHeight = function(selector) {
        if(width_device > 767){
            minheight = 0;
            $(selector).each(function() {
                thisheight = $(this).height();
                if (thisheight > minheight) {
                    minheight = thisheight
                }
            });
            minheight = minheight + 2;
            $(selector).css("min-height", minheight)
        }else{
            $(selector).removeAttr('style');
        }
    };

    var changeGallery = function(){
        if(width_device > 767){
            $('[data-gallery="true"]').click(function(){
                var item = $(this).data('item');
                $("#slide-detail .item").stop().hide();
                $('#'+item).stop().show();
                $('[data-gallery="true"]').removeClass('active');
                $(this).addClass('active');
            });
        }
    };

    var controlProduct = function(){
        if(width_device > 767){
            $('[data-control="true"]').click(function(e){
                var id = $(this).data('id');
                $('[data-control="true"]').removeClass('active');
                $('.layout .col-right .group').removeClass('show');
                $(this).addClass('active');
                $('#'+id).addClass('show');
                e.preventDefault();
            });
        }else{
            $('[data-slide="true"]').click(function(){
                $('.layout .col-right .group').removeClass('show');
                $(this).parent('.group').addClass('show');
            });
        }
    };

    var fixedSlideHome = function(){
        try{
            var height_head = $('#header').height();
            var height_obj = $('#box-slide').height();
            var item = $('#box-slide').data('set');
            $('#'+item).css({height: height_obj});
            $('#box-slide').css({top: height_head, height: height_obj});
        }catch (e){

        }
    };

    var fixedScroll = function(obj){
        if(width_device > 767){
            try{
                var pos = $(obj).position();
                var fix = $('#'+$(obj).data('start')).position();
                var width_obj = $(obj).width();
                var height_obj = $(obj).height();
                var end = $('#'+$(obj).data('finish')).position().top - height_obj;
                var space = $('.header').height();
                if(!pos.left) pos.left = 0;
                $(window).scroll(function(){
                    if($(this).scrollTop() >= fix.top && end >= $(this).scrollTop()){
                        $(obj).addClass('fixed').css({top: space, left: pos.left, width: width_obj});
                    }else{
                        $(obj).removeClass('fixed').removeAttr('style');
                    }
                });
            }catch (e){

            }
        }
    };

    var expandFooter = function(){
        /*var status = 1;
        var hf = $('#footer').height();
        $('#footer .over').height(hf);
        $('#footer').height(0);
        var pos = $('#footer').position();*/
        $(window).scroll(function () {
            /*if ($(window).scrollTop() == ( $(document).height() - $(window).height())) {
                if(status == 1){
                    var wd = document.body.offsetHeight + hf;
                    $('#wrapper').animate({paddingBottom: hf}, 3000, 'easeInQuint');
                    //$('#footer .over').animate({height: 0}, 3000, 'easeInQuint');
                    status = 0;
                }
//                $("html, body").animate({scrollTop: wd}, 300, 'easeInQuint');
            }*/
        });
    };

    var scrollToItem = function(o, t, m) {
        if(width_device > 767){
            try{
                $(o).click(function(e){
                    var go = $(this).attr('href');
                    $(o).removeClass('active');
                    $(this).addClass('active');
                    $("html, body").animate({
                        scrollTop: $(go).offset().top - m
                    }, t);
                    e.preventDefault();
                });
            }catch (e){

            }
        }
    };

    var slideVilla = function(){
        $('#slide-villa').owlCarousel({
            loop: true,
            margin: 15,
            responsiveClass: true,
            center: true,
            responsive:{
                0:{
                    items: 1,
                    nav: true,
                    dots: false,
                    stagePadding: 0
                },
                640:{
                    items: 1,
                    nav: true,
                    dots: false,
                    startPosition: 1,
                    stagePadding: 50
                },
                1200:{
                    items: 1,
                    nav: true,
                    dots: false,
                    startPosition: 1,
                    stagePadding: 100
                }
            }
        });
    };

    var scrollWindow = function(){
        try{
            var mousewheelevt = (/Firefox/i.test(navigator.userAgent)) ? 'DOMMouseScroll' : 'mousewheel';
            var pos = $('[data-position="true"]').position().top;
            if($(window).scrollTop() < pos){
                $('body').removeClass('scroll-down').addClass('scroll-up');
            }else{
                $('body').removeClass('scroll-up').addClass('scroll-down');
            }
            $(window).bind(mousewheelevt, function(e){
                var evt = window.event || e ;
                evt = evt.originalEvent ? evt.originalEvent : evt;
                var delta = evt.detail ? evt.detail*(-40) : evt.wheelDelta ;
                if(delta > 0){
                    $('body').removeClass('scroll-down').addClass('scroll-up');
                }else{
                    if($(window).scrollTop() >= pos){
                        $('body').removeClass('scroll-up').addClass('scroll-down');
                    }
                }
            });
        }catch (e){

        }
    };

    var scrollControl = function(obj){
        $(obj).click(function(e){
            var href = $(this).attr('href');
            var offset = $(this).data('offset') ? parseInt($(this).data('offset')) : 0;
            var pos  = $(href).position().top;
            pos = pos - offset;
            $('html,body').animate({
                scrollTop: pos
            }, 2500,'easeInOutExpo');
            e.preventDefault();
        });
    };
    var styleFilter = function(){
        $('select.select').each(function(){
            var title = $(this).attr('title');
            if( $('option:selected', this).val() != '' ) title = $('option:selected',this).text();
            $(this)
                .css({'z-index':10,'opacity':0,'-khtml-appearance':'none'})
                .after('<span class="span"><span>' + title + '</span></span>')
                .change(function(){
                    val = $('option:selected',this).text();
                    $(this).next().html("<span>"+val+"</span>");
                })
        });
    };
    var styleGrid = function (obj, number) {
        try{
            if(width_device > 767){
                new AnimOnScroll( document.getElementById(obj),{
                    minDuration : 0.4,
                    maxDuration : 0.7,
                    viewportFactor : 0.2,
                    gutter: number
                });
            }
        }catch(e){

        }
    };
    var styleWow = function(){
        try{
            new WOW().init();
        }catch (e){

        }
    };
    /*Scrollbar Notify*/
  var scrollNotify = function(){
    try{
      var obj = $('#scrollNotify');
      obj.tinyscrollbar({
        trackSize : 187,
        thumbSize: 47
      });
    }catch (e){}
  };
    jQuery(document).ready(function() {
        changeSearch();
        slideHome();
        styleItemFix('#box-slide');
        styleItemFix('#box-banner');
        styleItemFix('#box-breadcrumb');
        styleItemFix('#header');
        fixedSlideHome();
        slideCup();
        slideNews();
        scrollNotify();
        slideFoot();
        slideGroup();
        slideApartment();
        slideActivity();
        slideVilla();
        slideBrand();
        styleFilter();
        setMenuMobile();
        resetMenuMobile();
        scrollControl('.btn-control');
        scrollControl('.btn-up');
        scrollControl('.btn-down');
        styleGrid('goods-data',4);
        styleGrid('article-data',4);
        sliderSolution();
        tabSliderSolution();
        fixedScroll('#nav-control');
        scrollToItem('[data-scroll="true"]',800,98);
        scrollWindow();
        changeElementObject();
        expandFooter();
        sliderDetail();
        $(window).on('resize',function () {
            fixedScroll('#nav-control');
            changeMenuMobile();
            tabSliderSolution();
            controlProduct();
            fixedSlideHome();
            styleItemFix('#box-slide');
            styleItemFix('#box-banner');
            styleItemFix('#header');
            equalHeight('#data-project .item');
            scrollWindow();
            sliderDetail();
        });
        styleWow();
        slideGallery();
        changeGallery();
        controlProduct();
        slideProject();
        closeSearch();
        equalHeight('#data-project .item');
    });
    window.addEventListener("orientationchange", function() {
        changeMenuMobile();
        tabSliderSolution();
        controlProduct();
        fixedSlideHome();
        scrollWindow();
        fixedScroll('#nav-control');
        equalHeight('#data-project .item');
        sliderDetail();
    }, false);
})(jQuery);