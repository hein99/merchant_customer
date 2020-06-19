<?php

class MessageRecord extends DataObject
{
  protected $data = array(
    'id' => '',
    'to_user_id' => '',
    'from_user_id' => '',
    'messages' => '',
    'is_image' => '',
    'arrived_time' => '',
    'admin_has_viewed' => '',
    'customer_has_viewed' => ''
  );
  public static function getNewMessagesCount($id)
  {
    $conn = parent::connect();
    $sql = 'SELECT COUNT(*) FROM ' . TBL_MESSAGE_RECORD . ' WHERE to_user_id = :id AND customer_has_viewed = 0';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':id', $id, PDO::PARAM_INT);
      $st->execute();
      $row = $st->fetch();
      parent::disconnect($conn);
      return $row[0];
    } catch(PDOException $e) {
      parent::disconnect($conn);
      die('Query failed: ' . $e->getMessage());
    }
  }
  public static function getAllMessage($from_user_id, $to_user_id)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM '.TBL_MESSAGE_RECORD.' WHERE ((from_user_id = :from_user_id AND to_user_id = :to_user_id)
            OR (from_user_id = :to_user_id AND to_user_id = :from_user_id))
            ORDER BY arrived_time ASC';
    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':from_user_id', $from_user_id, PDO::PARAM_INT);
      $st->bindValue(':to_user_id', $to_user_id, PDO::PARAM_INT);
      $st->execute();
      $message = array();
      foreach( $st->fetchAll() as $row)
      {
        $message[] = new MessageRecord($row);
      }
      parent::disconnect($conn);
      return $message;
    } catch(PDOException $e) {
      parent::disconnect($conn);
      die('Query failed: ' . $e->getMessage());
    }
  }
  public static function getNewMessage($from_user_id, $to_user_id)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM '.TBL_MESSAGE_RECORD.' WHERE (from_user_id = :from_user_id AND to_user_id = :to_user_id AND customer_has_viewed = 0)
            OR (from_user_id = :to_user_id AND to_user_id = :from_user_id AND customer_has_viewed = 0)
            ORDER BY arrived_time ASC';
    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':from_user_id', $from_user_id, PDO::PARAM_INT);
      $st->bindValue(':to_user_id', $to_user_id, PDO::PARAM_INT);
      $st->execute();
      $message = array();
      foreach( $st->fetchAll() as $row)
      {
        $message[] = new MessageRecord($row);
      }
      parent::disconnect($conn);
      return $message;
    } catch(PDOException $e) {
      parent::disconnect($conn);
      die('Query failed: ' . $e->getMessage());
    }
  }
  public static function updateMessageStatus($from_user_id, $to_user_id)
  {
    $conn = parent::connect();
    $sql = 'UPDATE '.TBL_MESSAGE_RECORD.' SET customer_has_viewed = 1 WHERE (from_user_id = :from_user_id AND to_user_id = :to_user_id)
            OR (from_user_id = :to_user_id AND to_user_id = :from_user_id)';
    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':from_user_id', $from_user_id, PDO::PARAM_INT);
      $st->bindValue(':to_user_id', $to_user_id, PDO::PARAM_INT);
      $st->execute();
      parent::disconnect($conn);
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }
  public function addMessage()
  {
    $conn = parent::connect();
    $sql = 'INSERT INTO '.TBL_MESSAGE_RECORD.' (to_user_id, from_user_id, messages, is_image, arrived_time, admin_has_viewed, customer_has_viewed)
            VALUES (:to_user_id, :from_user_id, :messages, :is_image, NOW(), 0, 0)';
    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':to_user_id', $this->data['to_user_id'], PDO::PARAM_INT);
      $st->bindValue(':from_user_id', $this->data['from_user_id'], PDO::PARAM_INT);
      $st->bindValue(':messages', $this->data['messages'], PDO::PARAM_STR);
      $st->bindValue(':is_image', $this->data['is_image'], PDO::PARAM_STR);
      $st->execute();
      $id = $conn->lastInsertId();
      parent::disconnect($conn);
      return $id;
    }catch (PDOException $e) {
      parent::disconnect($conn);
      die('Query failed: ' . $e->getMessage());
    }
  }
  public function updatePhotoName()
  {
    $conn = parent::connect();
    $sql = 'UPDATE ' .TBL_MESSAGE_RECORD. ' SET messages = :messages WHERE id = :id ';
    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':messages', $this->data['messages'], PDO::PARAM_STR);
      $st->bindValue(':id', $this->data['id'], PDO::PARAM_INT);
      $st->execute();
      parent::disconnect($conn);
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }
}

?>
