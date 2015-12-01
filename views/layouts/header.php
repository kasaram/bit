<?php

defined('BIT') or die;



echo 'Шапка сайта, тут распологается меню, логотип, новость<br>';
?>
<head>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

</head>

<p> Баланс:
  <?php
    if(isset($_SESSION['balance'])) echo Format::coinFormat($_SESSION['balance']).' '.Config::COIN;
    else echo 0;
  ?>
</p>
  <a href="<?=Config::ADDRESS?>">Site</a>
  <a href="<?=Config::ADDRESS?>refer">Refer</a>
  <a href="<?=Config::ADDRESS?>faq">FAQ</a>
  <a href="<?=Config::ADDRESS?>account">Account</a>
  <a href="<?=Config::ADDRESS?>contact">Contact</a>
  <a href="<?=Config::ADDRESS?>bonus">Bonus</a>
  <a href="<?=Config::ADDRESS?>admin/?<?=Config::SECRET?>" >Admin</a>
<br/><br/><br/>
