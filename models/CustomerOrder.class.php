<?php
class CustomerOrder extends DataObject
{
  protected $data = array(
    'id' => '',
    'customer_id' => '',
    'product_link' => '',
    'remark' => '',
    'quantity' => '',
    'price' => '',
    'us_tax' => '',
    'mm_tax' => '',
    'commission' => '',
    'product_weight' => '',
    'weight_cost' => '',
    'exchange_rate' => '',
    'order_status' => '',
    'product_shipping_status' => '',
    'has_viewed_admin' => '',
    'has_viewed_customer' => '',
    'created_date' => ''
  );

  public function createNewOrder()
  {
    $conn = parent::connect();
    $sql = 'INSERT INTO ' .TBL_CUSTOMER_ORDER . ' (customer_id, product_link, remark, quantity, price,
    us_tax, mm_tax, commission, product_weight, weight_cost, exchange_rate, order_status, product_shipping_status,
    has_viewed_admin, has_viewed_customer ,created_date)
    VALUES (:customer_id, :product_link, :remark, :quantity, :price, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NOW())';

    try{
      $st = $conn->prepare($sql);
      $st->bindValue(':customer_id', $this->data['customer_id'], PDO::PARAM_INT);
      $st->bindValue(':product_link', $this->data['product_link'], PDO::PARAM_STR);
      $st->bindValue(':remark', $this->data['remark'], PDO::PARAM_STR);
      $st->bindValue(':quantity', $this->data['quantity'], PDO::PARAM_INT);
      $st->bindValue(':price', $this->data['price'], PDO::PARAM_INT);
      $st->execute();
      parent::disconnect($conn);
    }catch (PDOException $e) {
      parent::disconnect($conn);
      die('Query failed: ' . $e->getMessage());
    }
  }

}
 ?>
