<?php
displayPageHeader('Settings | ' . WEB_NAME);
displayOtherNavigation('settings');
 ?>
 <section class="sn-container">
   <div class="ssn_loader">
     <div class="triple-spinner"></div>
   </div>
   <div class="sn-user-name">
     <i class="fas fa-user-circle"></i>
     <div><?php echo $_SESSION['merchant_customer_account']->getValueEncoded('username') ?></div>
   </div>
   <div class="sn_settings_container">
     <div class="sn_change_tab">
       <span id="sn_change_information">Change Information</span>
       <span id="sn_change_password">Change Password</span>
     </div>
     <div class="sn_change_info_form">
       <img src="<?php echo FILE_URL ?>/logos/personal-information.png" alt="">
       <h2>Change Information</h2>
       <form class="" action="<?php echo URL ?>/settings/change_info" method="post">
         <input type="hidden" name="id" value="<?php echo $_SESSION['merchant_customer_account']->getValueEncoded('id') ?>">
         <div class="input">
           <span><i class="fas fa-user"></i></span>
           <input type="text" name="username" value="<?php echo $_SESSION['merchant_customer_account']->getValueEncoded('username') ?>" placeholder="Username">
         </div>
         <div class="input">
           <span><i class="fas fa-phone"></i></span>
           <input type="number" name="phone" value="<?php echo $_SESSION['merchant_customer_account']->getValueEncoded('phone') ?>" placeholder="Phone">
         </div>
         <div class="input">
           <span><i class="fas fa-address-book"></i></span>
           <input type="text" name="address" value="<?php echo $_SESSION['merchant_customer_account']->getValueEncoded('address') ?>" placeholder="Address">
         </div>
         <div class="change">
           <input type="submit" value="CHANGE">
         </div>
       </form>
     </div>
     <div class="sn_change_password_form">
       <img src="<?php echo FILE_URL ?>/logos/password.png" alt="">
       <h2>Change Password</h2>
       <form class="" action="<?php echo URL ?>/settings/change_password" method="post">
         <input type="hidden" name="phone" value="<?php echo $_SESSION['merchant_customer_account']->getValueEncoded('phone') ?>">
         <div class="input">
           <span><i class="fas fa-unlock"></i></span>
           <input type="password" name="current_password" placeholder="Current Password">
         </div>
         <div class="input">
           <span><i class="fas fa-lock"></i></span>
           <input type="password" name="new_password1" placeholder="New Password">
         </div>
         <div class="input">
           <span><i class="fas fa-lock"></i></span>
           <input type="password" name="new_password2" placeholder="Confirm Password">
         </div>
         <div class="change">
           <input type="submit" value="CHANGE">
         </div>
       </form>
     </div>
   </div>
 </section>
 <script>

 </script>
 <script src="<?php echo FILE_URL ?>/scripts/setting.js" charset="utf-8"></script>
<?php
displayPageFooter();
?>
