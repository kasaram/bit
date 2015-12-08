<?php
  defined('BIT') or die;
  require_once ROOT.'/'.Config::VIEW.'layouts/header.php';
?>

<div class="content">
  <?php require_once ROOT.'/'.Config::VIEW.'layouts/banner.php';?>
  <?php //выводим сообщение об ошибке или успехе проведения операции
    if(isset($_GET['res']) && !empty($_GET['res'])){ 
      echo Message::getMsg($_GET['res']);
    } 
  ?>
  <div class="title">Account</div>
  <form id="bitcoinForm" action="<?=Config::ADDRESS?>account/bitcoin" method="post">
  <div class="formtable">
    <div>
        <div>Bitcoin Address:</div>
        <div>
          <input type="text" name="bitcoin" size="40" value="<?=$_SESSION['bitcoin'];?>" maxlength="50">
        </div>
    </div>
    <div>
        <div></div>
        <div>
          <a href="javascript://" class="button" onclick="$('#bitcoinForm').submit();">CHANGE</a>
        </div>
    </div>
    <div>
      <div>Un puid balance:</div>
      <div><?=Format::coinFormat($balance).' '.Config::COIN?></div>
    </div>
    <div>
      <div>Bonus:</div>
      <div><?=$bonus?> minutes</div>
    </div>
    <div>
      <div>Daily bonus:</div>
      <div><?=$_SESSION['dailyBonus']?> %</div>
    </div>
    <div>
      <div>Daily bonus increase after:</div>
      <div>
        <?php //выводим оставшееся время до следующего дневного бонуса
          $time = $_SESSION['nextVisit'] - time();
          $hours = date('G', $_SESSION['nextVisit'] - time()).' hour(s)'; 
          $minutes = date('i', $_SESSION['nextVisit'] - time()); 
          $minutes = strpos($minutes, '0') === false ? $minutes : substr($minutes, 1);
          $minutes .= ' minute(s)';
          echo $hours.' '.$minutes;
        ?>
      </div>
    </div>
    <div>
      <div>Last pay out:</div>
      <div>
        <?=Format::coinFormat($lastPay['lastPayOut']).' '.Config::COIN?>
        <?php if(!empty($lastPay['lastDateOut'])) { ?>
          was <?=Format::dateFormat($lastPay['lastDateOut']); ?>
        <?php } ?>
      </div>
    </div>
    <div>
      <div></div>
      <div></div>
    </div>
  </div>
 </form>

 <form id="withdrawForm" action="<?=Config::ADDRESS?>account/withdraw" method="post">
  <div class="formtable">
    <div>
        <div>Auto withdraw ENABLED:</div>
        <div>
          <?php
            $checked = (!empty($_SESSION['withdraw'])) ? 'checked' : '';
          ?>
          <input type="checkbox" onclick="$('#withdrawForm').submit();" name="withdraw" <?=$checked?>>
        </div>
    </div>
    <div>
      <div>Minimum transfer amount:</div>
      <div><?=Format::coinFormat(Config::SUM_AMOUNT).' '.Config::COIN?></div>
    </div>
  </div>
 </form>
</div>

<?php
  require_once ROOT.'/'.Config::VIEW.'layouts/middle.php';
  require_once ROOT.'/'.Config::VIEW.'layouts/footer.php';
?>