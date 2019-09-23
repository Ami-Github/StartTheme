jQuery(document).ready(function($) {

  start();

  function start() {
    if (isHome()) {

    }
    dropDownMenu();
    toogleMenu();
    showPhoneNo();
  }

  $(window).resize(function() {

  });

  function isHome() {
    if ($('body').hasClass('home')) return true;
  }


  AOS.init({
    duration: 1000
  });


  function SVGinject() {
    var mySVGsToInject = $('img.inject-me');
    SVGInjector(mySVGsToInject);
  }


  function dropDownMenu() {
    var $hasChildrenAnchore = $('.main-nav .menu-menu-1-container .menu > li.menu-item-has-children > a');
    var $hasChildren = $('.main-nav .menu-menu-1-container .menu > li.menu-item-has-children');
    var $subMenu = $('.main-nav .menu-menu-1-container .menu li .sub-menu');

    if ($('.hamburger').is(":hidden")) {
      $hasChildren.mouseleave(function() {
        $(this).removeClass('active');
        $subMenu.hide(300);
      });

      $hasChildrenAnchore.mouseenter(function() {
        $(this).parent().toggleClass('active');
        $(this).parent().siblings().find('.sub-menu').hide(300);
        $(this).parent().find('.sub-menu').toggle(300);
      });

    } else {
      $hasChildrenAnchore.on('click', function(e) {
        e.preventDefault()
        $(this).parent().toggleClass('active');
        $(this).parent().siblings().find('.sub-menu').hide(300);
        $(this).parent().find('.sub-menu').toggle(300);
      });
    }
  }



  function toogleMenu() {
    var $hamburger = $('.main-nav .hamburger');
    var $menu = $('.menu-menu-1-container .menu');

    $hamburger.on('click', function() {
      $(this).toggleClass('is-active');
      $menu.toggleClass('show-menu');
    });
  }


  function showPhoneNo() {
    var $hiddenNo = $('.hidden-no');

    $hiddenNo.on('click', function(e) {
      e.preventDefault();

      $(this).removeClass('d-sm-flex d-sm-block d-sm-inline d-sm-inline-block d-sm-inline-flexbox');
      $(this).siblings('.visible-no').removeClass('d-sm-none');
    });
  }

  function smoothScroll() {
    $('a[href^="#"]').on('click', function(e) {
      e.preventDefault()

      $('html, body').animate({
          scrollTop: $($(this).attr('href')).offset().top - 65,
        },
        500,
        'linear'
      )
    })
  }



  // function frontOwls() {

  // var $siteUrl = okData.site_url;

  //    $("#owl-main-banner").owlCarousel({
  //      nav: true,
  //      navText: ['<img src="' + $siteUrl + '/wp-content/themes/Identique/img/arrow-left.png">', '<img src="' + $siteUrl + '/wp-content/themes/Identique/img/arrow-right.png">'],
  //       slideSpeed : 300,
  //       paginationSpeed : 400,
  //       items : 1,
  //       loop: true,
  //       dots: false,
  //       autoplay: true,
  //       smartSpeed: 500,
  //       animateIn: 'fadeIn',
  //       animateOut: 'fadeOut',
  //       autoplayTimeout: 5000,
  //    });
  // }
  //
  // function pagesOwls() {
  //
  //    $("#owl-partners-logos").owlCarousel({
  //       slideSpeed : 300,
  //       paginationSpeed : 400,
  //       items : 5,
  //       loop: true,
  //       dots: false,
  //       autoplay: true,
  //       smartSpeed: 500,
  //       autoplayTimeout: 3600,
  //       responsive : {
  //          0 : {
  //             items : 2,
  //          },
  //          576 : {
  //             items: 3
  //          },
  //          768 : {
  //             items: 4
  //          },
  //          992 : {
  //             items : 5,
  //          }
  //       }
  //    });
  // }

});
