<?php
class PasswordRequest extends DataObject
{
  protected $data = array(
    'id' => '',
    'phone' => '',
    'requested_date' => '',
    'status' => ''
  );

  public function addPasswordRequest()
  {
    $conn = parent::connect();
    $sql = 'INSERT INTO '.TBL_PASSWORD_REQUEST.' (phone, requested_date, status)
            VALUES (:phone, NOW(), 0)';
    try{
      $st = $conn->prepare($sql);
      $st->bindValue(':phone', $this->data['phone'], PDO::PARAM_INT);
      $st->execute();
      parent::disconnect($conn);
    }catch (PDOException $e) {
      parent::disconnect($conn);
      die('Query failed: '.$e->getMessage());
    }
  }

}
 ?>
