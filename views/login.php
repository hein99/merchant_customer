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
  displayLoginFrom(array(), new UsersAccount(array()));
  displayForgotPasswordForm('');
}

function displayLoginFrom($error_messages, $customer_account)
{
  displayPageHeader('Login | ' . WEB_NAME, true);
?>
<div class="login-container">
  <div class="login-header">
  <span id="user-icon"><i class="fas fa-user-circle"></i></span>
  <span id="welcome">
  <?php
  if($error_messages)
  {
    foreach ($error_messages as $error_message)
      echo $error_message;
  }
  else {?>
    Welcome to the best shop!</span>
  <?php
  }
  ?>
  </div>
  <form class="login-body" action="<?php echo URL ?>/views/login.php" method="post">
    <input type="hidden" name="action" value="login">
    <input type="number" name="phone" placeholder="Phone" id="phone" value="<?php echo isset($customer_account) ? $customer_account->getValueEncoded('phone') : ''?>">
    <div class="login-pass">
      <input type="password" name="password" placeholder="Password" id="password">
      <span class="login-eye">
        <i class="far fa-eye-slash close-eye"></i>
        <i class="open-eye">
          <div class="outer">
          <svg width="10" height="7" viewBox="0 0 10 7" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1 3.50388C2.26035 1.61439 5.62484 -1.03088 9 3.50388C7.7621 5.38751 4.42905 8.0246 1 3.50388Z" stroke="black" stroke-width="0.8"/>
          </svg>
          <span class="inner"></span>
          </div>
        </i>
      </span>
    </div>
    <input type="submit" id="login" name="" value="Login">
  </form>
  <button class="forgot_password_button" type="button" name="password_request">Forgot Password?</button>
</div>
  <script src="<?php echo FILE_URL ?>/scripts/jquery.validate.min.js" charset="utf-8"></script>
  <script src="<?php echo FILE_URL ?>/scripts/login.js" charset="utf-8"></script>
  <?php
  displayPageFooter();
  }

  function displayForgotPasswordForm($msg)
  {
  ?>
  <div class="<?php echo (!$msg) ? 'forget_password_form': '' ?>">
  <span class="">
  <?php
    if($msg)
    {
      echo $msg;
    }else{
      echo "Forgot Your Password?";
    }
  ?>
  <span>
    <form class="" action="<?php echo URL ?>/views/login.php" method="post">
      <input type="hidden" name="action" value="forgot_password">
      <div class="error_message"></div>
      <input type="number" name="phone" placeholder="Enter Your PhoneNumber" class="phone_number" required>
      <input type="submit" name="" value="Send" id="send_number_request">
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
      displayLoginFrom($error_messages, $customer_account);
      displayForgotPasswordForm('');
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
      $error_messages = '<p>There were some missing fields!</p>';
    }
    else if(!UsersAccount::getCustomerAccountByPhoneNumber($password_request->getValue('phone')))
    {
      $error_messages = '<p>Sorry!!!You do not have any Account with this Phone Number.</p>';
    }
    if($error_messages)
    {
      displayLoginFrom(array(), new UsersAccount(array()));
      displayForgotPasswordForm($error_messages);
    }
    else {
      $password_request->addPasswordRequest();
      displayLoginFrom(array(), new UsersAccount(array()));
      displayForgotPasswordForm("Sent Successfully!Admin will send you a new password in one week.");
    }
  }
  ?>
