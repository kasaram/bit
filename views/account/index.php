<?php
defined('BIT') or die;
require_once ROOT.'/'.Config::VIEW.'layouts/header.php';
?>

<h3 style="color:#7096f6;"> Здесь будет выводиться страница Account</h3>

<?php
  //выводим сообщение об ошибке или успехе проведения операции
  if(isset($_GET['res']) && !empty($_GET['res'])){ 
    echo Message::getMsg($_GET['res']);
  } 
?>

  <p>
    <form action="<?=Config::ADDRESS?>account/bitcoin" method="post">
      Bitcoin Address: <input type="text" name="bitcoin" size="40" value="<?=$_SESSION['bitcoin'];?>" maxlength="50">
      <input type="submit" name="submit" value="Change">
    </form>
  </p>
  <p>
    Un puid balance: <?=Format::coinFormat($balance).' '.Config::COIN?>
  </p>
  <p>
    Bonus minutes: <?=$bonus?>
  </p>
  <p>
    Daily bonus: <?=$_SESSION['dailyBonus'];?>
  </p>
  <p>
      Last pay out: <?=Format::coinFormat($lastPay['lastPayOut']).' '.Config::COIN?>
    <?php if(!empty($lastPay['lastDateOut'])) { ?>
      was <?=Format::dateFormat($lastPay['lastDateOut']); ?>
    <?php } ?>
  </p>
  <p>
    <form action="<?=Config::ADDRESS?>account/withdraw" method="post">
      Auto withdraw ENABLED:
      <?php
        $checked = (!empty($_SESSION['withdraw'])) ? 'checked' : '';
      ?>
      <input type="checkbox" onclick="submit();" name="withdraw" <?=$checked?>>
    </form>
  </p>
  <p>
    Minimum transfer amount: <?=Format::coinFormat(Config::SUM_AMOUNT).' '.Config::COIN?>
  </p>

<?php
  require_once ROOT.'/'.Config::VIEW.'layouts/middle.php';
  require_once ROOT.'/'.Config::VIEW.'layouts/footer.php';
?>