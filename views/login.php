<?php
require('../config.php');
require('../htmlstructureconfig.php');
require('../models/DataObject.class.php');
require('../models/UsersAccount.class.php');
require('../models/PasswordRequest.class.php');
session_start();

if( isset($_POST['action']) and $_POST['action'] == 'login')
{
  processLoginForm();
}
else if( isset($_POST['action']) and $_POST['action'] == 'forgot_password')
{
  processPasswordRequest();
}
else {
  displayLogin(array(), new UsersAccount(array()), '', true);
}

function displayLogin($errorMessages, $customerAccount, $message, $flag)
{
  $error_messages=$errorMessages;
  $customer_account=$customerAccount;
  $msg=$message;
  displayPageHeader('Login | ' .WEB_NAME, true);
?>
<div class="login-container">
  <div class="login-header">
    <span id="user-icon"><i class="fas fa-user-circle"></i></span>
    <span id="website-name">The Best Shop</span>
  </div>
  <div class="login-body">
<?php
  if($flag==true)
  {
    displayForgotPasswordForm($msg);
    displayLoginForm($error_messages, $customer_account);
  }
  elseif($flag==false)
  {
    displayForgotPasswordForm($msg);
  }
?>
  </div>
</div>
<script src="<?php echo FILE_URL ?>/scripts/jquery.validate.min.js" charset="utf-8"></script>
<script src="<?php echo FILE_URL ?>/scripts/login.js" charset="utf-8"></script>
<?php
  displayPageFooter(false);
}

function displayLoginForm($error_messages, $customer_account)
{
?>
  <div id="display-login">
    <span id="welcome" class="info-message">
    <?php
    if($error_messages)
    {
      foreach ($error_messages as $error_message)
        echo $error_message;
    }
    else {
    ?>
      Log in to your account
    <?php
    }
    ?>
    </span>
    <form class="login-form-js" action="<?php echo FILE_URL ?>/views/login.php" method="post">
      <input type="hidden" name="action" value="login">
      <div class="input">
        <span><i class="fas fa-phone"></i></span>
        <input type="number" name="phone" placeholder="Phone" id="phone" value="<?php echo isset($customer_account) ? $customer_account->getValueEncoded('phone') : ''?>">
      </div>
      <div class="login-pass input">
        <span><i class="fas fa-lock"></i></span>
        <input type="password" name="password" placeholder="Password" id="password">
      </div>
      <div class="input btn">
        <input type="submit" id="login" name="" value="Login">
      </div>
    </form>
    <button class="forgot_password_button" type="button" name="password_request">Forgot Password?</button>
  </div>
<?php
}

function displayForgotPasswordForm($msg)
{
?>
  <div class="<?php echo (!$msg) ? 'forget_password_form': '' ?>" id="display-forget-password">
    <span class="info-message">
    <?php
    if($msg == 'sent'){
      echo "Sent Successfully!Admin will send you a new password in one week.";
    }
    else if($msg)
    {
      echo $msg;
    }
    else
    {
      echo "Forgot Your Password?";
    }
    ?>
    </span>
    <form class="" action="<?php echo FILE_URL ?>/views/login.php" method="post">
      <input type="hidden" name="action" value="forgot_password">
      <div class="error_message"></div>
      <div class="<?php echo ($msg == 'sent') ? 'hide' : 'input' ?>">
        <span><i class="fas fa-phone"></i></span>
        <input type="number" name="phone" placeholder="Enter Your PhoneNumber" class="phone_number" required>
      </div>
      <div class="<?php echo ($msg == 'sent') ? 'hide' : 'input btn' ?>">
        <input type="submit" name="" value="Send" id="send_number_request">
      </div>
      <div class="input back-login">
        <a href="<?php echo FILE_URL ?>/views/login.php"><i class="fas fa-angle-left"></i> Back to Login</a>
      </div>
    </form>
  </div>
<?php
}

function processLoginForm()
{
  $required_fields = array('phone', 'password');
  $missing_fields = array();
  $error_messages = array();

  $customer_account = new UsersAccount(array(
    'phone' => isset($_POST['phone']) ? preg_replace('/[^0-9]/', '', $_POST['phone']) : '',
    'password' => isset($_POST['password']) ? $_POST['password'] : ''
  ));
  foreach ($required_fields as $required_field) {
    if(!$customer_account->getValue($required_field))
      $missing_fields[] = $required_field;
  }
  if($missing_fields)
  {
    $error_messages[] = '<p class="error">Please complete all the fields below!</p>';
  }
  elseif(!$loggedin_account = $customer_account->authenticateCustomerAccount())
  {
    $error_messages[] = '<p class="error">Please check your phone and password, and try again!</p>';
  }
  if($error_messages)
  {
    displayLogin($error_messages, $customer_account, '', true);
  }
  else {
    $_SESSION['merchant_customer_account'] = $loggedin_account;
    header('location: ' .URL. '/home/');
  }
}

function processPasswordRequest()
{
  $required_fields = array('phone');
  $missing_fields = array();
  $error_messages = '';

  $password_request = new PasswordRequest(array(
    'phone' => isset($_POST['phone']) ? preg_replace('/[^-\_a-zA-Z0-9]/', '', $_POST['phone']) : '',
  ));
  foreach($required_fields as $required_field)
  {
    if(!$password_request->getValue($required_field))
      $missing_fields = $required_field;
  }
  if($missing_fields)
  {
    $error_messages = '<p class="error">There were some missing fields!</p>';
  }
  else if(!UsersAccount::getCustomerAccountByPhoneNumber($password_request->getValue('phone')))
  {
    $error_messages = '<p class="error">Sorry!!!You do not have any Account with this Phone Number.</p>';
  }
  if($error_messages)
  {
    displayLogin(array(), new UsersAccount(array()), $error_messages, false);
  }
  else {
    $password_request->addPasswordRequest();
    displayLogin(array(), new UsersAccount(array()), "sent", false);
  }
}
?>
