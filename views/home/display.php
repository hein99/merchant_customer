<?php
displayPageHeader('Home | ' . WEB_NAME);
displayHomeNavigation();
 ?>
 <div class="ssn_loader">
   <div class="triple-spinner"></div>
 </div>

 <section class="ky-home">
   <div class="ky-home-customerInfo-container">
     <i class="fas fa-award"></i>
     <div class="ky-customerInfo">
       <span id="ky-home-greeting">Hello, David!</span>
       <span id="ky-home-balance">50000 Ks</span>
     </div>
     <button type="button" name="button"><span class="material-icons">calculate</span><span>Calculate Order</span></button>
   </div>
   <div class="ky-swiper-container">
     <div class="swiper-container">
       <div class="swiper-wrapper">
         <div class="swiper-slide">
           <a href="#">
             <img src="<?php echo FILE_URL ?>/photos/banner_photos/sneaker.jpg" alt="sneaker photo">
           </a>
         </div>
         <div class="swiper-slide">
           <a href="#">
             <img src="<?php echo FILE_URL ?>/photos/banner_photos/coffee.jpg" alt="sneaker photo">
           </a>
         </div>
         <div class="swiper-slide">
           <a href="#">
             <img src="<?php echo FILE_URL ?>/photos/banner_photos/image.jpg" alt="sneaker photo">
           </a>
         </div>
       </div>
       <div class="swiper-pagination"></div>
       <span class="swiper-button-next"><i class="fas fa-angle-right"></i></span>
       <span class="swiper-button-prev"><i class="fas fa-angle-left"></i></span>
     </div>
   </div>
   <div class="ky-exchange-rate-contact-admin-container">
     <div class="ky-exchange-rate-container">
       <h3>Today Exchange Rate</h3>
       <div class="ky-rate-container">
         <div class="ky-us-rate">
           <span>USD</span>
           <span>1&nbsp;$</span>
         </div>
         <div class="ky-exchange-icon">
           <i class="fas fa-exchange-alt"></i>
         </div>
         <div class="ky-mm-rate">
           <span>MMK</span>
           <span>1500&nbsp;<span id="ky-mm-unit">kyats</span></span>
         </div>
       </div>
     </div>
     <div class="ky-contact-admin-container">
       <a href="#">
         <img src="<?php echo FILE_URL ?>/logos/chat.png" alt="">
         <h3>Contact Admin</h3>
         <span class="wp-msg-count"><span class="msg_count"></span></span>
       </a>
     </div>
   </div>
   <div class="ky-accounts-accordion">
     <div class="ky-accordion-header">
       <i class="fas fa-plus"></i>
       <h4>Bank Accounts</h4>
     </div>
     <div class="ky-accordion-body">
       <table>
         <thead>
           <tr>
             <th>Admin</th>
             <th>Payment</th>
             <th>Card Number</th>
           </tr>
         </thead>
         <tbody>
           <tr>
             <td>David</td>
             <td>KBZ Bank</td>
             <td>12898974<button><i class="fas fa-copy"></i></button></td>
           </tr>
           <tr>
             <td>David</td>
             <td>KBZ Bank</td>
             <td>1289897456783210<button><i class="fas fa-copy"></i></button></td>
           </tr>
           <tr>
             <td>David</td>
             <td>KBZ Bank</td>
             <td>1289897456783210<button><i class="fas fa-copy"></i></button></td>
           </tr>
         </tbody>
       </table>
     </div>
   </div>
 </section>

 <script src="<?php echo FILE_URL ?>/scripts/swiper.min.js" charset="utf-8"></script>
 <script src="<?php echo FILE_URL ?>/scripts/jquery.validate.min.js" charset="utf-8"></script>
 <script src="<?php echo FILE_URL ?>/scripts/home.js" charset="utf-8"></script>
<?php
displayPageFooter(false);
?>
