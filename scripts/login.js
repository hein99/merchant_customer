$(document).ready(function(){
  $(document).on('click', '.forgot_password_button', function(){
    $('.forget_password_form').show();
  });

  // $(document).on('click', '#send_number_request', function(){
  //   var phone = $('.phone_number').val();
  //   $.ajax({
  //     url: PAGE_URL+'/customer/password_request',
  //     method: "POST",
  //     data: {phone: phone},
  //     success:function(){
  //       var text = "Sent Successfully!Admin will send you a new password in one week";
  //       $('.forget_password_form').html(text);
  //       $('.forget_password_form').show();
  //     }
  //   })
  // });
});
