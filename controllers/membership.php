<?php
switch($action)
{
  case '':
  case 'display':
    $memberships = Membership::getAllMembership();
    require('./views/membership/display.php');
    break;

  default:
    $ERR_STATUS = ERR_ACTION;
    require('./views/error_display.php');
    exit();
}

 ?>
