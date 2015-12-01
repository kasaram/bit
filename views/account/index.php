<?php
defined('BIT') or die;
require_once ROOT.'/'.Config::VIEW.'layouts/header.php';
?>

<h3 style="color:#7096f6;"> Здесь будет выводиться страница Account</h3>

<?php if(isset($_SESSION['id'])) { 
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
    Un puid balance: <?=Format::coinFormat($_SESSION['balance']).' '.Config::COIN?>
  </p>
  <p>
    Last pay out: <?=Format::coinFormat($_SESSION['lastPayOut']).' '.Config::COIN.' was '.Format::dateFormat($_SESSION['lastDateOut'])?>
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
} else {
  echo 'Здесь отображается страница аккаунта не зарегистрированного пользователя';
}
require_once ROOT.'/'.Config::VIEW.'layouts/middle.php';
require_once ROOT.'/'.Config::VIEW.'layouts/footer.php';
