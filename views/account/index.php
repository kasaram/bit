<?php
defined('BIT') or die;
require_once ROOT.'/'.Config::VIEW.'layouts/header.php';
?>
<!-- <script>
  $(document).on('change', '#checkwithdraw', function() {
    $.post('<?=Config::ADDRESS?>account/withdraw', {
      'withdraw': ($(this).is(':checked') ? 'es' : 'no')
    //} , function(data){
        //alert(data);
    });
  });
</script> -->


<h3 style="color:#7096f6;"> Здесь будет выводиться страница Account</h3>

<?php if(isset($_SESSION['id'])) { ?>

  <!-- Сообщение о изменении биткоина -->
  <?php if(isset($_GET['sucBit'])) {?>
    <p style="color:#5cd212;">Bitcoin successfully changed! </p>
  <?php } ?>
  <?php if(isset($_GET['failBit'])) {?>
    <p style="color:#d21212;">Bitcoin is invalid!</p>
  <?php } ?>

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
        $checked = (isset($_SESSION['withdraw']) && $_SESSION['withdraw'] == 'es') ? 'checked' : '';
      ?>
      <input type="checkbox" onclick="submit();" name="withdraw" value="es" <?=$checked?>>
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
