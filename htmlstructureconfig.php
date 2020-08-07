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
      <link rel="stylesheet" href="<?php echo FILE_URL ?>/styles/swiper.min.css">
      <link
    rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
      <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.13.0/css/all.css'>
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">
      <link href="https://fonts.googleapis.com/css2?family=Lato&family=Noto+Sans+KR&family=Open+Sans&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="<?php echo FILE_URL ?>/styles/<?php echo $dir_level ? 'login.css' : 'config.css'?>">
      <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
      <script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
      <script>window.jQuery || document.write('<script src="<?php echo FILE_URL ?>/scripts/jquery-3.4.1.min.js"><\/script>')</script>
      <script>
        var PAGE_URL = '<?php echo URL ?>';
        var PAGE_FILE_URL = '<?php echo FILE_URL ?>';
        var CURRENCY_SYMBOL = '<?php echo CURRENCY_SYMBOL ?>';
        var CURRENCY_ABBR = '<?php echo CURRENCY_ABBR ?>';
        var CURRENCY_LABEL = '<?php echo CURRENCY_LABEL ?>';
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
function displayPageFooter($display_footer=true)
{
  if($display_footer){?>
    <footer>
      <div class="footer-accounts">
        <h6>Our Accounts</h6>
        <div class="bank-accounts-container">
          <i class="fas fa-credit-card"></i>
          <ul>
            <li>KBZ: <input type="text" class="hk-copy-text-js" value="09130103301085101"><button class="hk-copy-text-js" title="Copy"><i class="far fa-copy"></i></button><span class="animate__animated animate__bounceOut">copied</span></li>
            <li>CB: <input type="text" class="hk-copy-text-js" value="0084600500049085"><button class="hk-copy-text-js" title="Copy"><i class="far fa-copy"></i></button><span class="animate__animated animate__bounceOut">copied</span></li>
            <li>AYA: <input type="text" class="hk-copy-text-js" value="0192201010061371"><button class="hk-copy-text-js" title="Copy"><i class="far fa-copy"></i></button><span class="animate__animated animate__bounceOut">copied</span></li>
            <li>KBZ Pay: <input type="text" class="hk-copy-text-js" value="09974330882"><button class="hk-copy-text-js" title="Copy"><i class="far fa-copy"></i></button><span class="animate__animated animate__bounceOut">copied</span></li>
            <li>Wave Money: <input type="text" class="hk-copy-text-js" value="09974330882"><button class="hk-copy-text-js" title="Copy"><i class="far fa-copy"></i></button><span class="animate__animated animate__bounceOut">copied</span></li>
          </ul>
        </div>
      </div>
      <div class="footer-contact-us">
        <h6>Contact Us</h6>
        <div class="phone-number-container">
          <i class="fas fa-phone-alt"></i>
          <a href="tel:09974330882">09 974330882</a>
        </div>
        <div class="address-container">
          <i class="fas fa-map-marker-alt"></i>
          <a href="https://goo.gl/maps/L9nzKBog7yF7def77" target="_blank"><p>No.55, Marlarmying 6th Street, No(16) Ward, Hlaing Township, Yangon.</p></a>
        </div>
      </div>
      <div class="footer-social">
        <h6>Follow Us</h6>
        <div class="">
          <a href="https://www.facebook.com/Ms-Beautys-Brand-Collection-101681588058918/" target="_blank"><i class="fab fa-facebook-f"></i></a>
          <a href="https://www.thebestshopmm.com" target="_blank"><i class="fas fa-shopping-bag"></i></a>
        </div>
      </div>
    </footer>
  <?php } ?>
    <script src="<?php echo FILE_URL ?>/scripts/header.js"></script>
    </body>
  </html>
  <?php
}

 ?>
