<?php
displayPageHeader('Customer List | ' . WEB_NAME);
displayOtherNavigation('conversation');
 ?>
 <section class="sn_chatbox_container">
   <div class="ssn_loader">
     <div class="triple-spinner"></div>
   </div>
   <!-- <h1 class="sn_conversation_header">Conversation</h1> -->
   <div id="user_model_details"></div>
 </section>

<script>
 <?php $admin_id = UsersAccount::getAdmin() ?>
  var ADMIN_ID = <?php echo $admin_id->getValue('id') ?>;
  var CUSTOMER_ID = <?php echo $_SESSION['merchant_customer_account']->getValue('id'); ?>;
</script>
 <script src="<?php echo FILE_URL ?>/scripts/conversation.js" charset="utf-8"></script>
<?php
displayPageFooter(false);
?>
