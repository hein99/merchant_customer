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


});
