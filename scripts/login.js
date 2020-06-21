$(document).ready(function(){
  $('.forgot_password_button').on('click', function(){
    $('#display-login').animate({height: "toggle", opacity: "toggle"}, "slow");
    $('#display-forget-password').animate({height: "toggle", opacity: "toggle"}, "slow");
  });

  $('.back_to_login').on('click', function(){
    $('#display-login').animate({height: "toggle", opacity: "toggle"}, "slow");
    $('#display-forget-password').animate({height: "toggle", opacity: "toggle"}, "slow");
  });

  $( ".input" ).focusin(function() {
    $(this).addClass("focus");
    $(this).find( "span" ).animate({"opacity":"0"}, 200);
  });

  $( ".input" ).focusout(function() {
    $(this).removeClass("focus");
    $(this).find( "span" ).animate({"opacity":"1"}, 200);
  });

});
