<?php
function displayPageHeader($page_title, $dir_level=false)
{?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title><?php echo $page_title ?></title>
      <link rel="stylesheet" href="<?php echo FILE_URL ?>/styles/reset.css">
      <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.13.0/css/all.css'>
      <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">
      <link rel="stylesheet" href="<?php echo FILE_URL ?>/styles/<?php echo $dir_level ? 'login.css' : 'config.css'?>">
      <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
      <script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
      <script>window.jQuery || document.write('<script src="<?php echo FILE_URL ?>/scripts/jquery-3.4.1.min.js"><\/script>')</script>
      <script>
        var PAGE_URL = '<?php echo URL ?>';
        var PAGE_FILE_URL = '<?php echo FILE_URL ?>';
      </script>
    </head>
    <body>
  <?php
}

function displayHomeNavigation()
{?>
  <header class="wp-page-header">
    <div class="wp-header-logo">
      <a href="<?php echo URL ?>/">
        <img src="<?php echo FILE_URL ?>/logos/globe-solid.png"/><span>The Best Shop</span>
      </a>
    </div>
    <div class="wp-header-logout">
      <a href="<?php echo URL ?>/settings/logout">
        <span id="wp-logout">Log out</span>
        <i class="fas fa-sign-out-alt"></i>
      </a>
    </div>
  </header>

  <nav class="wp-page-nav">
    <a href="#">
      <i class="fas fa-cart-plus"></i>
      <h3><span>Add&nbsp;</span><span>New Order</span></h3>
    </a>
    <a href="#">
      <i class="fas fa-shapes"></i>
      <h3><span>My&nbsp;</span><span>Order</span></h3>
    </a>
    <a href="#">
      <i class="fas fa-money-check-alt"></i>
      <h3><span>Bill&nbsp;</span><span>History</span></h3>
    </a>
    <a href="#">
      <i class="fas fa-user-cog"></i>
      <h3><span>Account&nbsp;</span><span>Setting</span></h3>
    </a>
  </nav>
  <?php
}
function displayOtherNavigation($active_page='')
{ ?>
  <header class="wp-page-header">
    <div class="wp-header-menu" style="cursor: pointer; padding: 2px;">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <div class="wp-header-logo">
      <a href="<?php echo URL ?>/">
        <img src="<?php echo FILE_URL ?>/logos/globe-solid.png"/><span>The Best Shop</span>
      </a>
    </div>
    <div class="wp-header-logout">
      <a href="<?php echo URL ?>/settings/logout">
        <span id="wp-logout">Log out</span>
        <i class="fas fa-sign-out-alt"></i>
      </a>
    </div>
  </header>

  <nav class="wp-other-page-nav">
    <div class="wp-other-page-header">
      <a href="<?php echo URL ?>/">
        <img src="<?php echo FILE_URL ?>/logos/globe-solid.png"/><span>The Best Shop</span>
      </a>
      <span><i class="far fa-times-circle"></i></span>
    </div>
    <div class="wp-other-page-sidebar">
      <a href="#">
        <i class="fas fa-home"></i>
        <h3>Home</h3>
      </a>
      <a href="#">
        <i class="fas fa-shapes"></i>
        <h3>My Order</h3>
      </a>
      <a href="#">
        <i class="fas fa-money-check-alt"></i>
        <h3>Bill History</h3>
      </a>
      <a href="#">
        <i class="fas fa-comment-dots"></i>
        <h3>Contact Admin</h3>
      </a>
      <a href="#">
        <i class="fas fa-user-cog"></i>
        <h3>Account Setting</h3>
      </a>
    </div>
  </nav>
  <?php
}
function displayPageFooter()
{?>
  <script src="<?php echo FILE_URL ?>/scripts/header.js"></script>
    </body>
  </html>
  <?php
}

 ?>
