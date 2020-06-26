var media = window.matchMedia("(min-width: 30em)");
myFunction(media);
media.addListener(myFunction);

function myFunction(media) {
  if (media.matches) {
    $('.sn_change_info_form').css('display','inline-block');
    $('.sn_change_password_form').css('display','inline-block');
  }else {
    $('.sn_change_info_form').css('display','block');
    $('.sn_change_password_form').css('display','none');
  }
}
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
