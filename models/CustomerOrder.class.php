<?php
class CustomerOrder extends DataObject
{
  protected $data = array(
    'id' => '',
    'customer_id' => '',
    'product_link' => '',
    'remark' => '',
    'cupon_code' => '',
    'quantity' => '',
    'price' => '',
    'us_tax' => '',
    'shipping_cost' => '',
    'first_exchange_rate' => '',
    'commission' => '',
    'product_weight' => '',
    'weight_cost' => '',
    'mm_tax' => '',
    'second_exchange_rate' => '',
    'is_deliver' => '',
    'delivery_fee' => '',
    'order_status' => '',
    'has_viewed_admin' => '',
    'has_viewed_customer' => '',
    'created_date' => ''
  );

  public function createNewOrder()
  {
    $conn = parent::connect();
    $sql = 'INSERT INTO ' .TBL_CUSTOMER_ORDER . ' (customer_id, product_link, remark, cupon_code, quantity, price,
    us_tax, shipping_cost, first_exchange_rate, commission, product_weight, weight_cost, mm_tax, second_exchange_rate, is_deliver,
    delivery_fee, order_status, has_viewed_admin, has_viewed_customer, created_date)
    VALUES (:customer_id, :product_link, :remark, :cupon_code, :quantity, :price, 0.0, 0.0, :first_exchange_rate, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0.0, 0, 0, 1, NOW())';

    try{
      $st = $conn->prepare($sql);
      $st->bindValue(':customer_id', $this->data['customer_id'], PDO::PARAM_INT);
      $st->bindValue(':product_link', $this->data['product_link'], PDO::PARAM_STR);
      $st->bindValue(':remark', $this->data['remark'], PDO::PARAM_STR);
      $st->bindValue(':cupon_code', $this->data['cupon_code'], PDO::PARAM_STR);
      $st->bindValue(':quantity', $this->data['quantity'], PDO::PARAM_INT);
      $st->bindValue(':price', $this->data['price']);
      $st->bindValue(':first_exchange_rate', $this->data['first_exchange_rate']);
      $st->execute();
      parent::disconnect($conn);
    }catch (PDOException $e) {
      parent::disconnect($conn);
      die('Query failed: ' . $e->getMessage());
    }
  }


  public static function getCustomerOrderByCustomerId($customer_id)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_CUSTOMER_ORDER . ' WHERE customer_id = :customer_id';
    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':customer_id', $customer_id, PDO::PARAM_INT);
      $st->execute();
      $orders = array();
      $result = $st->setFetchMode(PDO::FETCH_NAMED);
      foreach ( $st->fetchAll() as $row ) {
        $orders[] = new CustomerOrder($row);
      }
      parent::disconnect($conn);
      return $orders;
    } catch(PDOException $e) {
      parent::disconnect($conn);
      die('Query failed: ' . $e->getMessage());
    }
  }
}
 ?>
