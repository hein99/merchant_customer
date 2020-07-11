<?php
function displayPageHeader($page_title, $dir_level=false)
{?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title><?php echo $page_title ?></title>
      <link rel="stylesheet" href="<?php echo FILE_URL ?>/styles/reset.css">
      <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.13.0/css/all.css'>
      <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">
      <link href="https://fonts.googleapis.com/css2?family=Lato&family=Noto+Sans+KR&family=Open+Sans&display=swap" rel="stylesheet">
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
    <div class="wp-contact-logout-container">
      <div class="wp-contact-admin">
        <a href="<?php echo URL ?>/conversation/">
         <img src="<?php echo FILE_URL ?>/logos/chat.png" alt="">
         <span id="messages_count"></span>
        </a>
      </div>
      <div class="wp-header-logout">
        <a href="<?php echo URL ?>/settings/logout">
          <span id="wp-logout">Log out</span>
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </div>
    </div>
  </header>

  <nav class="wp-page-nav">
    <a href="#" id="new-order">
      <i class="fas fa-cart-plus"></i>
      <h3><span>Add&nbsp;</span><span>New Order</span></h3>
    </a>
    <a href="<?php echo URL ?>/order/">
      <i class="fas fa-shapes"></i>
      <h3><span>My&nbsp;</span><span>Order</span><span class="hk-nav-noti"><i class="fa fa-exclamation-circle"></i></span></h3>
    </a>
    <a href="<?php echo URL ?>/statement/">
      <i class="fas fa-money-check-alt"></i>
      <h3><span>Bill&nbsp;</span><span>History</span></h3>
    </a>
    <a href="<?php echo URL ?>/settings/">
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

  <nav class="wp-other-page-nav-container">
    <div id="wp-other-page-sidebar-back"></div>
    <div class="wp-other-page-nav">
      <div class="wp-other-page-header">
        <img src="<?php echo FILE_URL ?>/logos/globe-solid-white.png"/>
        <span id="wp-other-page-header-logo">The Best Shop</span>
        <span id="wp-close-nav"><i class="fas fa-window-close"></i></span>
      </div>
      <div class="wp-other-page-sidebar">
          <a href="<?php echo URL ?>/home/">
            <i class="fas fa-home"></i>
            <span>Home</span>
          </a>
          <a <?php echo ($active_page == 'order') ? '' : 'href="' . URL . '/order/"' ?> class="<?php echo ($active_page == 'order') ? "active" : "" ?>">
            <i class="fas fa-shapes"></i>
            <span>My Order<span class="hk-nav-noti"><i class="fa fa-exclamation-circle"></i></span></span>
          </a>
          <a <?php echo ($active_page == 'statement') ? '' : 'href="' . URL . '/statement/"' ?> class="<?php echo ($active_page == 'statement') ? "active" : "" ?>">
            <i class="fas fa-money-check-alt"></i>
            <span>Bill History</span>
          </a>
          <a <?php echo ($active_page == 'conversation') ? '' : 'href="' . URL . '/conversation/"' ?> class="<?php echo ($active_page == 'conversation') ? "active" : "" ?>">
            <i class="fas fa-comment-dots"></i>
            <span>Contact Admin</span>
          </a>
          <a <?php echo ($active_page == 'settings') ? '' : 'href="' . URL . '/settings/"' ?> class="<?php echo ($active_page == 'settings') ? "active" : "" ?>">
            <i class="fas fa-user-cog"></i>
            <span>Account Setting</span>
          </a>
          <a <?php echo ($active_page == 'membership') ? '' : 'href="' . URL . '/membership/"' ?> class="<?php echo ($active_page == 'membership') ? "active" : "" ?>">
            <i class="fas fa-award"></i>
            <span>Membership Definition</span>
          </a>
      </div>
    </div>
  </nav>
  <?php
}
function displayPageFooter()
{?>
  <footer>
    <div class="footer-accounts">
      <h6>KBZ Accounts</h6>
      <div class="">
        <ul>
          <li><a href="#">9086 5432 6754 2769</a></li>
          <li><a href="#">9086 5432 6754 2769</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-phone">
      <h6>Call Us</h6>
      <div class="">
        <ul>
          <li><a href="tel:09765920059">09 765920059</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-address">
      <h6>Our Location</h6>
      <p>No.55, Marlarmying 6th Street, No(9) Ward, Hlaing Township, Yangon.</p>
    </div>
  </footer>
  <script src="<?php echo FILE_URL ?>/scripts/header.js"></script>
    </body>
  </html>
  <?php
}

 ?>
