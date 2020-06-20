<?php
displayPageHeader('Statement | ' . WEB_NAME);
displayOtherNavigation('statement');

$customer_statements = CustomerStatement::getCustomerStatement($_SESSION['merchant_customer_account']->getValueEncoded('id'));
$customer_acc = UsersAccount::getCustomerAccountById($_SESSION['merchant_customer_account']->getValueEncoded('id'));
 ?>
 <section>
   <div class="">
     <h1>Totol Balance</h1>
     <span><?php echo $customer_acc->getValueEncoded('balance'); ?></span>
   </div>
   <div class="">
     <h1>Transaction Histories</h1>
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
             <td class="<?php echo $customer_statement->getValue('amount_status') ? 'plus' : 'minus'?>"><span><?php echo $customer_statement->getValue('amount_status') ? '+' : '-'?></span><?php echo $customer_statement->getValueEncoded('amount'); ?></td>
           </tr>
         <?php endforeach; ?>
       </tbody>
       <tbody>

       </tbody>
     </table>
   </div>
 </section>
<?php
displayPageFooter();
?>
