<?php
displayPageHeader('Membership | ' . WEB_NAME);
displayOtherNavigation('membership');
 ?>
 <section class="sn-membership-container">
   <?php foreach($memberships as $membership) : ?>
     <div class="sn-membership">
       <div class="sn-icon-container">
         <?php echo chooseMembership($membership->getValueEncoded('id')) ?>
         <span><?php echo $membership->getValueEncoded('name') ?></span>
       </div>
       <div class="sn-percentage-container">
         <div class="sn-percentage"><?php echo $membership->getValueEncoded('percentage') ?>%</div>
       </div>
       <div class="sn-definition-container">
         <?php echo $membership->getValueEncoded('definition') ?>
       </div>
     </div>
   <?php endforeach; ?>
 </section>
<?php
displayPageFooter();

function chooseMembership($membership_id)
{
  $membership_name = '';
  // change from membership id to membership name
  switch($membership_id)
  {
    case 1:
      $membership_name = ' <div class="sn-silver-icon">
         <i class="fas fa-award"></i></div>';
      break;

    case 2:
      $membership_name = '<div class="sn-gold-icon">
         <i class="fas fa-award"></i></div>';
      break;

    case 3:
      $membership_name = '<div class="sn-platinum-icon">
         <i class="fas fa-medal"></i></div>';
      break;

    case 4:
      $membership_name = '<div class="sn-diamond-icon">
        <i class="fas fa-gem"></i>
       </div>';
      break;

    default:
      exit();
  }
  return $membership_name;
}
?>
