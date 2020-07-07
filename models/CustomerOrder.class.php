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
    VALUES (:customer_id, :product_link, :remark, :cupon_code, :quantity, :price, 0.0, 0.0, :first_exchange_rate, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0.0, 0, 0, 0, NOW())';

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

  public static function getUnseenOrder($customer_id)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_CUSTOMER_ORDER . ' WHERE customer_id = :customer_id AND has_viewed_customer = 0';
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

  public static function getCustomerOrderByCustomerId($customer_id)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_CUSTOMER_ORDER . ' WHERE customer_id = :customer_id ORDER BY created_date DESC';
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

  public static function getNewCustomerOrderByCustomerId($customer_id)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_CUSTOMER_ORDER . ' WHERE customer_id = :customer_id AND has_viewed_customer = 0';
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

  public static function getCustomerOrderById($id)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_CUSTOMER_ORDER . ' WHERE id = :id';
    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':id', $id, PDO::PARAM_INT);
      $st->execute();
      $row =$st->fetch();
      parent::disconnect($conn);
      if($row) return new CustomerOrder($row);;
    } catch(PDOException $e) {
      parent::disconnect($conn);
      die('Query failed: ' . $e->getMessage());
    }
  }

  public static function updateHasViewedCustomerByCustomerId($customer_id)
  {
    $conn = parent::connect();
    $sql = 'UPDATE '.TBL_CUSTOMER_ORDER.' SET has_viewed_customer = 1 WHERE customer_id = :customer_id';
    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':customer_id', $customer_id, PDO::PARAM_INT);
      $st->execute();
      parent::disconnect($conn);
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

  public function updateOrder()
  {
    $conn = parent::connect();
    $sql = 'UPDATE ' .TBL_CUSTOMER_ORDER . ' SET product_link = :product_link, remark = :remark, cupon_code = :cupon_code, quantity = :quantity, price = :price, order_status = 0, has_viewed_customer = 0, has_viewed_admin = 0 WHERE id = :id';
    try{
      $st = $conn->prepare($sql);
      $st->bindValue(':id', $this->data['id'], PDO::PARAM_INT);
      $st->bindValue(':product_link', $this->data['product_link'], PDO::PARAM_STR);
      $st->bindValue(':remark', $this->data['remark'], PDO::PARAM_STR);
      $st->bindValue(':cupon_code', $this->data['cupon_code'], PDO::PARAM_STR);
      $st->bindValue(':quantity', $this->data['quantity'], PDO::PARAM_INT);
      $st->bindValue(':price', $this->data['price']);
      $st->execute();
      parent::disconnect($conn);
    }catch (PDOException $e) {
      parent::disconnect($conn);
      die('Query failed: ' . $e->getMessage());
    }
  }

  public function updateOrderStatus()
  {
    $conn = parent::connect();
    $sql = 'UPDATE ' .TBL_CUSTOMER_ORDER . ' SET order_status = :order_status, has_viewed_customer = 0, has_viewed_admin = 0 WHERE id = :id';
    try{
      $st = $conn->prepare($sql);
      $st->bindValue(':id', $this->data['id'], PDO::PARAM_INT);
      $st->bindValue(':order_status', $this->data['order_status'], PDO::PARAM_INT);
      $st->execute();
      parent::disconnect($conn);
    }catch (PDOException $e) {
      parent::disconnect($conn);
      die('Query failed: ' . $e->getMessage());
    }
  }
}
 ?>
