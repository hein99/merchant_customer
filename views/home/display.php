<?php
displayPageHeader('Home | ' . WEB_NAME);
displayHomeNavigation();
 ?>
 <section>
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
   <div class="">
     <div class="">
       <i class="fas fa-user-circle"></i>
       <?php echo $customer_account->getValueEncoded('username') ?>
     </div>
     <div class="">
       <h2 class="">Balance Left On My Account</h2>
       <i class="fas fa-wallet"></i>
       <?php echo $customer_account->getValueEncoded('balance') ?> MMK
     </div>
     <div class="">
       <h2 class="">Points I Have</h2>
       <span class="<?php echo $membership_icon ?>"><?php echo ($membership_icon == 'diamond') ? '<i class="fas fa-gem"></i>': '<i class="fas fa-medal"></i>' ?></span>
       <?php echo $customer_account->getValueEncoded('point') ?> Points
     </div>
   </div>
   <br/>
   <div class="">
     <h2>Today Exchange Rate</h2>
     <div class="">
       USD
       <span>1&nbsp;<i class="fas fa-dollar-sign"></i></span>
       <i class="fas fa-exchange-alt"></i>
       MMK
       <?php echo $latest_exchange_rate->getValueEncoded('mmk') ?><span>kyats</span>
     </div>
     <img src="<?php echo FILE_URL ?>/logos/exchangerateline.png" alt="" style="width:200px;">
   </div>
   <br/>
   <div class="">
     <a href="<?php echo URL ?>/conversation/">
       <h2>Contact Admin</h2>
       <span id="messages_count"></span>
       <img src="<?php echo FILE_URL ?>/logos/chat.png" alt="" style="width:30px;">
     </a>
   </div>
   <br/>
   <div class="">
     <h2>Add New Order</h2>
     <form class="" action="<?php echo URL ?>/order/add_new_order/" method="post">
       <input type="hidden" name="customer_id" value="<?php echo $customer_account->getValueEncoded('id') ?>">
       <input type="text" name="product_link" placeholder="Product Link">
       <input type="text" name="remark" placeholder="Remark">
       <input type="number" name="quantity" placeholder="Quantity">
       <input type="number" name="price" placeholder="Unit Price ($)">
       <input type="submit" value="Add">
     </form>
   </div>
   <br/>
   <div class="">
     <h2>Information Details</h2>
     <div class="">
       <h2>Phone</h2>
       <i class="fas fa-phone"></i>
       <?php echo $customer_account->getValueEncoded('phone') ?>
     </div>
     <div class="">
       <h2>Id</h2>
       <i class="fas fa-id-badge"></i>
       <?php echo $customer_account->getValueEncoded('id') ?>
     </div>
     <div class="">
       <h2>Address</h2>
       <i class="fas fa-map-marker-alt"></i>
       <?php echo $customer_account->getValueEncoded('address') ?>
     </div>
   </div>
 </section>
<?php
displayPageFooter();
?>
