<?php

class UsersAccount extends DataObject
{
  protected $data = array(
    'id' => '',
    'username' => '',
    'password' => '',
    'user_status' => '',
    'phone' => '',
    'address' => '',
    'activate_status' => '',
    'point' => '',
    'balance' => '',
    'membership_id' => '',
    'created_date' => '',
    'modified_date' => ''
  );

  public static function getCustomerAccountById($id)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM '.TBL_USERS_ACCOUNT.' WHERE id = :id AND user_status = 0';
    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':id', $id, PDO::PARAM_STR);
      $st->execute();
      $row = $st->fetch();
      parent::disconnect($conn);
      if($row) return new UsersAccount($row);
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die('Query failed: ' . $e->getMessage());
    }
  }

  public static function getCustomerAccountByPhoneNumber($phone)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM '.TBL_USERS_ACCOUNT.' WHERE phone = :phone AND user_status = 0';
    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':phone', $phone, PDO::PARAM_STR);
      $st->execute();
      $row = $st->fetch();
      parent::disconnect($conn);
      if($row) return new UsersAccount($row);
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die('Query failed: ' . $e->getMessage());
    }
  }

  public function authenticateCustomerAccount()
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM '.TBL_USERS_ACCOUNT.' WHERE username = :username AND password = PASSWORD(:password) AND user_status = 0';
    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':username', $this->data['username'], PDO::PARAM_STR);
      $st->bindValue(':password', $this->data['password'], PDO::PARAM_STR);
      $st->execute();
      $row = $st->fetch();
      parent::disconnect($conn);
      if($row) return new UsersAccount($row);
    }catch(PDOException $e){
      parent::disconnect($conn);
      die('Query failed: ' . $e->getMessage());
    }
  }
}
?>
