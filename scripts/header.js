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

});
