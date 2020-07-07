var is_request = true; //for update order noti
var is_confirm = false; //for confirmation dialog box
$(window).on('load', function() {
  $(".ssn_loader").fadeOut("slow");
});
$(document).ready(function(){

  getNewMessagesCount();
  if(is_request)
    getUpdateOrderNoti();

  setInterval(function(){
    update_last_activity();
    getNewMessagesCount();
    if(is_request)
      getUpdateOrderNoti();
  }, 3000);

  function getUpdateOrderNoti()
  {
    $.ajax({
      url: PAGE_URL+'/order/get_order_noti',
      method:"GET",
      success: function(data){
        if(data == 'true'){
          is_request = false;
          $('.hk-nav-noti').show();
        }
      },
      dataType: 'json'
    })
  }

  function update_last_activity()
  {
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
        if(data == 0){
          $('#messages_count').html(data);
          $('.msg_count').html(data);
        }
        else if(msg_count != data){
          $('#messages_count').html(data);
          $('.msg_count').html(data);
          $('.sound').html('<audio controls autoplay id="chatAudio"><source src="'+PAGE_FILE_URL+'/logos/you-wouldnt-believe.ogg" type="audio/ogg"><source src="'+PAGE_FILE_URL+'/logos/you-wouldnt-believe.mp3" type="audio/mpeg"><source src="'+PAGE_FILE_URL+'/logos/you-wouldnt-believe.m4r" type="audio/mpeg"></audio>');
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
      $(this).removeClass('focus');
      if($(this).val() == ""){
        $(this).removeClass('focus');
      }else{
        $(this).addClass('focus');
      }
    });
  }else{
    $(document).on('blur', '.new-order-input input, .new-order-textarea textarea', function(){
      $(this).removeClass('focus');
      $(this).parent().find('i').removeClass('focus');
    });
  }
});

function buildDialogConfirmBox(msg)
{
  var markup = '';
  markup += '<article class="hk-dialog-box-wrap">';
  markup += '<session class="hk-dialog-box-content">';
  markup += '<header>';
  markup += '<img src="' + PAGE_FILE_URL + '/logos/globe-solid.png">';
  markup += '<h1>The Best Shop</h1>';
  markup += '</header>';
  markup += '<p>';
  markup += msg;
  markup += '</p>';
  markup += '<div class="hk-dialog-box-btn-gp"></div>';
  markup += '</session>';
  markup += '</article>';
  return markup;
}
function tbsConfirmBox(triggerBtn, msg)
{
  $('body').prepend(buildDialogConfirmBox(msg));
  var cancelBtn = $('<button>').html('No').click(function(){
    $('.hk-dialog-box-wrap').remove();
    is_confirm = false;
  });
  var confrimBtn= $('<button>').html('Yes').click(function(){
    $('.hk-dialog-box-wrap').remove();
    is_confirm = true;
    triggerBtn.trigger("click");
  });
  cancelBtn.appendTo('.hk-dialog-box-btn-gp');
  confrimBtn.appendTo('.hk-dialog-box-btn-gp');
}

function tbsAlertBox(msg)
{
  $('body').prepend(buildDialogConfirmBox(msg));
  var okBtn = $('<button>').html('Ok').click(function(){
    $('.hk-dialog-box-wrap').remove();
  });
  okBtn.appendTo('.hk-dialog-box-btn-gp');
}
