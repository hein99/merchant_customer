<?php
switch($action)
{
  case '':
  case 'display':
  require('./views/home/display.php');
  break;

  default:
    $ERR_STATUS = ERR_ACTION;
    require('./views/error_display.php');
    exit();

}
 ?>
