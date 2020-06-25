<?php
class CustomerStatement extends DataObject
{
  protected $data = array(
    'id' => '',
    'customer_id' => '',
    'amount' => '',
    'amount_status' => '',
    'about' => '',
    'created_date' => ''
  );

  public static function getCustomerStatement($customer_id)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM '.TBL_CUSTOMER_STATEMENT.' WHERE customer_id = :customer_id ORDER BY created_date DESC';
    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':customer_id', $customer_id, PDO::PARAM_INT);
      $st->execute();
      $statements = array();
      foreach($st->fetchAll() as $row)
      {
        $statements[] =  new CustomerStatement($row);
      }
      parent::disconnect($conn);
      return $statements;
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die('Query failed: ' . $e->getMessage());
    }
  }

  public function addCustomerStatement($sign_amount, $amount_status)
  {
    $conn = parent::connect();
    $sql = 'INSERT INTO ' .TBL_CUSTOMER_STATEMENT . '(customer_id, amount, amount_status, about, created_date)
            VALUES (:customer_id, :amount, :amount_status, :about, NOW())';
    try{
      $st = $conn->prepare($sql);
      $st->bindValue(':customer_id', $this->data['customer_id'], PDO::PARAM_INT);
      $st->bindValue(':amount', $sign_amount, PDO::PARAM_STR);
      $st->bindValue(':amount_status', $amount_status, PDO::PARAM_INT);
      $st->bindValue(':about', $this->data['about'], PDO::PARAM_STR);
      $st->execute();
      parent::disconnect($conn);
    }catch (PDOException $e) {
      parent::disconnect($conn);
      die('Query failed: ' . $e->getMessage());
    }
  }

}
 ?>
