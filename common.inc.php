<?php
require('./config.php');
require('./models/DataObject.class.php');
require('./models/UsersAccount.class.php');
require('./htmlstructureconfig.php');
session_start();

$controller = $_GET['controller'];
$action = isset($_GET['action']) ? $_GET['action'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';

function checkAuthentication()
{
  if(!isset($_SESSION['merchant_customer_account']) or !$_SESSION['merchant_customer_account'] or !$_SESSION['merchant_customer_account']->getValueEncoded('id') or !$_SESSION['merchant_customer_account'] = UsersAccount::getCustomerAccountById($_SESSION['merchant_customer_account']->getValue('id')))
  {
    $_SESSION['merchant_customer_account'] = '';
    header('location: '.FILE_URL. '/views/login.php');
    exit();
  }
}

checkAuthentication();
#Loading model
switch ($controller)
{
  case 'home':
    require('./models/ExchangeRate.class.php');
    break;

  case 'customer':

    break;

  case 'order':
    require('./models/CustomerStatement.class.php');
    require('./models/ExchangeRate.class.php');
    require('./models/CustomerOrder.class.php');
    break;

  case 'statement':
    require('./models/CustomerStatement.class.php');
    break;

  case 'conversation':
  require('./models/MessageRecord.class.php');
  require('./models/LoginRecord.class.php');
    break;

  case 'settings':

    break;

  default:
    $ERR_STATUS = ERR_CONTROLLER;
    require('./views/error_display.php');
    exit();
}

#Loading controller
  $controller = "./controllers/${controller}.php";
  if(file_exists($controller) and !is_dir($controller))
    require($controller);
  else
    exit("models -> ${controller} not found");
 ?>
