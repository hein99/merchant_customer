<?php
date_default_timezone_set('Asia/Yangon');
require('./views/conversation/general.php');
switch($action)
{
  case '':
  case 'display':
    require('./views/conversation/display.php');
    break;

  default:
    $ERR_STATUS = ERR_ACTION;
    require('./views/error_display.php');
    exit();
}

 ?>
