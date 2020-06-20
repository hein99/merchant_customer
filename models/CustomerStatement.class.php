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

}
 ?>
