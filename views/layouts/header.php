<?php 
  defined('BIT') or die;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title><?=Config::SITE_NAME?></title>
  <link href="<?=Config::ADDRESS.Config::TEMPLATE?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
  <link rel="stylesheet" type="text/css" href="<?=Config::ADDRESS.Config::TEMPLATE?>style/site.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script src="<?=Config::ADDRESS.Config::TEMPLATE?>/js/scripts.js"></script>
  
  <style type="text/css">
    body, #gamelock, input[type="text"], textarea, #withoutvideo {
      background-color: <?=Config::COLOR_BG?>;
    }
    a.logo{
      background: url("/template/<?=Config::LOGO?>") no-repeat center center;
    }
    #footer, .menu, #gamepanel > div, #bonusacts > div { 
      background-color:<?=Config::COLOR_SECOND?>;
    }
    body, .menulinks a, #gamepanel > div, input[type="text"], textarea, input[type="text"]:hover, textarea:hover, input[type="text"]:focus, textarea:focus, #withoutvideo {
      color :<?=Config::COLOR_TEXT?>;
    }
    #power { fill: <?=Config::COLOR_TEXT?>; }
    input[type="text"], input[type="email"], textarea {border: 1px solid <?=Config::COLOR_TEXT?>;}
    .menulinks a:hover { color: <?=Config::COLOR_TEXT_HOVER?>; }
    .toppanels, #topbonus, #topmoney, input[type="text"]:hover, input[type="email"]:hover, textarea:hover, input[type="text"]:focus, input[type="email"]:focus, textarea:focus {
      border: 1px solid <?=Config::COLOR_TEXT_HOVER?>;
    }
    .logout:hover #power { fill: <?=Config::COLOR_TEXT_HOVER?>; }
    a#takecoins, #gamebtns > a, #valletdiv a, #bonusacts > a, .button { 
      color: <?=Config::COLOR_BUTTON_TEXT?>;
      background-color:<?=Config::COLOR_BUTTON_BG?>;
    }
    a#takecoins:hover, #gamebtns > a:hover, #valletdiv a:hover, #bonusacts > a:hover, .button:hover {
      background-color:<?=Config::COLOR_BUTTON_HOVER_BG?>;
    }
    #footer, .menu, a.logo, .menulinks a, .toppanels, #topbonus, #topmoney, a#takecoins, #takecoinsinactive, #gamepanel > div, #gamebtns > a, #gamebtns > div, #valletdiv a, input[type="text"], input[type="email"], textarea, #bonusacts > div, #bonusacts > a, .button {
      border-radius:<?=Config::BORDER_RADIUS?>px;
    }
  </style>
</head>
<body>
<script>
  //проверка на Addblock
  function checkAdb() {
    if($('#ad-detect').css('display') == 'none'){
      $('.content').html('');
      $('.content:eq(0)').html('<div style="text-align:center; font-weight:bold;"><h2>Please, disable a program that blocks ads, and reload the page!<h2/><a href="/">RELOAD THE PAGE</a></div>');
    }
  }
  setTimeout("checkAdb()", 2000);
</script>

<img id="ad-detect" style="position:absolute;left:-9999px;" class="ads banner" src="<?=Config::ADDRESS.Config::TEMPLATE?>images/ads/banner.png"/>

<div id="overall">
  <div id="header">
    <div id="translate"></div>
    <div class="menu">
      <a href="<?=Config::ADDRESS?>" class="logo"></a>
      <div class="menulinks">
        <a href="<?=Config::ADDRESS?>refer">Refer</a>
        <a href="<?=Config::ADDRESS?>faq">FAQ</a>
        <a href="<?=Config::ADDRESS?>contact">Contact</a>
        <?php if (isset($_SESSION['id'])) { ?>
          <a href="<?=Config::ADDRESS?>account">Account</a>
        <?php } ?>
      </div>
      <?php //если игрок зашел выведем ему этот блок, иначе выведем форму входа 
        if(isset($_SESSION['id'])) { 
      ?>
        <div id="lgtandcounters">
          <div><a href="<?=Config::ADDRESS?>logout" class="logout">
            <svg height="22" width="22"><path id="power" d="M10.9992 0c0.480315,0 0.848031,0.367323 0.848031,0.848425l0 11.2823c0,0.480709 -0.366929,0.848425 -0.848031,0.848425 -0.481102,0 -0.848425,-0.367717 -0.848425,-0.848425l0 -11.2827c0,-0.480709 0.367717,-0.848031 0.848425,-0.848031zm-3.22362 4.07165c0,-0.468504 -0.379921,-0.848031 -0.848425,-0.848031 -0.127559,0 -0.248031,0.0283465 -0.356693,0.0779528l-0.0102362 -0.0216535c-3.22323,1.64016 -5.42913,4.97717 -5.42913,8.82283 0,5.45748 4.41142,9.89724 9.8689,9.89724 5.45748,0 9.8689,-4.43976 9.8689,-9.89724 -0.000787402,-3.84567 -2.20669,-7.18268 -5.43031,-8.82283l-0.00984252 0.0224409c-0.108661,-0.0503937 -0.230315,-0.0787402 -0.357874,-0.0787402 -0.468504,0 -0.848031,0.379528 -0.848031,0.848031 0,0.383071 0.25315,0.706299 0.600787,0.811811 2.57992,1.37362 4.34803,4.08937 4.34803,7.24764 0,4.52441 -3.67638,8.20039 -8.17205,8.20039 -4.49567,0 -8.17205,-3.67598 -8.17205,-8.20039 0,-3.13228 1.77047,-5.85 4.35315,-7.24921 0.344882,-0.108268 0.594882,-0.430315 0.594882,-0.810236z"/></svg>
          </a></div>
          <div id="topbonus"><?=$bonus?><div>BONUS MINUTES</div></div>
          <div id="topmoney"><?=Format::coinFormat($balance)?><div><?=strtoupper(Config::COIN)?></div></div>
        </div>
      <?php } else { ?>
        <form id="enterForm" action="login" method="post">
          <div class="walletform">
            <div>
              <?php if (isset($_GET['ref']) && !empty($_GET['ref'])) { ?>
                <input type="hidden" name="ref" value="<?=$_GET['ref']?>">
              <?php } ?>
              <input id="wallet" type="text" name="bitcoin">
            </div>
            <div>
              <a href="javascript://" onclick="$('#enterForm').submit()" class="button">ENTER</a>
            </div>
          </div>
        </form>
      <?php } ?>
    </div>
  </div>
