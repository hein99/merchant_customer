<?php
switch($action)
{
  case '':
  case 'display':
    require('./views/order/display.php');
    break;

  case 'add_new_order':
    addNewOrder();
    break;

  case 'get_orders_list':
    getOrdersList();
    break;

  case 'get_order_voucher':

    break;
  default:
    $ERR_STATUS = ERR_ACTION;
    require('./views/error_display.php');
    exit();
}

function addNewOrder()
{
  $required_fields = array('customer_id', 'product_link', 'remark', 'quantity', 'price', 'first_exchange_rate');
  $missing_fields = array();
  $error_messages = array();

  $add_new_order = new CustomerOrder(array(
    'customer_id' => isset($_POST['customer_id']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['customer_id']) : '',
    'product_link' => isset($_POST['product_link']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['product_link']) : '',
    'remark' => isset($_POST['remark']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['remark']) : '',
    'cupon_code' => isset($_POST['cupon_code']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['cupon_code']) : '',
    'quantity' => isset($_POST['quantity']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['quantity']) : '',
    'price' => isset($_POST['price']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['price']) : '',
    'first_exchange_rate' => isset($_POST['exchange_rate']) ? preg_replace('/[^.\0-9]/', '', $_POST['exchange_rate']) : ''
  ));

  foreach ($required_fields as $required_field) {
    if(!$add_new_order->getValue($required_field))
      $missing_fields[] = $required_field;
  }
  if($missing_fields)
  {
    $error_messages[] = 'There were some missing fields!';
  }
  if($error_messages)
  {
    $ERR_STATUS = ERR_FORM;
    require('./views/error_display.php');
  }
  else {
    $add_new_order->createNewOrder();
    header('location: ' . URL . '/home/');
  }
}

function getOrdersList()
{
  $orders = CustomerOrder::getCustomerOrderByCustomerId($_SESSION['merchant_customer_account']->getValue('id'));
  $responseData = array();
  foreach($orders as $order)
  {
    $responseData[] = (object)array(
      'id' => ;
      'product_link' => ;
      'id' => ;
      'id' => ;
      'id' => ;
      'id' => ;
      'id' => ;
      'id' => ;
    );
  }
}
 ?>
