<?php
class FloatText extends DataObject
{
  protected $data = array(
    'id' => '',
    'text' => ''
  );

  public static function getText()
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_FLOAT_TEXT . ' WHERE id = 1';
    try {
      $st = $conn->query($sql);
      $row = $st->fetch();
      parent::disconnect($conn);
      if($row) return new FloatText($row);
    }catch(PDOException $e) {
      parent::disconnect($conn);
      die('Query failed: '.$e->getMessage());
    }
  }
}
 ?>
