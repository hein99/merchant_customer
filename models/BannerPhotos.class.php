<?php
class BannerPhotos extends DataObject
{
  protected $data = array(
    'id' => '',
    'photo_name' => '',
    'link' => '',
    'order_no' => ''
  );

  public static function getAllPhotos()
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_BANNER_PHOTOS . ' ORDER BY order_no';
    try {
      $st = $conn->query($sql);
      $photos = array();
      foreach ($st->fetchAll() as $row) {
        $photos[] = new BannerPhotos($row);
      }
      parent::disconnect($conn);
      return $photos;
    }catch(PDOException $e) {
      parent::disconnect($conn);
      die('Query failed: '.$e->getMessage());
    }
  }

}
 ?>
