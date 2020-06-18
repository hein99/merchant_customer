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

  default:
    $ERR_STATUS = ERR_ACTION;
    require('./views/error_display.php');
    exit();
}

function addNewOrder()
{
  $required_fields = array('customer_id', 'product_link', 'remark', 'quantity', 'price');
  $missing_fields = array();
  $error_messages = array();

  $add_new_order = new CustomerOrder(array(
    'customer_id' => isset($_POST['customer_id']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['customer_id']) : '',
    'product_link' => isset($_POST['product_link']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['product_link']) : '',
    'remark' => isset($_POST['remark']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['remark']) : '',
    'quantity' => isset($_POST['quantity']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['quantity']) : '',
    'price' => isset($_POST['price']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['price']) : '',
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

 ?>
