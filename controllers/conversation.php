<?php
date_default_timezone_set('Asia/Yangon');
switch($action)
{
  case '':
  case 'display':
    require('./views/conversation/display.php');
    break;
  case 'get_new_messages_count':
    getNewMessagesCount();
    break;
  case 'get_admin_active':
    getAdminActive();
    break;
  case 'get_admin_typing':
    getAdminTyping();
    break;
  case 'get_all_messages':
    getAllMessages($id);
    break;
  case 'get_new_messages':
    getNewMessages($id);
    break;
  case 'change_typing_by_id':
    changeTypingById();
    break;
  case 'update_activity_time':
    updateActivityTime();
    break;
  case 'send_message':
    sendMessage();
    break;
  case 'send_photo':
    sendPhoto();
    break;

  default:
    $ERR_STATUS = ERR_ACTION;
    require('./views/error_display.php');
    exit();
}

function getNewMessagesCount()
{
  $total = MessageRecord::getNewMessagesCount($_SESSION['merchant_customer_account']->getValue('id'));
  echo $total;
}
function getAdminTyping()
{
  $login_record = LoginRecord::getIsType($_SESSION['merchant_customer_account']->getValue('id'));
  if($login_record)
    echo "true";
  else
    echo "false";
}
function getAdminActive()
{
  $login_record = LoginRecord::getUsersActiveActivity($_SESSION['merchant_customer_account']->getValue('id'));
  if(checkActiveNow($login_record->getValue('active_activity')))
    echo "true";
  else
    echo "false";
}
function getAllMessages($id)
{
  if($id)
  {
    $messages = MessageRecord::getAllMessage($_SESSION['merchant_customer_account']->getValue('id'), $id);
    MessageRecord::updateMessageStatus($_SESSION['merchant_customer_account']->getValue('id'), $id);
    $returnMessages = array();
    foreach($messages as $message)
    {
      $mss = '';
      if($message->getValue('is_image') == 'yes')
        if($message->getValue('from_user_id') == $_SESSION['merchant_customer_account']->getValue('id'))
          $mss = '<img src="'.FILE_URL.'/photos/conversation/'.$message->getValue('messages').'" alt="Photo Downloading" class="display-photo">';
        else
          $mss = '<img src="'.OTHER_FILE_URL.'/photos/conversation/'.$message->getValue('messages').'" alt="Photo Downloading" class="display-photo">';
      else
        $mss = $message->getValue('messages');
      $returnMessages[] = array(
        'from_user_id' => $message->getValue('from_user_id'),
        'to_user_id' => $message->getValue('to_user_id'),
        'message_status' => $message->getValue('is_image'),
        'messages' => $mss,
        'arrived_time' => $message->getValue('arrived_time')
      );
    }
    echo json_encode($returnMessages);
  }
}
function getNewMessages($id)
{
  if($id)
  {
    $messages = MessageRecord::getNewMessage($_SESSION['merchant_customer_account']->getValue('id'), $id);
    MessageRecord::updateMessageStatus($_SESSION['merchant_customer_account']->getValue('id'), $id);
    $returnMessages = array();
    foreach ($messages as $message)
    {
      $mss = '';
      if($message->getValue('is_image') == 'yes')
        if($message->getValue('from_user_id') == $_SESSION['merchant_customer_account']->getValue('id'))
          $mss = '<img src="'.FILE_URL.'/photos/conversation/'.$message->getValue('messages').'" alt="Photo Downloading" class="display-photo">';
        else
          $mss = '<img src="'.OTHER_FILE_URL.'/photos/conversation/'.$message->getValue('messages').'" alt="Photo Downloading" class="display-photo">';
      else
        $mss = $message->getValue('messages');

      $returnMessages[] = array(
        'from_user_id' => $message->getValue('from_user_id'),
        'to_user_id' => $message->getValue('to_user_id'),
        'message_status' => $message->getValue('is_image'),
        'messages' => $mss,
        'arrived_time' => $message->getValue('arrived_time')
      );
    }
    echo json_encode($returnMessages);
  }
}
function changeTypingById()
{
  $required_fields = array('user_id', 'is_type', 'to_whom_id');
  $missing_fields = array();
  $error_messages = array();

  $login_record = new LoginRecord(array(
    'user_id' => $_SESSION['merchant_customer_account']->getValue('id'),
    'is_type' => isset($_POST['is_type']) ? preg_replace('/[^.\ \-\_a-zA-Z0-9]/', '', $_POST['is_type']) : '',
    'to_whom_id' => isset($_POST['to_whom_id']) ? preg_replace('/[^.\ \-\_a-zA-Z0-9]/', '', $_POST['to_whom_id']) : ''
  ));

  foreach($required_fields as $required_field)
  {
    if($login_record->getValue($required_field) == '' )
      $missing_fields[] = $required_field;
  }

  if($missing_fields)
  {
    $error_messages[] = 'Please fill all required field';
  }

  if($error_messages)
  {
    $ERR_STATUS = ERR_FORM;
    require('./views/error_display.php');
  }
  else
  {
    $login_record->updateIsType();
  }
}
function updateActivityTime()
{
  LoginRecord::updateUsersActiveActivity($_SESSION['merchant_customer_account']->getValue('id'));
}
function sendMessage()
{
  $required_fields = array('to_user_id', 'from_user_id', 'messages');
  $missing_fields = array();
  $error_messages = array();

  $message = new MessageRecord(array(
    'to_user_id' => isset($_POST['to_user_id']) ? preg_replace('/[^0-9]/', '', $_POST['to_user_id']) : '',
    'from_user_id' => $_SESSION['merchant_customer_account']->getValue('id'),
    'messages' => isset($_POST['messages']) ? $_POST['messages'] : '',
    'is_image' => 'no'
  ));
  foreach($required_fields as $required_field)
  {
    if($message->getValue($required_field) == '' )
      $missing_fields[] = $required_field;
  }
  if($missing_fields)
  {
    $error_messages[] = 'Please fill all required field';
  }

  if($error_messages)
  {
    $ERR_STATUS = ERR_FORM;
    require('./views/error_display.php');
  }
  else
  {
    $message->addMessage();
  }
}
function sendPhoto()
{
  $required_fields = array('to_user_id',);
  $missing_fields = array();
  $error_messages = array();

  $message = new MessageRecord(array(
    'to_user_id' => isset($_POST['to_user_id']) ? preg_replace('/[^0-9]/', '', $_POST['to_user_id']) : '',
    'from_user_id' => $_SESSION['merchant_customer_account']->getValue('id'),
    'messages' => 'not message',
    'is_image' => 'yes'
  ));
  foreach($required_fields as $required_field)
  {
    if($message->getValue($required_field) == '' )
      $missing_fields[] = $required_field;
  }
  if($missing_fields)
  {
    $error_messages[] = 'Please fill all required field';
  }

  if($error_messages)
  {
    $ERR_STATUS = ERR_FORM;
    require('./views/error_display.php');
  }
  else
  {
    switch ($_FILES['photo']['type']) {
      case 'image/gif':
        savePhoto($message, 'gif');
        break;

      case 'image/jpeg':
        savePhoto($message, 'jpeg');
        break;

      case 'image/png':
        savePhoto($message, 'png');
        break;

      default:
        exit();
        break;
    }
  }
}
function checkActiveNow($active_activity)
{
  $diff_time = strtotime('now') - strtotime($active_activity);
  if($diff_time > 0 && $diff_time < 60)
    return true;
  else
    return false;
}
function savePhoto($message, $img_type)
{
  $message_id = $message->addMessage();
  $tmp = $_FILES['photo']['tmp_name'];
  $photo_name = 'user_' . $message->getValue('to_user_id') . '_img_mss_' . $message_id . '.' .$img_type;
  move_uploaded_file($tmp, './photos/conversation/' . $photo_name);
  $update_message = new MessageRecord(array(
    'id' => $message_id,
    'messages' => $photo_name
  ));
  $update_message->updatePhotoName();
}
 ?>
