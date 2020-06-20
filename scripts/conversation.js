window.onbeforeunload = function(event) {
  var is_type = 'no';
  $.ajax({
    url: PAGE_URL+'/conversation/change_typing_by_id',
    method: "POST",
    data: {is_type:is_type, to_whom_id:ADMIN_ID}
  })
};

$(document).ready(function(){
  var to_user_id = ADMIN_ID;
  var to_user_name = "The Best Shop";
  get_chat_history(to_user_id, to_user_name);
  getAdminActive();
  getAdminTyping();

  setInterval(function(){
    getAdminActive();
    getAdminTyping();
  }, 3000);

  $(document).on('click', '.upload_image_logo', function(){
    $('#uploadForm').css('display', 'block');
  });

  $(document).on('click', '#btn_send, #cancel_send', function(){
    $('#uploadForm').css('display', 'none');
  });

  $(document).on('change', '#uploadFile', function(e){
    var reader = new FileReader();
    reader.onload = function(e) {
    document.getElementById("preview").src = e.target.result;
    };
    reader.readAsDataURL(this.files[0]);
  });

  $(document).on('focus', '.chat_message', function(){
    var is_type = 'yes';
    $.ajax({
      url: PAGE_URL+'/conversation/change_typing_by_id',
      method: "POST",
      data: {is_type:is_type, to_whom_id:ADMIN_ID}
    })
  });

  $(document).on('blur', '.chat_message', function(){
    var is_type = 'no';
    $.ajax({
      url: PAGE_URL+'/conversation/change_typing_by_id',
      method: "POST",
      data: {is_type:is_type, to_whom_id:ADMIN_ID}
    })
  });

  $(document).on('click', '.send_chat', function(){
    var to_user_id = $(this).attr('id');
    var message  = $.trim($('#chat_message_'+to_user_id).val());
    if(message != '')
    {
      $.ajax({
        url: PAGE_URL+'/conversation/send_message',
        method: "POST",
        data: {to_user_id:to_user_id, messages:message},
        success: function(msg){
          var element = $('#chat_message_'+to_user_id).emojioneArea();
          element[0].emojioneArea.setText('');
        }
      })
    }else{
      alert('Type something');
    }
  });

  $(document).on('click', '#btn_send', function(){
    var formElem = document.querySelector("#uploadForm");
    var formData = new FormData(formElem)

    $.ajax({
      method:"POST",
      url: PAGE_URL+'/conversation/send_photo',
      data: formData,
      contentType: false,
      processData: false
    });
  });

  function get_chat_history(to_user_id, to_user_name)
  {
    $.ajax({
      url: PAGE_URL+'/conversation/get_all_messages/'+to_user_id,
      method: "GET",
      success: function(returnMessages){
        makeChatBox(to_user_id, to_user_name);
        var output = '';
        for(message of returnMessages){
          var user_name = '';
          var chat_style = '';
          var time_style = '';
          var message_list = '';
          if(message.from_user_id == CUSTOMER_ID)
          {
            message_list = message.messages;
            user_name = '<b class="from_user">You</b>';
            chat_style = 'from_user_chat_style';
            time_style = 'from_user_time_style';
          }else{
            message_list = message.messages;
            user_name = '<b class="to_user">'+to_user_name+'</b>';
            chat_style = 'to_user_chat_style';
            time_style = 'to_user_time_style';
          }
          output += '<li><div class="chat_list"><div class="'+chat_style+'"><p>'+user_name+' - '+message_list+'</p></div><div class="'+time_style+'"><small><em>'+message.arrived_time+'</em></small></div></div></li>';
        }
        $(output).appendTo("#chat_history_"+to_user_id+" ul");
      },
        dataType: 'json'
      }).done(function(){
        var element = document.getElementsByClassName("chat_history")[0];
        element.scrollTo(0,element.scrollHeight);

        $('#chat_message_'+to_user_id).emojioneArea({
          pickerPosition:"top",
          toneStyle: "bullet"
        });

        setInterval(function(){
          get_new_message(to_user_id, to_user_name);
        }, 2000);

      });
  }

  function makeChatBox(to_user_id, to_user_name)
  {
    var content = '<div id="user_dialog_'+to_user_id+'" class="user_dialog" title="You have chat with '+to_user_name+'">';
    content += '<h4>You have chat with <span id="chatting-name">'+to_user_name;
    content += '</span><span id="admin_active"></span><span id="admin_typing"></span></h4><div class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'"><ul>';
    content += '</ul></div>';
    content += '<div class="wp-conversation-message-container">';
    content += '<label id="wp-send-photo" for="uploadFile"><img src="'+PAGE_FILE_URL+'/logos/photo.png" class="upload_image_logo"/></label><textarea name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="chat_message"></textarea>';
    content += '<form id="uploadForm" action="" method="post" enctype="multipart/form-data"><img src="'+PAGE_FILE_URL+'/logos/image-preview.png" id="preview" class="img-thumbnail">';
    content += '<input type="hidden" name="to_user_id" placeholder="To User ID" value="'+to_user_id+'"><br>';
    content += '<input type="file" name="photo" id="uploadFile" accept="image/*" />';
    content += '<div id="send_photo_button_container"><input type="button" value="Send Photo" name="send_photo" id="btn_send" /><input type="button" value="Cancel" name="cancel_photo" id="cancel_send" /></div></form>';
    content += '<button type="button" name="send_chat" id="'+to_user_id+'" class="send_chat">Send</button></div></div>';

    $('#user_model_details').html(content);
  }

  function get_new_message(to_user_id, to_user_name)
  {
    $.ajax({
      url: PAGE_URL+'/conversation/get_new_messages/'+to_user_id,
      method: "GET",
      success: function(returnMessages){
        if(returnMessages != '')
        {
          var output = '';
          for(message of returnMessages){
            var user_name = '';
            var chat_style = '';
            var time_style = '';
            var message_list = '';
            if(message.from_user_id == CUSTOMER_ID)
            {
              message_list = message.messages;
              user_name = '<b class="from_user">You</b>';
              chat_style = 'from_user_chat_style';
              time_style = 'from_user_time_style';
            }else{
              message_list = message.messages;
              user_name = '<b class="to_user">'+to_user_name+'</b>';
              chat_style = 'to_user_chat_style';
              time_style = 'to_user_time_style';
            }
            output += '<li><div class="wp-chat-message"><div class="'+chat_style+'"><p>'+user_name+' - '+message_list+'</p></div><div class="'+time_style+'"><small><em>'+message.arrived_time+'</em></small></div></div></li>';
          }
          $(output).appendTo("#chat_history_"+to_user_id+" ul");
          $(".chat_history").stop().animate({ scrollTop: $(".chat_history")[0].scrollHeight}, 1000);
        }
      },
        dataType: 'json'
      })
  }

  function getAdminActive()
  {
    $.ajax({
      method:"GET",
      url: PAGE_URL+'/conversation/get_admin_active',
      success: function(returnActive){
        if(returnActive == 'true')
          $('#admin_active').addClass('active_now');
        else {
          $('#admin_active').removeClass('active_now');
        }
      }
    });
  }
  function getAdminTyping()
  {
    $.ajax({
      method:"GET",
      url: PAGE_URL+'/conversation/get_admin_typing',
      success: function(returnTyping)
      {
        if(returnTyping == 'true')
          $('#admin_typing').html("Typing...");
        else
          $('#admin_typing').html("");
      }
    });
  }
});
