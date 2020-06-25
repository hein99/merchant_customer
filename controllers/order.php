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

  case 'get_update_orders_list':
    getUpdateOrdersList();
    break;

  case 'get_order_voucher':
    getOrderVoucher($id);
    break;

  case 'update_order_status':
    updateOrderStatus();
    break;

  case 'update_order':
    updateOrder();
    break;

  default:
    $ERR_STATUS = ERR_ACTION;
    require('./views/error_display.php');
    exit();
}

function addNewOrder()
{
  $latest_exchange_rate = ExchangeRate::getLatestExchangeRate();
  $required_fields = array('customer_id', 'product_link', 'remark', 'quantity', 'price', 'first_exchange_rate');
  $missing_fields = array();
  $error_messages = array();

  $add_new_order = new CustomerOrder(array(
    'customer_id' => $_SESSION['merchant_customer_account']->getValue('id'),
    'product_link' => isset($_POST['product_link']) ? $_POST['product_link'] : '',
    'remark' => isset($_POST['remark']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['remark']) : '',
    'cupon_code' => isset($_POST['cupon_code']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['cupon_code']) : '',
    'quantity' => isset($_POST['quantity']) ? preg_replace('/[^0-9]/', '', $_POST['quantity']) : '',
    'price' => isset($_POST['price']) ? preg_replace('/[^.\0-9]/', '', $_POST['price']) : '',
    'first_exchange_rate' => $latest_exchange_rate->getValueEncoded('mmk')
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

function updateOrder()
{
  $required_fields = array('id', 'product_link', 'remark', 'quantity', 'price');
  $missing_fields = array();
  $error_messages = array();

  $add_new_order = new CustomerOrder(array(
    'id' => isset($_POST['id']) ? preg_replace('/[^0-9]/', '', $_POST['id']) : '',
    'product_link' => isset($_POST['product_link']) ? $_POST['product_link'] : '',
    'remark' => isset($_POST['remark']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['remark']) : '',
    'cupon_code' => isset($_POST['cupon_code']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['cupon_code']) : '',
    'quantity' => isset($_POST['quantity']) ? preg_replace('/[^0-9]/', '', $_POST['quantity']) : '',
    'price' => isset($_POST['price']) ? preg_replace('/[^.\0-9]/', '', $_POST['price']) : ''
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
    $checkOrder = CustomerOrder::getCustomerOrderById($add_new_order->getValue('id'));
    if($checkOrder->getValue('order_status') < 2)
      $add_new_order->updateOrder();
    header('location: ' . URL . '/order/');
  }
}

function getOrdersList()
{
  $orders = CustomerOrder::getCustomerOrderByCustomerId($_SESSION['merchant_customer_account']->getValue('id'));
  $responseData = array();
  foreach($orders as $order)
  {
    $responseData[] = (object)array(
      'id' => $order->getValue('id'),
      'product_link' => $order->getValue('product_link'),
      'status' => $order->getValue('order_status'),
      'amount' => ($order->getValue('order_status') == "7") ? number_format(calculateTotalAmountMMK($order)) : '',
      'date' => $order->getValue('created_date')
    );
  }
  echo json_encode($responseData);
}

function getUpdateOrdersList()
{
  $orders = CustomerOrder::getNewCustomerOrderByCustomerId($_SESSION['merchant_customer_account']->getValue('id'));
  CustomerOrder::updateHasViewedCustomerByCustomerId($_SESSION['merchant_customer_account']->getValue('id'));
  $responseData = array();
  foreach($orders as $order)
  {
    $responseData[] = (object) array(
      'id' => $order->getValue('id'),
      'status' => $order->getValue('order_status'),
      'amount' => number_format(calculateTotalAmountMMK($order), 2)
    );
  }
  echo json_encode($responseData);
}

function getOrderVoucher($id)
{
  $order = CustomerOrder::getCustomerOrderById($id);
  $responseData = null;
  switch($order->getValue('order_status'))
  {
    case 0:
      $responseData = (object)array(
        'id' => $order->getValue('id'),
        'status' => $order->getValue('order_status'),
        'amount' => 'N/A',
        'order_number' => str_pad( $order->getValue('id'), 7, 0, STR_PAD_LEFT ),
        'remark'  => $order->getValue('remark'),
        'date'  => $order->getValue('created_date'),
        'cupon_code'  => $order->getValue('cupon_code'),
        'product_link' => $order->getValue('product_link'),
        'qty' => $order->getValue('quantity'),
        'product_total_price' => number_format(calculateProductPrice($order), 2),
        'product_price' => $order->getValue('price'),
        'us_tax' => 'N/A',
        'shippig_cost' => 'N/A',
        'first_payment_dollar' => 'N/A',
        'first_payment_mmk' => 'N/A',
        'commission_rate' => 'N/A',
        'commission_amount' => 'N/A',
        'weight' => 'N/A',
        'total_weight_cost' => 'N/A',
        'mm_tax' => 'N/A',
        'mm_tax_amount' => 'N/A',
        'second_payment_dollar' => 'N/A',
        'second_payment_mmk' => 'N/A',
        'delivery_fee' => 'N/A'
      );
      break;

    case 1:
      $responseData = (object)array(
        'id' => $order->getValue('id'),
        'status' => $order->getValue('order_status'),
        'amount' => 'N/A',
        'order_number' => str_pad( $order->getValue('id'), 7, 0, STR_PAD_LEFT ),
        'remark'  => $order->getValue('remark'),
        'date'  => $order->getValue('created_date'),
        'cupon_code'  => $order->getValue('cupon_code'),
        'product_link' => $order->getValue('product_link'),
        'qty' => $order->getValue('quantity'),
        'product_total_price' => number_format(calculateProductPrice($order), 2),
        'product_price' => $order->getValue('price'),
        'us_tax' => number_format($order->getValue('us_tax'), 2),
        'shippig_cost' => number_format($order->getValue('shipping_cost'), 2),
        'first_payment_dollar' => number_format(calculateFirstPaymentDollar($order), 2),
        'first_payment_mmk' => number_format(calculateMMK(calculateFirstPaymentDollar($order), $order->getValue('first_exchange_rate')), 2),
        'commission_rate' => 'N/A',
        'commission_amount' => 'N/A',
        'weight' => 'N/A',
        'total_weight_cost' => 'N/A',
        'mm_tax' => 'N/A',
        'mm_tax_amount' => 'N/A',
        'second_payment_dollar' => 'N/A',
        'second_payment_mmk' => 'N/A',
        'delivery_fee' => 'N/A'
      );
      break;

    case 2:
      $responseData = (object)array(
        'id' => $order->getValue('id'),
        'status' => $order->getValue('order_status'),
        'amount' => 'N/A',
        'order_number' => str_pad( $order->getValue('id'), 7, 0, STR_PAD_LEFT ),
        'remark'  => $order->getValue('remark'),
        'date'  => $order->getValue('created_date'),
        'cupon_code'  => $order->getValue('cupon_code'),
        'product_link' => $order->getValue('product_link'),
        'qty' => $order->getValue('quantity'),
        'product_total_price' => number_format(calculateProductPrice($order), 2),
        'us_tax' => number_format($order->getValue('us_tax'), 2),
        'shippig_cost' => number_format($order->getValue('shipping_cost'), 2),
        'first_payment_dollar' => number_format(calculateFirstPaymentDollar($order), 2),
        'first_payment_mmk' => number_format(calculateMMK(calculateFirstPaymentDollar($order), $order->getValue('first_exchange_rate')), 2),
        'commission_rate' => 'N/A',
        'commission_amount' => 'N/A',
        'weight' => 'N/A',
        'total_weight_cost' => 'N/A',
        'mm_tax' => 'N/A',
        'mm_tax_amount' => 'N/A',
        'second_payment_dollar' => 'N/A',
        'second_payment_mmk' => 'N/A',
        'delivery_fee' => 'N/A'
      );
      break;

    case 3:
      $responseData = (object)array(
        'id' => $order->getValue('id'),
        'status' => $order->getValue('order_status'),
        'amount' => 'N/A',
        'order_number' => str_pad( $order->getValue('id'), 7, 0, STR_PAD_LEFT ),
        'remark'  => $order->getValue('remark'),
        'date'  => $order->getValue('created_date'),
        'cupon_code'  => $order->getValue('cupon_code'),
        'product_link' => $order->getValue('product_link'),
        'qty' => $order->getValue('quantity'),
        'product_total_price' => number_format(calculateProductPrice($order), 2),
        'us_tax' => number_format($order->getValue('us_tax'), 2),
        'shippig_cost' => number_format($order->getValue('shipping_cost'), 2),
        'first_payment_dollar' => number_format(calculateFirstPaymentDollar($order), 2),
        'first_payment_mmk' => number_format(calculateMMK(calculateFirstPaymentDollar($order), $order->getValue('first_exchange_rate')), 2),
        'commission_rate' => 'N/A',
        'commission_amount' => 'N/A',
        'weight' => 'N/A',
        'total_weight_cost' => 'N/A',
        'mm_tax' => 'N/A',
        'mm_tax_amount' => 'N/A',
        'second_payment_dollar' => 'N/A',
        'second_payment_mmk' => 'N/A',
        'delivery_fee' => 'N/A'
      );
      break;

    case 4:
      $responseData = (object)array(
        'id' => $order->getValue('id'),
        'status' => $order->getValue('order_status'),
        'amount' => 'N/A',
        'order_number' => str_pad( $order->getValue('id'), 7, 0, STR_PAD_LEFT ),
        'remark'  => $order->getValue('remark'),
        'date'  => $order->getValue('created_date'),
        'cupon_code'  => $order->getValue('cupon_code'),
        'product_link' => $order->getValue('product_link'),
        'qty' => $order->getValue('quantity'),
        'product_total_price' => number_format(calculateProductPrice($order), 2),
        'us_tax' => number_format($order->getValue('us_tax'), 2),
        'shippig_cost' => number_format($order->getValue('shipping_cost'), 2),
        'first_payment_dollar' => number_format(calculateFirstPaymentDollar($order), 2),
        'first_payment_mmk' => number_format(calculateMMK(calculateFirstPaymentDollar($order), $order->getValue('first_exchange_rate')), 2),
        'commission_rate' => $order->getValue('commission'),
        'commission_amount' => number_format(calculateCommission($order), 2),
        'weight' => $order->getValue('product_weight'),
        'total_weight_cost' => number_format(calculateWeightCost($order), 2),
        'mm_tax' => $order->getValue('mm_tax'),
        'mm_tax_amount' => number_format(calculateMMTax($order), 2),
        'second_payment_dollar' => number_format(calculateSecondPaymentDollar($order), 2),
        'second_payment_mmk' => number_format(calculateMMK(calculateSecondPaymentDollar($order), $order->getValue('second_exchange_rate')), 2),
        'delivery_fee' => 'N/A'
      );
      break;

    case 5:
      $responseData = (object)array(
        'id' => $order->getValue('id'),
        'status' => $order->getValue('order_status'),
        'amount' => 'N/A',
        'order_number' => str_pad( $order->getValue('id'), 7, 0, STR_PAD_LEFT ),
        'remark'  => $order->getValue('remark'),
        'date'  => $order->getValue('created_date'),
        'cupon_code'  => $order->getValue('cupon_code'),
        'product_link' => $order->getValue('product_link'),
        'qty' => $order->getValue('quantity'),
        'product_total_price' => number_format(calculateProductPrice($order), 2),
        'us_tax' => number_format($order->getValue('us_tax'), 2),
        'shippig_cost' => number_format($order->getValue('shipping_cost'), 2),
        'first_payment_dollar' => number_format(calculateFirstPaymentDollar($order), 2),
        'first_payment_mmk' => number_format(calculateMMK(calculateFirstPaymentDollar($order), $order->getValue('first_exchange_rate')), 2),
        'commission_rate' => $order->getValue('commission'),
        'commission_amount' => number_format(calculateCommission($order), 2),
        'weight' => $order->getValue('product_weight'),
        'total_weight_cost' => number_format(calculateWeightCost($order), 2),
        'mm_tax' => $order->getValue('mm_tax'),
        'mm_tax_amount' => number_format(calculateMMTax($order), 2),
        'second_payment_dollar' => number_format(calculateSecondPaymentDollar($order), 2),
        'second_payment_mmk' => number_format(calculateMMK(calculateSecondPaymentDollar($order), $order->getValue('second_exchange_rate')), 2),
        'delivery_fee' => 'N/A'
      );
      break;

    case 6:
      $responseData = (object)array(
        'id' => $order->getValue('id'),
        'status' => $order->getValue('order_status'),
        'amount' => 'N/A',
        'order_number' => str_pad( $order->getValue('id'), 7, 0, STR_PAD_LEFT ),
        'remark'  => $order->getValue('remark'),
        'date'  => $order->getValue('created_date'),
        'cupon_code'  => $order->getValue('cupon_code'),
        'product_link' => $order->getValue('product_link'),
        'qty' => $order->getValue('quantity'),
        'product_total_price' => number_format(calculateProductPrice($order), 2),
        'us_tax' => number_format($order->getValue('us_tax'), 2),
        'shippig_cost' => number_format($order->getValue('shipping_cost'), 2),
        'first_payment_dollar' => number_format(calculateFirstPaymentDollar($order), 2),
        'first_payment_mmk' => number_format(calculateMMK(calculateFirstPaymentDollar($order), $order->getValue('first_exchange_rate')), 2),
        'commission_rate' => $order->getValue('commission'),
        'commission_amount' => number_format(calculateCommission($order), 2),
        'weight' => $order->getValue('product_weight'),
        'total_weight_cost' => number_format(calculateWeightCost($order), 2),
        'mm_tax' => $order->getValue('mm_tax'),
        'mm_tax_amount' => number_format(calculateMMTax($order), 2),
        'second_payment_dollar' => number_format(calculateSecondPaymentDollar($order), 2),
        'second_payment_mmk' => number_format(calculateMMK(calculateSecondPaymentDollar($order), $order->getValue('second_exchange_rate')), 2),
        'delivery_fee' => 'N/A'
      );
      break;

    case 7:
      $responseData = (object)array(
        'id' => $order->getValue('id'),
        'status' => $order->getValue('order_status'),
        'amount' => number_format(calculateTotalAmountMMK($order), 2),
        'order_number' => str_pad( $order->getValue('id'), 7, 0, STR_PAD_LEFT ),
        'remark'  => $order->getValue('remark'),
        'date'  => $order->getValue('created_date'),
        'cupon_code'  => $order->getValue('cupon_code'),
        'product_link' => $order->getValue('product_link'),
        'qty' => $order->getValue('quantity'),
        'product_total_price' => number_format(calculateProductPrice($order), 2),
        'us_tax' => number_format($order->getValue('us_tax'), 2),
        'shippig_cost' => number_format($order->getValue('shipping_cost'), 2),
        'first_payment_dollar' => number_format(calculateFirstPaymentDollar($order), 2),
        'first_payment_mmk' => number_format(calculateMMK(calculateFirstPaymentDollar($order), $order->getValue('first_exchange_rate')), 2),
        'commission_rate' => $order->getValue('commission'),
        'commission_amount' => number_format(calculateCommission($order), 2),
        'weight' => $order->getValue('product_weight'),
        'total_weight_cost' => number_format(calculateWeightCost($order), 2),
        'mm_tax' => $order->getValue('mm_tax'),
        'mm_tax_amount' => number_format(calculateMMTax($order), 2),
        'second_payment_dollar' => number_format(calculateSecondPaymentDollar($order), 2),
        'second_payment_mmk' => number_format(calculateMMK(calculateSecondPaymentDollar($order), $order->getValue('second_exchange_rate')), 2),
        'delivery_fee' => number_format($order->getValue('delivery_fee'), 2)
      );
      break;

    case 8:
      $responseData = (object)array(
        'id' => $order->getValue('id'),
        'status' => $order->getValue('order_status'),
        'amount' => number_format(calculateTotalAmountMMK($order), 2),
        'order_number' => str_pad( $order->getValue('id'), 7, 0, STR_PAD_LEFT ),
        'remark'  => $order->getValue('remark'),
        'date'  => $order->getValue('created_date'),
        'cupon_code'  => $order->getValue('cupon_code'),
        'product_link' => $order->getValue('product_link'),
        'qty' => $order->getValue('quantity'),
        'product_total_price' => number_format(calculateProductPrice($order), 2),
        'us_tax' => 'N/A',
        'shippig_cost' => 'N/A',
        'first_payment_dollar' => 'N/A',
        'first_payment_mmk' => 'N/A',
        'commission_rate' => 'N/A',
        'commission_amount' => 'N/A',
        'weight' => 'N/A',
        'total_weight_cost' => 'N/A',
        'mm_tax' => 'N/A',
        'mm_tax_amount' => 'N/A',
        'second_payment_dollar' => 'N/A',
        'second_payment_mmk' => 'N/A',
        'delivery_fee' => 'N/A'
      );
      break;
  }
  echo json_encode($responseData);
}

function updateOrderStatus()
{
  $required_fields = array('id', 'order_status');
  $missing_fields = array();
  $error_messages = array();

  $order = new CustomerOrder(array(
    'id' => isset($_POST['id']) ? preg_replace('/[^0-9]/', '', $_POST['id']) : '',
    'order_status' => isset($_POST['order_status']) ? preg_replace('/[^0-9]/', '', $_POST['order_status']) : ''
  ));

  foreach ($required_fields as $required_field) {
    if(!$order->getValue($required_field))
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
    $checkOrder = CustomerOrder::getCustomerOrderById($order->getValue('id'));
    if($checkOrder->getValue('order_status') < 2)
    {
      if($order->getValue('order_status') == 2)
      {
        $customer_id = $_SESSION['merchant_customer_account']->getValue('id');
        $customer = UsersAccount::getCustomerAccountById($customer_id);
        $balance = $customer->getValue('balance');
        $sub_amount = calculateMMK(calculateFirstPaymentDollar($checkOrder), $checkOrder->getValue('first_exchange_rate'));
        $result = $balance - $sub_amount;
        if( $result > 0.0)
        {
          $customer_statement = new CustomerStatement(array(
            'customer_id' => $customer_id,
            'amount' => $sub_amount,
            'about' => 'First Payment of order no [ ' . str_pad( $order->getValue('id'), 7, 0, STR_PAD_LEFT ) . ' ]'
          ));
          $customer_statement->addCustomerStatement($customer_statement->getValue('amount'), 0);
          UsersAccount::updateCustomerBalance($customer_id, $result);
          $order->updateOrderStatus();
        }
      }
      else {
        $order->updateOrderStatus();
      }

      echo 'success';
    }

  }
}

function calculateFirstPaymentDollar($order)
{
  return calculateProductPrice($order) + $order->getValue('us_tax') + $order->getValue('shipping_cost');
}

function calculateProductPrice($order)
{
  return ($order->getValue('quantity')*$order->getValue('price'));
}

function calculateSecondPaymentDollar($order)
{
  $first_payment_dollar = calculateFirstPaymentDollar($order);
  return calculateCommission($order) + calculateWeightCost($order) + calculateMMTax($order);
}

function calculateMMK($amount, $rate)
{
  return $amount * $rate;
}

function calculateCommission($order)
{
  $first_payment_dollar = calculateFirstPaymentDollar($order);
  return ($first_payment_dollar*$order->getValue('commission')/100);
}

function calculateMMTax($order)
{
  $first_payment_dollar = calculateFirstPaymentDollar($order);
  return ($first_payment_dollar*$order->getValue('mm_tax')/100);
}

function calculateWeightCost($order)
{
  return ($order->getValue('product_weight')*$order->getValue('weight_cost'));
}

function calculateTotalAmountMMK($order)
{
  $first_payment_dollar = calculateFirstPaymentDollar($order);
  $first_payment_mmk = calculateMMK($first_payment_dollar, $order->getValue('first_exchange_rate'));

  $second_payment_dollar = calculateSecondPaymentDollar($order);
  $second_payment_mmk = calculateMMK($second_payment_dollar, $order->getValue('second_exchange_rate'));

  return $first_payment_mmk + $second_payment_mmk + $order->getValue('delivery_fee');
}
 ?>
