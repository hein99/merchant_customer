<?php
switch($action)
{
  case '':
  case 'display':
    require('./views/customer/display.php');
    break;
  case 'password_request':
    passwordRequest();
    break;
  default:
    $ERR_STATUS = ERR_ACTION;
    require('./views/error_display.php');
    exit();

}
function passwordRequest()
{
  $required_fields = array('phone');
  $missing_fields = array();
  $error_messages = array();

  $password_request = new PasswordRequest(array(
    'phone' => isset($_POST['phone']) ? preg_replace('/[^-\_a-zA-Z0-9]/', '', $_POST['phone']) : '',
  ));
  foreach($required_fields as $required_field)
  {
    if(!$password_request->getValue($required_field))
      $missing_fields[] = $required_field;
  }
  if($missing_fields)
  {
    $error_messages[] = 'There were some missing fields!';
  }
  if(!UsersAccount::getCustomerAccountByPhoneNumber($password_request->getValue('phone')))
  {
    $error_messages[] = 'Sorry!!!You do not have any Account with this Phone Number.';
  }
  if($error_messages)
  {
    $ERR_STATUS = ERR_FORM;
    require('./views/error_display.php');
  }
  else {
    $password_request->addPasswordRequest();
    header('location: '.URL. '/views/login.php');
  }
}
 ?>
