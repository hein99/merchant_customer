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
 ?>
