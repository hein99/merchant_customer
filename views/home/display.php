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

  <!-- ****** Greeting article-->
  <article class="">
    <div class="">
      <!-- ****** Membership logo -->
      <div class="">
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
      <!-- End of membership logo -->
      <p>Hello,&nbsp;<?php echo $customer_account->getValueEncoded('username') ?>!</p>
      <p><?php echo number_format($customer_account->getValueEncoded('balance'), 2) ?>&nbsp;Ks</p>
      <p><?php echo number_format($customer_account->getValueEncoded('point')/1000) ?>&nbsp;Points</p>
    </div>

    <button type="button">Estimate Calculator</button>
  </article>
  <!-- End of greeting article-->

  <!-- ****** Banner article-->
  <article class="">
    <ul>
      <?php foreach ($banner_photos as $banner_photo): ?>
        <li>
          <a href="<?php echo $banner_photo->getValueEncoded('link') ?>" target="_blank">
            <img src="<?php echo OTHER_FILE_URL ?>/photos/banner/id_<?php echo $banner_photo->getValue('id') . '_' . $banner_photo->getValueEncoded('photo_name')?>" alt="<?php echo $banner_photo->getValueEncoded('photo_name') ?>">
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </article>
  <!-- End of banner article-->

  <!-- ****** Float text article-->
  <article class="">
    <p><?php echo $float_text->getValueEncoded('text') ?></p>
  </article>
  <!-- End of float text article-->

  <!-- ****** Exchange rate article-->
  <article class="">
    <h1>Today Exchange Rate</h1>

    <span><?php echo CURRENCY_ABBR ?></span>
    <span>1&nbsp;<?php echo CURRENCY_SYMBOL ?></span>

    <i class="fas fa-exchange-alt"></i>

    <span>MMK</span>
    <span><?php echo $latest_exchange_rate->getValueEncoded('mmk') ?>&nbsp;Ks</span>
  </article>
  <!-- End of exchange rate article-->

  <!-- ****** Bank accounts article-->
  <article class="">
    <h1>Bank Accounts</h1>
    <table>
      <thead>
        <tr>
          <th>Payment Method</th>
          <th>Account Name</th>
          <th>Account Number</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>KBZ</td>
          <td>U Min Thaw Han</td>
          <td><input type="text" class="hk-copy-text-js" value="09130103301085101"><button class="hk-copy-text-js" title="Copy"><i class="far fa-copy"></i></button><span class="animate__animated animate__bounceOut">copied</span></td>
        </tr>
        <tr>
          <td>CB</td>
          <td>U Min Thaw Han</td>
          <td><input type="text" class="hk-copy-text-js" value="0084600500049085"><button class="hk-copy-text-js" title="Copy"><i class="far fa-copy"></i></button><span class="animate__animated animate__bounceOut">copied</span></td>
        </tr>
        <tr>
          <td>AYA</td>
          <td>U Min Thaw Han</td>
          <td><input type="text" class="hk-copy-text-js" value="0192201010061371"><button class="hk-copy-text-js" title="Copy"><i class="far fa-copy"></i></button><span class="animate__animated animate__bounceOut">copied</span></td>
        </tr>
        <tr>
          <td>KBZ Pay</td>
          <td>&nbsp;</td>
          <td><input type="text" class="hk-copy-text-js" value="09974330882"><button class="hk-copy-text-js" title="Copy"><i class="far fa-copy"></i></button><span class="animate__animated animate__bounceOut">copied</span></td>
        </tr>
        <tr>
          <td>Wave Money</td>
          <td>&nbsp;</td>
          <td><input type="text" class="hk-copy-text-js" value="09974330882"><button class="hk-copy-text-js" title="Copy"><i class="far fa-copy"></i></button><span class="animate__animated animate__bounceOut">copied</span></td>
        </tr>
      </tbody>
    </table>
  </article>
  <!-- End of bank accounts article-->

  <!-- ****** Membership chart article-->
  <article class="">
    <h1>Membership Chart</h1>
    <?php foreach ($membership_definition as $row): ?>
      <section>
        <h1><?php echo $row->getValueEncoded('name') ?></h1>
        <p>
          <span><?php echo $row->getValueEncoded('percentage') ?>%</span>
          <span>OFF</span>
        </p>
        <p><?php echo $row->getValueEncoded('definition') ?></p>
      </section>
    <?php endforeach; ?>
  </article>
  <!-- End of membership chart article-->

 <script src="<?php echo FILE_URL ?>/scripts/jquery.validate.min.js" charset="utf-8"></script>
 <script src="<?php echo FILE_URL ?>/scripts/home.js" charset="utf-8"></script>
<?php
displayPageFooter();
?>
</section>
