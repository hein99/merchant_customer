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
        var msg_count = $('#messages_count').text();
        if(msg_count != data){
          $('#messages_count').html(data);
          $('.sound').html('<audio controls autoplay id="chatAudio"><source src="'+PAGE_FILE_URL+'/logos/you-wouldnt-believe.ogg" type="audio/ogg"></audio>');
        }
      }
    })
  }

  $(document).on('click', '.wp-header-menu', function(){
    $('.wp-other-page-nav-container, #wp-other-page-sidebar-back, .wp-other-page-nav').addClass('slide');
  });

  $(document).on('click', '#wp-close-nav, #wp-other-page-sidebar-back', function(){
    $('.wp-other-page-nav-container, #wp-other-page-sidebar-back, .wp-other-page-nav').removeClass('slide');
  });

  $(document).on('click', '#new-order', function(){
    $('.wp-new-order-container, .wp-new-order-back, .wp-new-order, .wp-header-user-name, .wp-customer-details, .wp-information-detail-container, .wp-exchange-rate-container, .wp-contact-admin-container').addClass('blur');
  });

  $(document).on('click', '.wp-new-order-back, #new-order-close', function(){
    $('.wp-new-order-container, .wp-new-order-back, .wp-new-order, .wp-header-user-name, .wp-customer-details, .wp-information-detail-container, .wp-exchange-rate-container, .wp-contact-admin-container').removeClass('blur');
  });

  $(document).on('focus', '.new-order-input input, .new-order-textarea textarea', function(){
    $(this).addClass('focus');
    $(this).parent().find('i').addClass('focus');
  });

  if ($(window).width() < 480) {
    $(document).on('blur', '.new-order-input input, .new-order-textarea textarea', function(){
      if($(this).val() == "")
        $(this).removeClass('focus');
    });
  }else{
    $(document).on('blur', '.new-order-input input, .new-order-textarea textarea', function(){
      $(this).removeClass('focus');
      $(this).parent().find('i').removeClass('focus');
    });
  }
});
