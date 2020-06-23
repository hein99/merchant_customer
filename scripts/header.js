$(window).on('load', function() {
  $(".ssn_loader").fadeOut("slow");;
});

$(document).ready(function(){

  getNewMessagesCount();

  setInterval(function(){
    update_last_activity();
    getNewMessagesCount();
  }, 3000);

  function update_last_activity(){
    $.ajax({
      url: PAGE_URL+'/conversation/update_activity_time',
      success: function(){

      }
    })
  }

  function getNewMessagesCount()
  {
    $.ajax({
      url: PAGE_URL+'/conversation/get_new_messages_count',
      method:"POST",
      success:function(data){
        $('#messages_count').html(data);
      }
    })
  }

  $(document).on('click', '.wp-header-menu', function(){
    $('.wp-other-page-nav, .wp-other-page-header, .wp-other-page-nav, .wp-other-page-sidebar, .wp-close-nav').addClass('down');
  });

  $(document).on('click', '.wp-close-nav', function(){
    $('.wp-other-page-nav, .wp-other-page-header, .wp-other-page-nav, .wp-other-page-sidebar, .wp-close-nav').removeClass('down');
  });

});
