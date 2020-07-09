<?php
class Membership extends DataObject
{
  protected $data = array(
    'id' => '',
    'name' => '',
    'definition' => '',
    'percentage' => '',
    'modified_date' => ''
  );

  public static function getAllMembership()
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_MEMBERSHIP;

    try {
      $st = $conn->query($sql);
      $orders = array();
      foreach ( $st->fetchAll() as $row ) {
        $orders[] = new Membership($row);
      }
      parent::disconnect($conn);
      return $orders;
    } catch(PDOException $e) {
      parent::disconnect($conn);
      die('Query failed: ' . $e->getMessage());
    }
  }

  public static function getMembershipById($id)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_MEMBERSHIP . ' WHERE id=:id';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':id', $id, PDO::PARAM_INT);
      $st->execute();
      $row =$st->fetch();
      parent::disconnect($conn);
      if($row) return new Membership($row);
    } catch(PDOException $e) {
      parent::disconnect($conn);
      die('Query failed: ' . $e->getMessage());
    }
  }

}
 ?>
