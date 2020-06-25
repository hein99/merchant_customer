<?php
displayPageHeader('Order List | ' . WEB_NAME);
displayOtherNavigation('order');
 ?>
 <section class="order-wrap-js">
   <div class="ssn_loader">
     <div class="triple-spinner"></div>
   </div>
   <button type="button" class="order-from-btn-js">New Order</button>
   <ul class="orders-list-js">

   </ul>

  <div class="order-detail-js">

  </div>
</section>
<script src="<?php echo FILE_URL ?>/scripts/order.js" charset="utf-8"></script>
<?php
displayPageFooter();
?>
