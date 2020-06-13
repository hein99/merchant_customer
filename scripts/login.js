$(document).ready(function(){
  $(document).on('click', '.forgot_password_button', function(){
    $('.forget_password_form').show();
  });

  $(document).on('click', '#send_number_request', function(){
    var phone = $('.phone_number').val();
    if(phone == ''){
      $('.error_message').html("Please Enter Your Phone Number!");
    }else{
      $.ajax({
        url: PAGE_URL+'/customer/password_request',
        method: "POST",
        data: {phone: phone},
        success:function(text){
          var msg = '';
          if(text == 'no'){
            msg = 'Sorry!!!You do not have any Account with this Phone Number.';
            $('.error_message').html(msg);
          }else{
            msg = 'Sent Successfully!Admin will send you a new password in one week.';
            $('.forget_password_form').html(msg);
          }
        }
      })
    }
  });
});
