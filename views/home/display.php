<?php
displayPageHeader('Home | ' . WEB_NAME);
displayHomeNavigation();

$customer_account = UsersAccount::getCustomerAccountById($_SESSION['merchant_customer_account']->getValueEncoded('id'));
$latest_exchange_rate = ExchangeRate::getLatestExchangeRate();
$banner_photos = BannerPhotos::getAllPhotos();
$float_text = FloatText::getText();
$membership_id = $customer_account->getValueEncoded('membership_id');
$membership_definition = Membership::getAllMembership();
switch ($membership_id) {
  case '1':
    $membership_icon = 'silver';
    break;
  case '2':
    $membership_icon = 'gold';
    break;
  case '3':
    $membership_icon = 'platinum';
    break;
  case '4':
    $membership_icon = 'diamond';
    break;
}
 ?>
 <div class="ssn_loader">
   <div class="triple-spinner"></div>
 </div>

 <main class="ky-home">
   <!-- ****** Greeting article-->
   <article class="ky-home-customerInfo-container">
     <a href="<?php echo URL ?>/membership/"><?php
       switch ($membership_icon) {
         case 'silver':
         case 'gold':
           echo '<i class="fas fa-award"></i>';
           break;
         case 'platinum':
           echo '<i class="fas fa-medal"></i>';
           break;
         case 'diamond':
           echo '<i class="fas fa-gem"></i>';
         break;
       }
       ?></a>
     <div class="ky-customerInfo">
       <span id="ky-home-greeting">Hello,&nbsp;<?php echo $customer_account->getValueEncoded('username') ?>!</span>
       <span id="ky-home-balance"><?php echo number_format($customer_account->getValueEncoded('balance'), 2) ?>&nbsp;Ks</span>
       <span id="ky-home-points"><?php echo number_format($customer_account->getValueEncoded('point')/1000) ?>&nbsp;Points</span>
     </div>
     <button type="button" class="hk-est-calc-trigger-js"><span class="material-icons">calculate</span><span>Estimate Calculator</span></button>
   </article>
   <!-- End of greeting article-->

   <!-- ****** Banner article-->
   <article class="ky-swiper-container">
     <div class="swiper-container">
       <ul class="swiper-wrapper">
         <?php foreach ($banner_photos as $banner_photo): ?>
           <li class="swiper-slide">
             <a href="<?php echo $banner_photo->getValueEncoded('link') ?>" target="_blank">
               <img src="<?php echo OTHER_FILE_URL ?>/photos/banner/id_<?php echo $banner_photo->getValue('id') . '_' . $banner_photo->getValueEncoded('photo_name')?>" alt="<?php echo $banner_photo->getValueEncoded('photo_name') ?>">
             </a>
           </li>
         <?php endforeach; ?>
       </ul>
       <div class="swiper-pagination ky-swiper-pagination"></div>
       <span class="swiper-button-next"><i class="fas fa-angle-right"></i></span>
       <span class="swiper-button-prev"><i class="fas fa-angle-left"></i></span>
     </div>
   </article>
   <!-- End of banner article-->

   <!-- ****** Float text article-->
   <article class="ky-float-text-container">
     <p><?php echo $float_text->getValueEncoded('text') ?></p>
   </article>
   <!-- End of float text article-->

   <!-- ****** Exchange rate and contact admin article-->
   <article class="ky-exchange-rate-contact-admin-container">
     <section class="ky-exchange-rate-container">
       <h1>Today Exchange Rate</h1>
       <div class="ky-rate-container">
         <div class="ky-us-rate">
           <span><?php echo CURRENCY_ABBR ?></span>
           <span>1&nbsp;<?php echo CURRENCY_SYMBOL ?></span>
         </div>
         <div class="ky-exchange-icon">
           <i class="fas fa-exchange-alt"></i>
         </div>
         <div class="ky-mm-rate">
           <span>MMK</span>
           <span><?php echo $latest_exchange_rate->getValueEncoded('mmk') ?>&nbsp;<span id="ky-mm-unit">kyats</span></span>
         </div>
       </div>
     </section>
     <section class="ky-contact-admin-container">
       <a href="<?php echo URL ?>/conversation/">
         <img src="<?php echo FILE_URL ?>/logos/chat.png" alt="">
         <h1>Contact Admin</h1>
         <span class="wp-msg-count"><span class="msg_count"></span></span>
       </a>
     </section>
     <section class="ky-accounts-accordion">
       <header class="ky-accordion-header">
         <h1>Bank Accounts</h1>
       </header>
       <div class="ky-accordion-body">
         <table>
           <thead>
             <tr>
               <th>Account Name</th>
               <th>Payment Method</th>
               <th>Account Number</th>
             </tr>
           </thead>
           <tbody>
             <tr>
               <td>U Min Thaw Han</td>
               <td>KBZ</td>
               <td><input type="text" class="hk-copy-text-js" value="09130103301085101"><button class="hk-copy-text-js" title="Copy"><i class="fas fa-copy"></i></button><span class="animate__animated animate__bounceOut">copied</span></td>
             </tr>
             <tr>
               <td>U Min Thaw Han</td>
               <td>CB</td>
               <td><input type="text" class="hk-copy-text-js" value="0084600500049085"><button class="hk-copy-text-js" title="Copy"><i class="fas fa-copy"></i></button><span class="animate__animated animate__bounceOut">copied</span></td>
             </tr>
             <tr>
               <td>U Min Thaw Han</td>
               <td>AYA</td>
               <td><input type="text" class="hk-copy-text-js" value="0192201010061371"><button class="hk-copy-text-js" title="Copy"><i class="fas fa-copy"></i></button><span class="animate__animated animate__bounceOut">copied</span></td>
             </tr>
             <tr>
               <td>&nbsp;</td>
               <td>KBZ Pay</td>
               <td><input type="text" class="hk-copy-text-js" value="09974330882"><button class="hk-copy-text-js" title="Copy"><i class="fas fa-copy"></i></button><span class="animate__animated animate__bounceOut">copied</span></td>
             </tr>
             <tr>
               <td>&nbsp;</td>
               <td>Wave Money</td>
               <td><input type="text" class="hk-copy-text-js" value="09974330882"><button class="hk-copy-text-js" title="Copy"><i class="fas fa-copy"></i></button><span class="animate__animated animate__bounceOut">copied</span></td>
             </tr>
           </tbody>
         </table>
       </div>
     </section>
   </article>
   <!-- End of exchange rate and contact admin article-->

   <!-- ****** Membership chart article-->
   <article class="ky-membership-accordion-container">
     <section class="ky-membership-accordion">
       <header class="ky-accordion-header ky-membership-accordion-header">
         <h1>Membership Chart</h1>
       </header>
       <section class="ky-accordion-body ky-membership-accordion-body">
         <div class="ky-membership-tab-header">
           <?php foreach ($membership_definition as $row): ?>
             <div class="ky-membership-tab">
               <i class="fas fa-gem"></i>
               <span><?php echo $row->getValueEncoded('name') ?></span>
             </div>
           <?php endforeach; ?>
         </div>
         <div class="ky-membership-tab-indicator"></div>
         <?php foreach ($membership_definition as $row): ?>
           <div class="ky-membership">
             <div class="ky-membership-head">
               <i class="fas fa-gem"></i>
               <h1><?php echo $row->getValueEncoded('name') ?></h1>
             </div>
             <div class="ky-membership-body">
               <span class="ky-percentage-container"><span><?php echo $row->getValueEncoded('percentage') ?>%</span><span>OFF</span></span>
               <p><?php echo $row->getValueEncoded('definition') ?></p>
             </div>
           </div>
         <?php endforeach; ?>
       </section>
     </section>
   </article>
   <!-- End of membership chart article-->

   <?php
   displayPageFooter();
   ?>
 </main>

 <script src="<?php echo FILE_URL ?>/scripts/swiper.min.js" charset="utf-8"></script>
 <script src="<?php echo FILE_URL ?>/scripts/jquery.validate.min.js" charset="utf-8"></script>
 <script src="<?php echo FILE_URL ?>/scripts/home.js" charset="utf-8"></script>
