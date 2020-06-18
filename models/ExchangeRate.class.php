<?php
class ExchangeRate extends DataObject
{
  protected $data = array(
    'id' => '',
    'mmk' => '',
    'created_date' => ''
  );

  public static function getLatestExchangeRate(){
    $conn = parent::connect();
    $sql = 'SELECT * FROM '.TBL_EXCHANGE_RATE.' ORDER BY created_date DESC LIMIT 1';
    try {
      $st = $conn->query($sql);
      $row = $st->fetch();
      parent::disconnect($conn);
      if($row) return new ExchangeRate($row);
    }catch(PDOException $e) {
      parent::disconnect($conn);
      die('Query failed: '.$e->getMessage());
    }
  }
}
 ?>
