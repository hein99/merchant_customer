$(document).ready(function(){
  $(".order-form-js").validate({
    rules: {
      product_link: {
        required: true,
        url: true
      },
      quantity: {
        required: true,
        number: true
      },
      price: {
        required: true,
        number: true
      }
    }
  });

  var swiper = new Swiper('.swiper-container', {
      spaceBetween: 30,
      centeredSlides: true,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });

    $('.ky-accordion-header').on('click', function() {
      let $parentAccordion=$(this).parent();
      let content=this.nextElementSibling;
      $parentAccordion.find('.ky-accordion-header').toggleClass("ky-active-accordion-header");
      if(content.style.maxHeight){
        content.style.maxHeight = null;
      }else{
        content.style.maxHeight = content.scrollHeight + "px";
      }
    });

    $('.ky-membership-tab').eq(0).addClass('ky-active-tab-header');
    $('.ky-membership').eq(0).addClass('ky-active-tab-body');

    $('.ky-membership-tab').on('click', function() {
      let $index=$(this).index();
      $(this).siblings().removeClass('ky-active-tab-header');
      $(this).addClass('ky-active-tab-header');
      $('.ky-membership').eq($index).siblings().removeClass('ky-active-tab-body');
      $('.ky-membership').eq($index).addClass('ky-active-tab-body');
      $('.ky-membership-tab-indicator').css({"left" : `calc(calc(100% / 4) * ${$index})`});
    });
});
