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

  public static function getAdmin()
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM '.TBL_USERS_ACCOUNT.' WHERE user_status = 1';
    try {
      $st = $conn->query($sql);
      $row = $st->fetch();
      parent::disconnect($conn);
      if($row) return new UsersAccount($row);
    }catch (PDOException $e) {
      parent::disconnect($conn);
      die('Query failed: '.$e->getMessage());
    }
  }

  public static function getCustomerAccountById($id)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM '.TBL_USERS_ACCOUNT.' WHERE id = :id AND user_status = 0 AND activate_status=1';
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
    $sql = 'SELECT * FROM '.TBL_USERS_ACCOUNT.' WHERE phone = :phone AND password = PASSWORD(:password) AND user_status = 0 AND activate_status=1';
    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':phone', $this->data['phone'], PDO::PARAM_STR);
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
  public static function getPhoneNumberCheck($phone, $id)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM '.TBL_USERS_ACCOUNT.' WHERE phone = :phone AND id != :id AND user_status = 0';
    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':phone', $phone, PDO::PARAM_STR);
      $st->bindValue(':id', $id, PDO::PARAM_INT);
      $st->execute();
      $row = $st->fetch();
      parent::disconnect($conn);
      if($row) return new UsersAccount($row);
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die('Query failed: ' . $e->getMessage());
    }
  }
  public function editCustomerInfo()
  {
    $conn = parent::connect();
    $sql = 'UPDATE ' . TBL_USERS_ACCOUNT .' SET username = :username, phone = :phone, address = :address, modified_date = NOW() WHERE id = :id';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':id', $this->data['id'], PDO::PARAM_INT);
      $st->bindValue(':username', $this->data['username'], PDO::PARAM_STR);
      $st->bindValue(':phone', $this->data['phone'], PDO::PARAM_STR);
      $st->bindValue(':address', $this->data['address'], PDO::PARAM_STR);
      $st->execute();
      parent::disconnect($conn);
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }
  public function updateCustomerAccount($id)
  {
    $conn = parent::connect();
    $sql = 'UPDATE ' . TBL_USERS_ACCOUNT .' SET password = password(:password) WHERE id = :id';
    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':id', $id, PDO::PARAM_INT);
      $st->bindValue(':password', $this->data['password'], PDO::PARAM_STR);
      $st->execute();
      parent::disconnect($conn);
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ".$e->getMessage());
    }
  }

  public static function updateCustomerBalance($id, $balance)
  {
    $conn = parent::connect();
    $sql = 'UPDATE ' . TBL_USERS_ACCOUNT .' SET balance = :balance WHERE id = :id';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':id', $id, PDO::PARAM_INT);
      $st->bindValue(':balance', $balance);
      $st->execute();
      parent::disconnect($conn);
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }
}

?>
