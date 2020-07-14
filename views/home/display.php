<?php
displayPageHeader('Home | ' . WEB_NAME);
displayHomeNavigation();
 ?>
  <div class="ssn_loader">
    <div class="triple-spinner"></div>
  </div>
<section class="wp-home">
 <section class="wp-home-page-container">
   <?php
  $customer_account = UsersAccount::getCustomerAccountById($_SESSION['merchant_customer_account']->getValueEncoded('id'));
  $latest_exchange_rate = ExchangeRate::getLatestExchangeRate();
  $membership_id = $customer_account->getValueEncoded('membership_id');
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
    default:
      // code...
      break;
  }
   ?>
   <div class="wp-header-user-name">
     <i class="fas fa-user-circle"></i>
     <?php echo $customer_account->getValueEncoded('username') ?>
   </div>

   <div class="wp-home-page">
    <div class="wp-customer-details">
     <div class="wp-user-name">
       <i class="fas fa-user-circle"></i>
       <?php echo $customer_account->getValueEncoded('username') ?>
     </div>

     <div class="wp-user-balance">
      <div class="wp-wallet-icon">
        <i class="fas fa-wallet"></i>
      </div>
      <div>
       <h2>Balance Left On My Account</h2>
       <span id="user-balance">
        <span><?php echo number_format($customer_account->getValueEncoded('balance'), 2) ?></span> &nbsp;MMK
       </span>
      </div>
     </div>

     <div class="wp-user-point">
      <div class="wp-membership-icon <?php echo $membership_icon ?>" title="<?php echo $membership_icon ?>">
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
      </div>
      <div>
       <h2>Points I Have</h2>
       <span id="user-point">
        <span><?php echo number_format($customer_account->getValueEncoded('point')/1000) ?></span> &nbsp;Points
       </span>
      </div>
     </div>
   </div>

   <div class="wp-new-order-and-detail-container">
      <div class="wp-new-order-container">
        <h3>Add New Order</h3>
        <span id="new-order-close"><i class="fas fa-times"></i></span>
        <div class="wp-new-order-back"></div>
        <div class="wp-new-order">
         <div class="wp-new-order-header"><h2>Add New Order</h2><i class="fas fa-shapes"></i></div>
         <form class="order-form-js" action="<?php echo URL ?>/order/add_new_order/" method="post">
           <input type="hidden" name="customer_id" value="<?php echo $customer_account->getValueEncoded('id') ?>">
           <input type="hidden" name="exchange_rate" value="<?php echo $latest_exchange_rate->getValueEncoded('mmk') ?>">
          <div class="new-order-input new-order-textarea">
            <i class="fas fa-link"></i>
            <textarea name="product_link" placeholder="Product Link"></textarea>
            <span>Product Link</span>
          </div>
          <div class="new-order-input">
            <i class="fas fa-shapes"></i>
            <input type="number" name="quantity" placeholder="Quantity">
            <span>Quantity</span>
          </div>
          <div class="new-order-input">
            <i class="fas fa-money-bill-alt"></i>
            <input type="text" name="cupon_code" placeholder="Coupon code">
            <span>Coupon code</span>
          </div>
          <div class="new-order-input new-order-textarea">
            <i class="fas fa-pencil-alt"></i>
            <textarea name="remark" placeholder="Remark"></textarea>
            <span>Remark</span>
          </div>
          <div class="new-order-input">
            <i class="fas fa-hand-holding-usd"></i>
            <input type="text" name="price" placeholder="Unit Price">
            <span>Unit Price ($)</span>
          </div>
           <input type="submit" value="Add">
         </form>
        </div>
      </div>

      <div class="wp-information-detail-container">
       <h2>Information Details</h2>
        <div class="wp-information-detail">
         <div class="wp-customer-phone-container">
          <div id="customer-phone-icon">
            <i class="fas fa-phone"></i>
          </div>
          <div class="wp-customer-phone">
           <span>Phone</span>
           <span><?php echo $customer_account->getValueEncoded('phone') ?></span>
          </div>
         </div>

         <div class="wp-customer-id-container">
           <div id="customer-id-icon">
            <i class="fas fa-id-badge"></i>
           </div>
           <div class="wp-customer-id">
            <span>Id</span>
            <span><?php echo $customer_account->getValueEncoded('id') ?></span>
           </div>
         </div>

         <div class="wp-customer-address-container">
           <div id="customer-address-icon">
            <i class="fas fa-map-marker-alt"></i>
           </div>
           <div class="wp-customer-address">
            <span>Address</span>
            <span><?php echo $customer_account->getValueEncoded('address') ?></span>
           </div>
         </div>
        </div>
      </div>
   </div>

   <div class="wp-exchange-rate-container">
     <h2>Today Exchange Rate</h2>
     <div class="wp-exchange-rate">
      <div class="wp-us-exchange-rate">
       <span>USD</span>
       <span>1&nbsp;<i class="fas fa-dollar-sign"></i></span>
      </div>

      <div id="exchange-icon"><i class="fas fa-exchange-alt"></i></div>

      <div class="wp-mmk-exchange-rate">
       <span>MMK</span>
       <span>
        <span id="wp-mmk-amout"><?php echo $latest_exchange_rate->getValueEncoded('mmk') ?></span>&nbsp;kyats
       </span>
      </div>
     </div>
      <img src="<?php echo FILE_URL ?>/logos/exchangerateline.png" alt="">
   </div>

   <div class="wp-calculate-order-container hk-est-calc-trigger-js">
    <i class="fas fa-file-invoice-dollar"></i>
    <span>Order Estimate Calculator</span>
   </div>

   <div class="wp-contact-admin-container">
     <a href="<?php echo URL ?>/conversation/">
       <img src="<?php echo FILE_URL ?>/logos/chat.png" alt="">
       <h2>Contact Admin</h2>
       <span class="wp-msg-count"><span class="msg_count"></span></span>
     </a>
   </div>
   <div class="sound">

   </div>

  </div>
 </section>
 <script src="<?php echo FILE_URL ?>/scripts/jquery.validate.min.js" charset="utf-8"></script>
 <script src="<?php echo FILE_URL ?>/scripts/home.js" charset="utf-8"></script>
<?php
displayPageFooter();
?>
</section>
