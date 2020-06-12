<?php
require('../config.php');
require('../htmlstructureconfig.php');
require('../models/DataObject.class.php');
require('../models/UsersAccount.class.php');
session_start();

if( isset($_POST['action']) and $_POST['action'] == 'login')
{
  processLoginForm();
}
else {
  displayLoginFrom(array(), new UsersAccount(array()));
}

function displayLoginFrom($error_messages, $admin_account)
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
    <input type="text" name="username" placeholder="Username" id="username" value="<?php echo isset($admin_account) ? $admin_account->getValueEncoded('username') : ''?>">
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
</div>
  <script type="text/javascript">
    $(function(){

      $('#username').focus();

      $close = $('.close-eye');
      $password = $('#password');

      $('.login-eye').click(function(){
        $close.toggle();
        $('.open-eye svg, .inner').toggleClass('show');

        if($password.attr('type') == 'password'){
          $password.attr('type', 'text');
          $password.focus();
        }else{
          $password.attr('type', 'password');
          $password.focus();
        }
      });

      $('#password').keydown(function(e){
        if(e.which == 115){
          $password.attr('type', 'text');
          $password.focus();
          $close.hide();
          $('.open-eye svg, .inner').addClass('show');
        }
      });

      $('#password').keyup(function(e){
        if(e.which == 115){
          $password.attr('type', 'password');
          $password.focus();
          $close.show();
          $('.open-eye svg, .inner').removeClass('show');
        }
      });
    });
  </script>
  <?php
  displayPageFooter();
  }

  function processLoginForm()
  {
    $required_fields = array('username', 'password');
    $missing_fields = array();
    $error_messages = array();

    $admin_account = new UsersAccount(array(
      'username' => isset($_POST['username']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['username']) : '',
      'password' => isset($_POST['password']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['password']) : ''
    ));
    foreach ($required_fields as $required_field) {
      if(!$admin_account->getValue($required_field))
        $missing_fields[] = $required_field;
    }
    if($missing_fields)
    {
      $error_messages[] = '<p class="error">Please complete all the fields below!</p>';
    }
    elseif(!$loggedin_account = $admin_account->authenticateAdminAccount())
    {
      $error_messages[] = '<p class="error">Please check your username and password, and try again!</p>';
    }
    if($error_messages)
    {
      displayLoginFrom($error_messages, $admin_account);
    }
    else {
      $_SESSION['merchant_admin_account'] = $loggedin_account;
      header('location: ' .URL. '/dashboard/');
    }
  }
  ?>
