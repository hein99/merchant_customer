<?php
$text='';
switch($ERR_STATUS)
{
  case 1:
    $text = 'Not Found Any Controller';
    break;
  case 2:
    $text = 'Not Found Any Action';
    break;
  case 3:
    foreach($error_messages as $error_message)
      $text .= $error_message;
    break;
  case 4:
    $text = 'Invalid URL';
    break;
  default:
    $text = 'Unknown Error';
}
  displayPageHeader('Error | ' . WEB_NAME);
?>
<header>
  <div class="ky-logo-name-container">
    <a href="<?php echo URL ?>/">
      <img src="<?php echo FILE_URL ?>/logos/globe-solid.png"/>
      <span>The Best Shop</span>
    </a>
  </div>

  <div class="ky-user-content" style="cursor: auto;">
    <i class="fas fa-user-circle"></i>
      <span>Swe Swe Nyein</span>
  </div>
</header>

<section class="error-page-content">
  <div class="error-page-container">
    <div class="error-page-header">
      <span><i class="far fa-tired tired"></i></span>
      <span id="main-error-message">Something Wrong!!</span>
    </div>
    <div class="error-page-body">
      <div class="error-page-message">
        <?php echo $text; ?>
      </div>
      <div class="error-page-buttons">
        <a href="javascript:history.go(-1)"><span id="error-back-button"><i class="fas fa-arrow-left"></i>Back</span></a>
        <a href="<?php echo URL ?>/home/"><span id="error-home-button"><i class="fas fa-th-large"></i>Home</span></a>
      </div>
    </div>
  </div>
</section>

 <?php displayPageFooter(); ?>
