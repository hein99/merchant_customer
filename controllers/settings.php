<?php
switch($action)
{
  case '':
  case 'display':
    require('./views/settings/display.php');
  break;
  case 'change_info':
    changeCustomerInfo();
    break;
  case 'change_password':
    changeCustomerPassword();
    break;
  case 'logout':
    logout();
    break;
  default:
    $ERR_STATUS = ERR_ACTION;
    require('./views/error_display.php');
    exit();
}

function changeCustomerInfo(){
  $required_fields = array('username', 'phone', 'address');
  $missing_fields = array();
  $error_messages = array();

  $customer_info = new UsersAccount(array(
    'id' => isset($_POST['id']) ? preg_replace('/[^0-9]/', '', $_POST['id']) : '',
    'username' => isset($_POST['username']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['username']) : '',
    'phone' => isset($_POST['phone']) ? preg_replace('/[^0-9]/', '', $_POST['phone']) : '',
    'address' => isset($_POST['address']) ? preg_replace('/[^ \,\-\_a-zA-Z0-9]/', '', $_POST['address']) : ''
  ));
  foreach($required_fields as $required_field)
  {
    if(!$customer_info->getValue($required_field))
      $missing_fields[] = $required_field;
  }
  if($missing_fields)
  {
    $error_messages[] = 'There were some missing fields!';
  }
  if(UsersAccount::getPhoneNumberCheck($customer_info->getValue('phone'), $customer_info->getValue('id')))
  {
    $error_messages[] = 'A member with that phone number already exists in the database. Please choose an another phone number.';
  }
  if($error_messages)
  {
    $ERR_STATUS = ERR_FORM;
    require('./views/error_display.php');
  }else{
    $customer_info->editCustomerInfo();
    header('location: '. URL . '/settings/');
  }
}
function changeCustomerPassword(){
  $request_account = new UsersAccount(array(
    'phone' => isset($_POST['phone']) ? preg_replace('/[^0-9]/', '', $_POST['phone']) : '',
    'password' => isset($_POST['current_password']) ? $_POST['current_password']: ''
  ));
  $current_account = $request_account->authenticateCustomerAccount();
  if($current_account)
  {
    $required_fields = array('password');
    $missing_fields = array();
    $error_messages = array();

    $change_password = new UsersAccount(array(
      'password' => ( isset($_POST['new_password1']) and isset($_POST['new_password2']) and $_POST['new_password1'] == $_POST['new_password2']) ? $_POST['new_password1'] : ''
    ));
    foreach($required_fields as $required_field)
    {
      if(!$change_password->getValue($required_field))
        $missing_fields[] = $required_field;
    }
    if($missing_fields)
    {
      $error_messages[] = 'There were some missing fields!.';
    }
    if(!isset($_POST['new_password1']) or !isset($_POST['new_password2']) or !$_POST['new_password1'] or !$_POST['new_password2'] or $_POST['new_password1'] != $_POST['new_password2'])
    {
      $error_messages[] = 'Make sure you enter your password correctly in both password fields';
    }
    if($error_messages)
    {
      $ERR_STATUS = ERR_FORM;
      require('./views/error_display.php');
    }
    else {
      $change_password->updateCustomerAccount($current_account->getValue('id'));
      logout();
    }
  }else{
    $error_messages = array();
    $error_messages[] = 'Retype your current password.';
    $ERR_STATUS = ERR_FORM;
    require('./views/error_display.php');
  }
}
function logout()
{
  $_SESSION['merchant_customer_account'] = '';
  header('location: '. FILE_URL . '/views/login.php');
}
 ?>
