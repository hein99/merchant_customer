<?php
displayPageHeader('Settings | ' . WEB_NAME);
displayOtherNavigation('settings');
 ?>
 <section>
   <div class="ssn_loader">
     <div class="triple-spinner"></div>
   </div>
   <div class="">
     <i class="fas fa-user-circle"></i>
     <span><?php echo $_SESSION['merchant_customer_account']->getValueEncoded('username') ?></span>
   </div>
   <div class="">
     <img src="<?php echo FILE_URL ?>/logos/personal-information.png" alt="" style="width:100px;">
     <h2>Change Information</h2>
     <form class="" action="<?php echo URL ?>/settings/change_info" method="post">
       <input type="hidden" name="id" value="<?php echo $_SESSION['merchant_customer_account']->getValueEncoded('id') ?>">
       <input type="text" name="username" value="<?php echo $_SESSION['merchant_customer_account']->getValueEncoded('username') ?>" placeholder="Username">
       <input type="number" name="phone" value="<?php echo $_SESSION['merchant_customer_account']->getValueEncoded('phone') ?>" placeholder="Phone">
       <input type="text" name="address" value="<?php echo $_SESSION['merchant_customer_account']->getValueEncoded('address') ?>" placeholder="Address">
       <input type="submit" value="CHANGE">
     </form>
   </div>
   <div class="">
     <img src="<?php echo FILE_URL ?>/logos/password.png" alt="" style="width:100px;">
     <h2>Change Password</h2>
     <form class="" action="<?php echo URL ?>/settings/change_password" method="post">
       <input type="hidden" name="phone" value="<?php echo $_SESSION['merchant_customer_account']->getValueEncoded('phone') ?>">
       <input type="password" name="current_password" placeholder="Current Password">
       <input type="password" name="new_password1" placeholder="New Password">
       <input type="password" name="new_password2" placeholder="Confirm Password">
       <input type="submit" value="CHANGE">
     </form>
   </div>
 </section>
<?php
displayPageFooter();
?>
