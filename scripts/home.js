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
});
