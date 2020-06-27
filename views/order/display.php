<?php
displayPageHeader('Order List | ' . WEB_NAME);
displayOtherNavigation('order');
 ?>
 <div class="ssn_loader">
   <div class="triple-spinner"></div>
 </div>
 <section class="order-wrap-js">
   <ul class="orders-list-js"></ul>

  <div class="order-detail-js"></div>
  <div class="hk-empty-order-detail">Empty</div>
</section>
<script src="<?php echo FILE_URL ?>/scripts/order.js" charset="utf-8"></script>
<?php
displayPageFooter();
?>
