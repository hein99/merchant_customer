$(document).ready(function(){
  $(document).on('click', '#sn_change_information', function(){
    $('.sn_change_info_form').show();
    $('.sn_change_password_form').hide();
  });
  $(document).on('click', '#sn_change_password', function(){
    $('.sn_change_password_form').show();
    $('.sn_change_info_form').hide();
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
