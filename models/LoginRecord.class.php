<?php

class LoginRecord extends DataObject
{
  protected $data = array(
    'id' => '',
    'user_id' => '',
    'active_activity' => '',
    'is_type' => '',
    'to_whom_id'=> ''
  );
  public static function getUsersActiveActivity()
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_LOGIN_RECORD . ' WHERE user_id = 1';
    try {
      $st = $conn->query($sql);
      $row = $st->fetch();
      parent::disconnect($conn);
      if($row) return new LoginRecord($row);
    }catch (PDOException $e) {
      parent::disconnect($conn);
      die('Query failed: '.$e->getMessage());
    }
  }
  public static function getIsType($id)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_LOGIN_RECORD . ' WHERE to_whom_id = :id AND is_type = \'yes\'';
    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':id', $id, PDO::PARAM_INT);
      $st->execute();
      $row = $st->fetch();
      parent::disconnect($conn);
      if($row) return new LoginRecord($row);
    }catch (PDOException $e) {
      parent::disconnect($conn);
      die('Query failed: '.$e->getMessage());
    }
  }
  public function updateIsType()
  {
    $conn = parent::connect();
    $sql = 'UPDATE '.TBL_LOGIN_RECORD. ' SET is_type = :is_type, to_whom_id = :to_whom_id WHERE user_id = :user_id';
    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':user_id', $this->data['user_id'], PDO::PARAM_INT);
      $st->bindValue(':to_whom_id', $this->data['to_whom_id'], PDO::PARAM_INT);
      $st->bindValue(':is_type', $this->data['is_type'], PDO::PARAM_STR);
      $st->execute();
      parent::disconnect($conn);
    }catch (PDOException $e) {
      parent::disconnect($conn);
      die('Query failed: '.$e->getMessage());
    }
  }
  public static function updateUsersActiveActivity($user_id)
  {
    $conn = parent::connect();
    $sql = 'UPDATE '.TBL_LOGIN_RECORD. ' SET active_activity = NOW() WHERE user_id = :user_id';
    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':user_id', $user_id, PDO::PARAM_INT);
      $st->execute();
      parent::disconnect($conn);
    }catch (PDOException $e) {
      parent::disconnect($conn);
      die('Query failed: '.$e->getMessage());
    }
  }
}
?>
