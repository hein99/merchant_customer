<?php
displayPageHeader('Statement | ' . WEB_NAME);
displayOtherNavigation('statement');

$customer_statements = CustomerStatement::getCustomerStatement($_SESSION['merchant_customer_account']->getValueEncoded('id'));
$customer_acc = UsersAccount::getCustomerAccountById($_SESSION['merchant_customer_account']->getValueEncoded('id'));
 ?>
 <div class="ssn_loader" >
   <div class="triple-spinner" ></div>
 </div>

 <section class="ky-bill-history" >
   <div class="ky-total-balance-container" >
     <div class="">
       <h1 class="ky-balance-header" >Total Balance</h1>
       <span class="ky-total-balance" ><?php echo number_format($customer_acc->getValueEncoded('balance'), 2) ?>&nbsp;&nbsp;MMK</span>
     </div>
   </div>
   <h1 class="ky-transaction-history-header" >Transaction History</h1>
   <div class="ky-transaction-history-container" >
     <div class="">
       <table>
         <thead>
           <tr>
             <th>Date</th>
             <th>About</th>
             <th>Amount</th>
           </tr>
         </thead>
         <tbody>
           <?php foreach ($customer_statements as $customer_statement): ?>
             <tr>
               <td><?php echo $customer_statement->getValueEncoded('created_date'); ?></td>
               <td><?php echo $customer_statement->getValueEncoded('about'); ?></td>
               <td class="<?php echo $customer_statement->getValue('amount_status') ? 'plus' : 'minus'?>"><span><?php echo $customer_statement->getValue('amount_status') ? '+' : '-'?></span><?php echo number_format($customer_statement->getValueEncoded('amount'), 2); ?>&nbsp;Ks</td>
             </tr>
           <?php endforeach; ?>
         </tbody>
       </table>
     </div>
   </div>
 </section>
<?php
displayPageFooter();
?>
